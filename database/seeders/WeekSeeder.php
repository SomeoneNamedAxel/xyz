<?php

namespace Database\Seeders;

use App\Models\Week;
use App\Services\WeekService;
use Illuminate\Database\Seeder;

class WeekSeeder extends Seeder
{
    /**
     * Inject WeekService.
     */
    public function __construct(
        protected WeekService $service
    ) {
        //
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weeks = $this->service
            ->previousUntil(6, now()->addYear())
            ->map(fn ($period) => [
                'year' => $period->getStartDate()->get('year'),
                'week_number' => $period->getStartDate()->get('week'),
                'week_starts_at' => $period->getStartDate()->format("Y-m-d H:i:s"),
                'week_ends_at' => $period->getEndDate()->format("Y-m-d H:i:s"),
            ]);

        foreach ($weeks as $week) {
            Week::firstOrCreate(
                [
                    'year' => $week['year'],
                    'week_number' => $week['week_number']
                ],
                [
                    'week_starts_at' => $week['week_starts_at'],
                    'week_ends_at' => $week['week_ends_at']
                ]
            );
        }


        //Week::insert($weeks->toArray());
    }
}
