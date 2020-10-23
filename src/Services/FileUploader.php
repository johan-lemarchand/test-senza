<?php
namespace App\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;

    }

    /**
     * Upload d'une image
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file)
    {

        $fileName = uniqid().'.'.$file->guessExtension();
        $file->move($this->getTargetDirectory(), $fileName);
        return $fileName;
    }


}
