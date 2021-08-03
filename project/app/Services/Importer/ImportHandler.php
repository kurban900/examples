<?php

namespace App\Services\Importer;

use App\Events\ImportCompleted;
use App\Events\ImportPartCompleted;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportHandler
{
    public function handle(Import $import): void
    {
        $insertedData = array_map(fn($row) => [
            'name' => $row[1],
            'date' => $this->convertExcelToDateTime($row[2]),
        ], $import->getAllData());

        $import->insertToDb($insertedData);

        if ($import->isCompleted()) {
            event(new ImportCompleted());
            return;
        }
        event(new ImportPartCompleted($import->getUploadedFile(), $import->getImportedTotalRows()));
    }

    private function convertExcelToDateTime($date)
    {
        return is_int($date) || is_float($date)
            ? Date::excelToDateTimeObject($date)
            : $date;
    }
}
