<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use ChileanCongress;
use App\Repositories\DelegatesRepository;
use DB;

class UpdateDelegatesWithPoliticalGroupJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $delegates = ChileanCongress::delegate()->setDelegates()->getDelegates()->fetch();
        $repo = app(DelegatesRepository::class);

        foreach ($delegates['Diputado'] as $delegate) {
            $_id = array_get($delegate, 'DIPID');

            if (empty($delegate) || empty($_id)) {
                return;
            }

            $d = $repo->findById($_id);

            if ($d !== null) {
                return $d;
            }

            DB::collection('delegates')->insert(['_id' => $_id, 'data' => $delegate]);
        }

        $repo->updateDelegatesPoliticalGroup();
    }
}
