<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateDvdCopyAvailability implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dvdCopyId;

    protected $available;

    /**
     * Create a new job instance.
     */
    public function __construct(string $dvdCopyId, bool $available)
    {
        $this->dvdCopyId = $dvdCopyId;
        $this->available = $available;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $dvdCopy = DvdCopy::findOrFail($this->dvdCopyId);
        $dvdCopy->update(['available' => $this->available]);
    }
}
