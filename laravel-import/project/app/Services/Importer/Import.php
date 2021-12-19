<?php


namespace App\Services\Importer;

use App\Services\Importer\Cache\ImportCache;
use App\Services\Uploader\File;
use Illuminate\Database\Eloquent\Model;

class Import
{
    private int $totalRows;
    private int $importLimit = 1000;
    private int $importedTotalRows;

    public function __construct(
        private array $importData,
        private File $uploadedFile,
        private Model $model,
        private ImportCache $cache)
    {
        $this->totalRows = $this->setTotalRows();
        $this->importedTotalRows = $this->cache->getImportedTotalRows();
    }

    public function getImportedTotalRows(): int
    {
        return $this->importedTotalRows;
    }

    public function addImportedTotalRows(int $total): void
    {
        $this->importedTotalRows += $total;
        $this->cache->setImportedTotalRows($this->importedTotalRows);
    }

    private function setTotalRows(): int
    {
        return count($this->importData);
    }

    public function getTotalRows(): int
    {
        return $this->totalRows;
    }

    public function getAllData(): array
    {
        return array_slice($this->importData, $this->importedTotalRows, $this->importLimit);
    }

    public function isCompleted(): bool
    {
        return $this->importedTotalRows >= $this->totalRows;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function insertToDb(array $data): void
    {
        $this->model->insert($data);
        $this->addImportedTotalRows(count($data));
    }

    public function getUploadedFile(): File
    {
        return $this->uploadedFile;
    }

    public function setImportLimit(int $limit): void
    {
        $this->importLimit = $limit;
    }
}
