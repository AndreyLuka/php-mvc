<?php

namespace App\Services;

/**
 * Class ImageUpload.
 */
class ImageUpload
{
    /**
     * Upload file and return filename.
     * @param array $file $_FILE array
     * @param int $maxWidth
     * @param int $maxHeight
     * @return string
     * @throws \Exception
     */
    public function upload($file, $maxWidth, $maxHeight)
    {
        $this->validateType($file['type']);

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $destination = DIR_UPLOADS_ABS . '/' . $filename;

        if (!is_dir(DIR_UPLOADS_ABS)) {
            mkdir(DIR_UPLOADS_ABS);
        }

        if (!$this->validateSize($file['tmp_name'], $maxWidth, $maxHeight)) {
            $this->resize($maxWidth, $maxHeight, $file['tmp_name'], $destination);
            return $filename;
        }

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new \Exception('Error uploading file.');
        }

        return $filename;
    }

    /**
     * Delete file.
     * @param string $filename Path to file
     * @return bool
     */
    public function delete($filename)
    {
        $destination = DIR_UPLOADS_ABS . '/' . $filename;

        if (file_exists($destination)) {
            unlink($destination);
        }

        return true;
    }

    /**
     * Validate file.
     * @param string $fileType
     * @return bool
     * @throws \Exception
     */
    public function validateType($fileType)
    {
        $allowedTypes = ['image/jpeg', 'image/gif', 'image/png'];

        if(!in_array($fileType, $allowedTypes) ) {
            throw new \Exception('File extension not allowed. Allowed only: .jpg, .gif. .png');
        }

        return true;
    }

    /**
     * @param string $sourceFile
     * @param int $maxWidth
     * @param int $maxHeight
     * @return bool
     */
    public function validateSize($sourceFile, $maxWidth, $maxHeight)
    {
        $imageSize = getimagesize($sourceFile);
        $width = $imageSize[0];
        $height = $imageSize[1];

        if ($width > $maxWidth || $height > $maxHeight) {
            return false;
        }

        return true;
    }

    /**
     * Resize image.
     * @param int $maxWidth
     * @param int $maxHeight
     * @param string $sourceFile
     * @param string $destination
     * @param int $qualityJpg
     * @param int $qualityPng
     * @return bool
     */
    public function resize($maxWidth, $maxHeight, $sourceFile, $destination, $qualityJpg = 80, $qualityPng = 6) {
        $imageSize = getimagesize($sourceFile);
        $width = $imageSize[0];
        $height = $imageSize[1];
        $mime = $imageSize['mime'];

        switch ($mime) {
            case 'image/gif':
                $imageCreate = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $imageCreate = "imagecreatefrompng";
                $image = "imagepng";
                $quality = $qualityPng;
                break;

            case 'image/jpeg':
                $imageCreate = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = $qualityJpg;
                break;

            default:
                return false;
                break;
        }

        $destinationImage = imagecreatetruecolor($maxWidth, $maxHeight);
        $sourceImage = $imageCreate($sourceFile);

        $widthNew = $height * $maxWidth / $maxHeight;
        $heightNew = $width * $maxHeight / $maxWidth;

        if ($widthNew > $width) {
            $hPoint = (($height - $heightNew) / 2);
            imagecopyresampled($destinationImage, $sourceImage, 0, 0, 0, $hPoint, $maxWidth, $maxHeight, $width, $heightNew);
        } else {
            $wPoint = (($width - $widthNew) / 2);
            imagecopyresampled($destinationImage, $sourceImage, 0, 0, $wPoint, 0, $maxWidth, $maxHeight, $widthNew, $height);
        }

        isset($quality) ?
            $image($destinationImage, $destination, $quality) : $image($destinationImage, $destination);

        if ($destinationImage) {
            imagedestroy($destinationImage);
        }
        if ($sourceImage) {
            imagedestroy($sourceImage);
        }
    }
}
