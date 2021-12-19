<?php

namespace App\Events;

use App\Services\Uploader\File;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImportPartCompleted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(private File $file, public int $totalImportedRows)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel('importing');
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function broadcastAs(): string
    {
        return 'import.part_completed';
    }
}
