<?php

namespace App\Jobs;

use App\Models\DirectionStudy;
use App\Services\Vicon\DirectionStudy\DirectionStudyService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateDirectionStudy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $directionStudyService;


    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->directionStudyService = new DirectionStudyService();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $naprs = [];
        $naprsUuid = $this->directionStudyService->getAllNaprsUuid();
        foreach ($naprsUuid as $uuid) {
            array_push($naprs, $this->directionStudyService->getNapr($uuid));
        }
        foreach ($naprs as $napr) {
            DirectionStudy::updateOrCreate(
                ['uuid' => $napr->uuid],
                [
                    'name' => $napr->name_napr,
                    'code' => $napr->kod_napr,
                    'lvl_edu' => $napr->lvl_edu,
                ]
            );
        };
    }
}
