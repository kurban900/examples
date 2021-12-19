<?php


namespace App\UseCases;


use App\Events\FileIsUploaded;
use App\Http\Requests\ExcelUploadRequest;
use App\Services\Uploader\FileUploader;

class FileUploadHandler
{
    public function __construct(private FileUploader $uploader)
    {
    }

    public function handle(ExcelUploadRequest $request): void
    {
        $uploadedFile = $this->uploader->upload($request->file('file'));

        event(new FileIsUploaded($uploadedFile));
    }
}
