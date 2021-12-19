<?php


namespace App\Services\Uploader;


use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;

class FileUploader
{
    public function __construct(private Filesystem $filesystem)
    {
    }

    public function upload(UploadedFile $file): File
    {
        $this->filesystem->put('/',$file);

        return new File($file->hashName());
    }
}
