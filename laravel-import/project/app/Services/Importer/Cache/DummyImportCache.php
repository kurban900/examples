<?php


namespace App\Services\Importer\Cache;


class DummyImportCache implements ImportCache
{
    public function __construct(private int $totalRows = 0)
    {
    }

    public function getImportedTotalRows(): int
    {
        return  $this->totalRows;
    }

    public function setImportedTotalRows($value): void
    {
        $this->totalRows = $value;
    }
}
