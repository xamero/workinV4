<?php

namespace App\Livewire\Peso\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.peso.dashboard.index')->layout('components.layouts.portal');
    }
}
