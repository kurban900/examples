<?php


namespace App\Services\Importer\Cache;


interface ImportCache
{
    public function getImportedTotalRows(): int;

    public function setImportedTotalRows($value): void;
}
