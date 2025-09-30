<?php

namespace Vaghey\ImageEditor;

class AbstractImageEditor
{
    private $width;
    private $height;
    private $mime;
    private $source;

    public function __construct(string $sourcePath)
    {
        $this->source = $sourcePath;
        $imageInfo = getimagesize($sourcePath);
        $this->width = $imageInfo[0];
        $this->height = $imageInfo[1];
        $this->mime = $imageInfo['mime'];
    }

    private function createImage(string $sourcePath)
    {
        return match ($this->mime) {
            'image/png' => imagecreatefrompng($sourcePath),
            'image/webp' => imagecreatefromwebp($sourcePath),
            'image/gif' => imagecreatefromgif($sourcePath),
            'image/jpeg' => imagecreatefromjpeg($sourcePath),
        };
    }

    private function calculateHeight($newWidth): int
    {
        return intval($this->height / $this->width * $newWidth);
    }

    private function getDefaultDestination(?string $path = null): string
    {
        return $path ?? $this->source;
    }

    public function resizeToWidth(int $newWidth, ?string $destPath = null, string $format = 'webp', $quality = 70): void
    {
        $destPath = $this->getDefaultDestination($destPath);
        $newHeight = $this->calculateHeight($newWidth);

        $source = $this->createImage($this->source);
        $dest = imagecreatetruecolor($newWidth, $newHeight);

        if ($this->mime === 'image/png' || $this->mime === 'image/webp' || $this->mime === 'image/gif') {
            imagecolortransparent($dest, imagecolorallocatealpha($dest, 0, 0, 0, 127));
            imagealphablending($dest, false);
            imagesavealpha($dest, true);
        }
        imagecopyresampled($dest, $source, 0, 0, 0, 0, $newWidth, $newHeight, $this->width, $this->height);

        $this->saveImage($dest, $destPath, $format, $quality);

        imagedestroy($source);
        imagedestroy($dest);
    }

    private function saveImage(\GdImage|false $dest, string $path, string $format, mixed $quality): void
    {
        switch ($format) {
            case 'webp':
                imagewebp($dest, $path, $quality);
                break;
            case 'png':
                imagepng($dest, $path, $quality);
                break;
            case 'gif':
                imagegif($dest, $path);
                break;
            case 'jpeg':
                imagejpeg($dest, $path, $quality);
                break;
        }
    }
}
