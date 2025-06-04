<?php

namespace App\Livewire\Peso\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class CreatedProfileCounter extends Component
{

    public function render()
    {
        $counts = User::selectRaw("
          COUNT(*) as total_count,
    COUNT(CASE WHEN DATE(created_at) = ? THEN 1 END) as created_today,
    COUNT(CASE WHEN MONTH(created_at) = ? AND YEAR(created_at) = ? THEN 1 END) as created_this_month,
    COUNT(CASE WHEN YEAR(created_at) = ? THEN 1 END) as created_this_year
", [
            Carbon::today()->toDateString(),
            now()->month,
            now()->year,
            now()->year,
        ])->first();


        $created_profile_today = User::whereDate('created_at', Carbon::today())->count();
        $created_profile_month = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $created_profile_year = User::whereYear('created_at', Carbon::now()->year)->count();

        return view('livewire.peso.widgets.created-profile-counter',
            ['created_profile_today' => $created_profile_today,
                'created_profile_month' => $created_profile_month,
                'created_profile_year' => $created_profile_year,
                'counts' => $counts
            ]);
    }
}
