<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartnerLogoStorage
{
    private const DISK = 'partner_logos';
    private const MAX_DIMENSION = 600;

    public static function storeForOwner(UploadedFile $file, int $ownerId, int $hallId): string
    {
        return self::store($file, 'owners/'.$ownerId.'/halls/'.$hallId);
    }

    public static function storeForSupervisor(UploadedFile $file, int $supervisorId): string
    {
        return self::store($file, 'supervisors/'.$supervisorId);
    }

    public static function url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (self::isStaticUploadPath($path)) {
            return asset('uploads/partner-logos/'.$path);
        }

        return route('public.storage', ['path' => $path]);
    }

    public static function delete(?string $path): void
    {
        if (! $path) {
            return;
        }

        if (self::isStaticUploadPath($path)) {
            Storage::disk(self::DISK)->delete($path);

            return;
        }

        Storage::disk('public')->delete($path);
    }

    private static function store(UploadedFile $file, string $directory): string
    {
        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'jpg');
        $normalizedExtension = $extension === 'jpeg' ? 'jpg' : $extension;
        $path = $directory.'/'.Str::uuid().'.'.$normalizedExtension;

        $absolutePath = Storage::disk(self::DISK)->path($path);
        $absoluteDirectory = dirname($absolutePath);

        if (! is_dir($absoluteDirectory)) {
            mkdir($absoluteDirectory, 0755, true);
        }

        if (! self::optimizeImage($file, $absolutePath, $normalizedExtension)) {
            $file->move($absoluteDirectory, basename($absolutePath));
        }

        return $path;
    }

    private static function optimizeImage(UploadedFile $file, string $destination, string $extension): bool
    {
        if ($extension === 'gif') {
            return false;
        }

        if (! function_exists('getimagesize')) {
            return false;
        }

        $sourcePath = $file->getRealPath();

        if (! $sourcePath) {
            return false;
        }

        $dimensions = @getimagesize($sourcePath);

        if (! is_array($dimensions) || count($dimensions) < 2) {
            return false;
        }

        [$width, $height] = $dimensions;

        if ($width < 1 || $height < 1) {
            return false;
        }

        $image = match ($extension) {
            'jpg' => function_exists('imagecreatefromjpeg') ? @imagecreatefromjpeg($sourcePath) : false,
            'png' => function_exists('imagecreatefrompng') ? @imagecreatefrompng($sourcePath) : false,
            'webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($sourcePath) : false,
            default => false,
        };

        if (! $image) {
            return false;
        }

        $targetWidth = $width;
        $targetHeight = $height;

        if ($width > self::MAX_DIMENSION || $height > self::MAX_DIMENSION) {
            $ratio = min(self::MAX_DIMENSION / $width, self::MAX_DIMENSION / $height);
            $targetWidth = max(1, (int) round($width * $ratio));
            $targetHeight = max(1, (int) round($height * $ratio));
        }

        $canvas = imagecreatetruecolor($targetWidth, $targetHeight);

        if (in_array($extension, ['png', 'webp'], true)) {
            imagealphablending($canvas, false);
            imagesavealpha($canvas, true);
            $transparent = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
            imagefilledrectangle($canvas, 0, 0, $targetWidth, $targetHeight, $transparent);
        }

        imagecopyresampled($canvas, $image, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

        $saved = match ($extension) {
            'jpg' => imagejpeg($canvas, $destination, 82),
            'png' => imagepng($canvas, $destination, 6),
            'webp' => function_exists('imagewebp') ? imagewebp($canvas, $destination, 80) : false,
            default => false,
        };

        imagedestroy($image);
        imagedestroy($canvas);

        return (bool) $saved;
    }

    private static function isStaticUploadPath(string $path): bool
    {
        return Str::startsWith($path, ['owners/', 'supervisors/']);
    }
}