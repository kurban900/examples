<?php


namespace App\Services\Uploader;


class File
{
    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return storage_path('app/public/docs/') . $this->name;
    }
}
