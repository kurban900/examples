<?php


namespace App\Services\Importer\Cache;

use Illuminate\Support\Facades\Redis;

class RedisImportCache implements ImportCache
{
    private const PREFIX = 'imported-file:';

    private string $key;

    public function __construct(private string $uniqueKey)
    {
        $this->key = self::PREFIX . $this->uniqueKey;
    }

    public function getImportedTotalRows(): int
    {
        return Redis::get($this->key) ?? 0;
    }

    public function setImportedTotalRows($value): void
    {
        Redis::set($this->key, $value);
    }
}
