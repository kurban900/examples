<?php

namespace Tests;

use App\Models\Data;
use App\Services\Importer\Cache\DummyImportCache;
use App\Services\Importer\Import;
use App\Services\Uploader\File;

class ImportTestBuilder
{
    private array $data = [];
    private int $limit;

    public function build(): Import
    {
        $model = new Data();
        $dummyCache = new DummyImportCache(0);

        $import = new Import($this->data, new File('text.xls'), $model, $dummyCache);
        $import->setImportLimit($this->limit);

        return $import;
    }

    public function setData($data): static
    {
        $this->data = $data;
        return $this;
    }

    public function setImportLimit($limit): static
    {
        $this->limit = $limit;
        return $this;
    }
}
