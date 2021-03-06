<?php declare(strict_types=1);
namespace ImageUploader\Util;

class Image
{
    /**
     * Resize a single image
     *
     * @param \Imagick $image
     * @param int      $width
     * @param int      $height
     *
     * @return \Imagick
     */
    public static function scaleSingleImage(\Imagick $image, $width, $height): \Imagick
    {
        $imageWidth = $image->getImageWidth();
        $imageHeight = $image->getImageHeight();

        if (!$width && $height) {
            $width = ($imageWidth / $imageHeight) * $height;
        }
        else if ($width && !$height) {
            $height = $width / ($imageWidth / $imageHeight);
        }

        // do not resize if the images is smaller then the needed scale
        if ($imageWidth <= $width && $imageHeight <= $height) {
            return $image;
        }

        $image->scaleImage((int) $width, (int) $height, false);

        return $image;
    }
}