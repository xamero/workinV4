<?php

namespace App\Livewire\Employer\Dashboard;

use App\Models\EmployerProfile;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        return view('livewire.employer.dashboard.index')
            ->layout('components.layouts.portal');
    }
}
