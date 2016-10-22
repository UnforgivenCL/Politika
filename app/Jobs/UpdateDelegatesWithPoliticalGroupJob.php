<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\DelegatesRepository;

class UpdateDelegatesWithPoliticalGroupJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $delegatesRepo;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->delegatesRepo = app(DelegatesRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->delegatesRepo->createDelegatesFromAPI();
    }
}
