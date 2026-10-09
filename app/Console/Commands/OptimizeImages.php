<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize';

    protected $description = 'Optimize bundled images in public/images to WebP';

    private const TARGET_SIZE = 250 * 1024; // 250 KB
    private const MIN_QUALITY = 65;

    public function handle(): int
    {
        if (! function_exists('imagewebp')) {
            $this->error('GD with WebP support (imagewebp) is not available. Aborting.');

            return self::FAILURE;
        }

        $dir = public_path('images');

        // source => [max width, base output name]
        $jobs = [
            'copper.png' => ['maxWidth' => 1400, 'output' => 'copper.webp'],
            'brass.png' => ['maxWidth' => 1400, 'output' => 'brass.webp'],
            'khasaimage.png' => ['maxWidth' => 1400, 'output' => 'khasaimage.webp'],
            'steelimage.png' => ['maxWidth' => 1400, 'output' => 'steelimage.webp'],
            'aluminium.jfif' => ['maxWidth' => 1400, 'output' => 'aluminium.webp'],
            'contactimage.png' => ['maxWidth' => 1800, 'output' => 'contactimage.webp'],
        ];

        $rows = [];

        foreach ($jobs as $source => $job) {
            $srcPath = $dir . '/' . $source;
            $outPath = $dir . '/' . $job['output'];

            if (! file_exists($srcPath)) {
                $this->warn("Skipping {$source} - file not found.");
                continue;
            }

            $info = @getimagesize($srcPath);
            if ($info === false) {
                $this->warn("Skipping {$source} - unreadable image.");
                continue;
            }

            $mime = $info['mime'];
            if ($mime === 'image/png') {
                $image = @imagecreatefrompng($srcPath);
            } elseif (in_array($mime, ['image/jpeg', 'image/jpg'], true)) {
                $image = @imagecreatefromjpeg($srcPath);
            } else {
                $this->warn("Skipping {$source} - unsupported type {$mime}.");
                continue;
            }

            if ($image === false) {
                $this->warn("Skipping {$source} - could not decode.");
                continue;
            }

            // Preserve alpha for PNGs
            imagealphablending($image, false);
            imagesavealpha($image, true);

            // Resize to max width, never upscale, keep aspect ratio
            $origW = imagesx($image);
            $origH = imagesy($image);
            $maxW = $job['maxWidth'];

            if ($origW > $maxW) {
                $newW = $maxW;
                $newH = (int) round($origH * ($maxW / $origW));
                $resized = imagecreatetruecolor($newW, $newH);

                if ($mime === 'image/png') {
                    imagealphablending($resized, false);
                    imagesavealpha($resized, true);
                    $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
                    imagefilledrectangle($resized, 0, 0, $newW, $newH, $transparent);
                }

                imagecopyresampled($resized, $image, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
                imagedestroy($image);
                $image = $resized;
            }

            // Encode WebP, lowering quality in steps of 5 until under target
            $quality = 78;
            do {
                imagewebp($image, $outPath, $quality);
                $size = filesize($outPath);
                if ($size <= self::TARGET_SIZE || $quality <= self::MIN_QUALITY) {
                    break;
                }
                $quality -= 5;
            } while (true);

            imagedestroy($image);

            $before = filesize($srcPath);
            $after = filesize($outPath);
            $saved = $before > 0 ? round((1 - $after / $before) * 100) : 0;

            $rows[] = [
                $source,
                $job['output'],
                $origW . 'x' . $origH,
                $this->formatSize($before),
                $this->formatSize($after),
                $quality,
                $saved . '%',
            ];
        }

        $this->table(
            ['Original', 'Output', 'Dimensions', 'Before', 'After', 'Quality', 'Saved'],
            $rows
        );

        return self::SUCCESS;
    }

    private function formatSize(int $bytes): string
    {
        if ($bytes >= 1024 * 1024) {
            return round($bytes / 1024 / 1024, 2) . ' MB';
        }

        return round($bytes / 1024) . ' KB';
    }
}
