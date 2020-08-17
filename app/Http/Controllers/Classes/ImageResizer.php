<?php


namespace App\Http\Controllers\Classes;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Imagick;
use ImagickException;

class ImageResizer
{

    private Imagick $imagick;
    private string $extension;


    public function __construct($path = null)
    {
        if (isset($path)) {
            try {
                $this->initImagick($path);
            } catch (ImagickException $e) {

            }


        }
    }

    /**
     * @param string $path
     * @param string $extension
     * @param int $compression
     * @param int $scheme
     * @return Imagick
     * @throws ImagickException
     */
    private function initImagick(string $path,
                                 string $extension = 'jpg',
                                 int $compression = 90,
                                 $scheme = Imagick::INTERLACE_JPEG): Imagick
    {
        // Create Imagick object
        $this->imagick = new Imagick(Storage::path($path));
        $this->extension = $extension;


        // Define imagick object format interlace
        $this->imagick->setFormat($extension);
        $this->imagick->setImageFormat($extension);
        $this->imagick->setInterlaceScheme($scheme);

        // Set image compression quality
        $this->imagick->setImageCompressionQuality($compression);


        return $this->imagick;

    }

    /**
     * @param string $path
     * @param int|null $width
     * @param int|null $height
     * @return string
     */
    private function createNewPath(string $path, int $width = null, int $height = null): string
    {
        $newPath = '';


        // Create new path string
        $newPath .= File::dirname($path);
        $newPath .= '/';

        // if width and height isset create path for thumbs
        $newPath .= isset($width, $height) ? $width . '_' . $height . '_' : '';

        $newPath .= File::name($path);
        $newPath .= '.';
        $newPath .= $this->extension;


        return $newPath;


    }

    /**
     * @param string $path
     * @param int $width
     * @param int $height
     * @return string
     * @throws ImagickException
     */
    public function scaleMainImage(string $path, int $width = 1140, int $height = 0): string
    {

        $this->initImagick($path);

        if ($height === 0) {
            $height = $this->imagick->getImageHeight();
        }

        $newPath = $this->createNewPath($path);

        $this->imagick->scaleImage($width, $height, true);

        $this->saveFile($newPath);

        $this->clearImagick();


        if ($path !== $newPath) {
            // Remove first uploaded file
            Storage::delete($path);

        }


        return $newPath;
    }


    /**
     * @param string $path
     * @param int|array $widthOrArr
     * @param int|null $height
     * @throws ImagickException
     */
    public function createThumb(string $path, array $widthOrArr, int $height = null)
    {

        if (is_array($widthOrArr)) {

            $width = $widthOrArr['w'];

            $height = $widthOrArr['h'];
        } else {
            $width = $widthOrArr;
        }


        $this->initImagick($path);


        $this->imagick->cropThumbnailImage($width, $height);

        $newPath = $this->createNewPath($path, $width, $height);

        $this->saveFile($newPath);

        $this->clearImagick();


    }


    /**
     * @param string $newPath
     */
    private function saveFile(string $newPath)
    {
        $this->imagick->writeImage(Storage::path($newPath));
    }


    private function clearImagick()
    {
        $this->imagick->clear();
    }

}
