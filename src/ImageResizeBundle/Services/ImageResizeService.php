<?php

namespace ImageResizeBundle\Services;

use Imagine\Exception\Exception as ImagineExc;
use Imagine\Exception\InvalidArgumentException as ImagineArgExc;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ImageResizeService
 */
class ImageResizeService
{
    private $imageStoragePath;
    private $jpegQuality;
    private $pngCompressionLevel;
    private $aspectPrecision;

    /**
     * ImageResizeService constructor.
     *
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->imageStoragePath = $settings['image_storage'];
        $this->jpegQuality = $settings['jpeg_quality'];
        $this->pngCompressionLevel = $settings['png_compression_level'];
        $this->aspectPrecision = $settings['aspect_precision'];
    }

    /**
     * Creates an array representation of size parameters from the query
     * string parameter.
     *
     * @param string $resizeParam
     *   Query param value, in format {WIDTH}x{HEIGHT}.
     *
     * @return array
     *   Array of width and height.
     */
    public function getSizeFromParam($resizeParam)
    {
        $dimensions = [];
        $sizes = [];

        $patternMatched = preg_match('/^(\d+)x(\d+)$/', $resizeParam, $sizes);
        if (!empty($resizeParam) && $patternMatched) {
            $dimensions = [
                'width' => (int)$sizes[1],
                'height' => (int)$sizes[2],
            ];
        }

        return $dimensions;
    }

    /**
     * Generates directory name based on the size parameters.
     *
     * @param array $size
     *   Requested size ({WIDTH}x{HEIGHT}).
     *
     * @return string
     *   Directory name.
     */
    private function createThumbnailDirectoryName(array $size)
    {
        return implode('x', $size);
    }

    /**
     * Fetches the resized version of the image.
     *
     * @param string $fileName
     *   Image name.
     * @param array|null $dimensions
     *   Requested image dimensions.
     *
     * @return string
     *   Resized image absolute path.
     */
    public function getResizedImage($fileName, array $dimensions = null)
    {
        $filePath = $this->imageStoragePath.'/'.$fileName;

        // If resize parameter is received, try parse it and apply the style to
        // the image.
        $thumbnailsDirectoryName = $this->createThumbnailDirectoryName($dimensions);
        if (!empty($dimensions) && implode($dimensions) != '00' && $this->prepareThumbnailsDirectory($thumbnailsDirectoryName)) {
            $resizedFilePath = $this->imageStoragePath.'/'.$thumbnailsDirectoryName.'/'.$fileName;
            $fs = new Filesystem();
            // Both when image exits or it's smaller/bigger counterpart
            // was created - replace the filepath with the result image.
            if ($fs->exists($resizedFilePath)) {
                $filePath = $resizedFilePath;
            } elseif ($this->resize($filePath, $resizedFilePath, $dimensions)) {
                $filePath = $resizedFilePath;
            }
        }

        return $filePath;
    }

    /**
     * Resizes and stores the image.
     *
     * @param string $source
     *   Path to the source image.
     * @param string $target
     *   Path to the target (resized) image.
     * @param array $wantedDimensions
     *   Array with requested dimensions ({WIDTH}x{HEIGHT}).
     *
     * @return bool
     *   TRUE whether resizing was successful, FALSE otherwise.
     */
    private function resize($source, $target, array $wantedDimensions)
    {
        $imagine = new Imagine();
        try {
            $image = $imagine->open($source);
            $imageSize = $image->getSize();
            $originalSize = [
                'width' => $imageSize->getWidth(),
                'height' => $imageSize->getHeight(),
            ];
            $imageManipulations = $this->getResizeDimensions($originalSize,
                $wantedDimensions);
            $image->resize($imageManipulations['resize'])
                ->crop($imageManipulations['crop'],
                    $imageManipulations['final_size'])
                ->save($target, [
                    'jpeg_quality' => $this->jpegQuality,
                    'png_compression_level' => $this->pngCompressionLevel,
                ]);

            // TODO: Add logging.
        } catch (ImagineExc $e) {
            return false;
        } catch (ImagineArgExc $e) {
            return false;
        }

        return true;
    }

    /**
     * Check and optionally prepare the directory where resized images
     * are stored.
     *
     * @param string $name
     *        File name.
     * @param boolean $create
     *        Whether to create the directories.
     *
     * @return boolean TRUE if directory exists or created, FALSE otherwise.
     */
    private function prepareThumbnailsDirectory($name, $create = true)
    {
        $fs = new Filesystem();
        $path = $this->imageStoragePath.'/'.$name;
        $exists = $fs->exists($path);

        if (!$exists && $create) {
            try {
                $fs->mkdir($path);
                $exists = true;
                // TODO: Add logging.
            } catch (IOException $e) {
                return false;
            }
        }

        return $exists;
    }

    /**
     * Calculates the required sizes for image manipulations.
     *
     * This method will resize the image keeping the aspect ratio of the
     * original image. If original and target ratio match, the image is scaled
     * directly to requested sizes.
     * If target ratio is different, the image is scaled to fit the smallest
     * side and cropped from the center of the image.
     *
     * @param array $originalSize
     *        Original image size (width and height).
     * @param array $targetSize
     *        Desired target size (width and height).
     *
     * @return array A set of instructions needed to be applied to original image.
     *         - resize: size of the image to crop from (Box object).
     *         - crop: coordinates where to crop the image (Point object).
     *         - final_size: Requested image size dimensions.
     */
    private function getResizeDimensions(
        array $originalSize,
        array $targetSize
    ) {
        list ($originalWidth, $originalHeight) = array_values($originalSize);
        list ($targetWidth, $targetHeight) = array_values($targetSize);
        // Calculate the aspect ratios of original and target sizes.
        $originalAspect = round($originalWidth / $originalHeight,
            $this->aspectPrecision);
        if (!$targetHeight) {
            $targetHeight = round($targetWidth / $originalAspect);
        } elseif (!$targetWidth) {
            $targetWidth = round($targetHeight * $originalAspect);
        }
        $targetAspect = round($targetWidth / $targetHeight,
            $this->aspectPrecision);
        // Store default values which will be used by default.
        $resizeBox = new Box($targetWidth, $targetHeight);
        $finalImageSize = clone $resizeBox;
        $cropPoint = new Point(0, 0);
        // If the aspect ratios do not match, means that
        // the image must be adjusted to maintain adequate proportions.
        if ($originalAspect != $targetAspect) {
            // Get the smallest side of the image.
            // This is required to calculate target resize of the
            // image to crop from, so at least one side fits.
            $_x = $originalWidth / $targetWidth;
            $_y = $originalHeight / $targetHeight;
            $min = min($_x, $_y);
            $box_width = (int)round($originalWidth / $min);
            $box_height = (int)round($originalHeight / $min);
            $resizeBox = new Box($box_width, $box_height);
            // Get the coordinates where from to crop the final portion.
            // This one crops from the center of the resized image.
            $crop_x = $box_width / 2 - $targetWidth / 2;
            $crop_y = 0; // $box_height / 2 - $targetHeight / 2;
            $cropPoint = new Point($crop_x, $crop_y);
        }

        return [
            'resize' => $resizeBox,
            'crop' => $cropPoint,
            'final_size' => $finalImageSize,
        ];
    }
}
