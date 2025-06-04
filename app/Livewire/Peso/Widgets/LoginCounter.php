<?php

namespace App\Livewire\Peso\Widgets;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\LoginLog;

class LoginCounter extends Component
{
    public function render()
    {
        $login_counter = LoginLog::selectRaw("
    COUNT(CASE WHEN DATE(login_time) = ? THEN 1 END) as total_today,
    COUNT(CASE WHEN MONTH(login_time) = ? AND YEAR(login_time) = ? THEN 1 END) as total_this_month,
    COUNT(CASE WHEN YEAR(login_time) = ? THEN 1 END) as total_this_year,
    MAX(login_time) as last_login_time,
    (SELECT user_id FROM login_logs ORDER BY login_time DESC LIMIT 1) as last_login_user
", [
            Carbon::today()->toDateString(),
            now()->month,
            now()->year,
            now()->year,
        ])->first();

        return view('livewire.peso.widgets.login-counter', ['login_counter' => $login_counter]);
    }
}
