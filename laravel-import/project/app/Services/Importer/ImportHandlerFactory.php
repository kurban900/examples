<?php


namespace App\Services\Importer;

use App\Imports\ExcelImport;
use App\Models\Data;
use App\Services\Importer\Cache\RedisImportCache;
use App\Services\Uploader\File;
use Maatwebsite\Excel\Importer;


class ImportHandlerFactory
{
    public static function import(File $file, Importer $importer): void
    {
        $importCache = new RedisImportCache($file->getName());
        $data = $importer->toArray(new ExcelImport, $file->getPath());
        $data = array_shift($data);
        $import = new Import($data, $file, new Data(), $importCache);

        (new ImportHandler())->handle($import);
    }

}

