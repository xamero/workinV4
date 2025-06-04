<?php

namespace App\Livewire\Administrator;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use App\Models\User;

class ManageUserRoles extends Component
{

    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $roles, $selectedUser, $selectedRoles = [];
    public $search = ''; // Search field

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset to first page when searching
    }

    public function selectUser($userId)
    {
        $this->selectedUser = User::findOrFail($userId);
        $this->selectedRoles = $this->selectedUser->roles->pluck('name')->toArray();
    }

    public function updateRoles()
    {
        if ($this->selectedUser) {
            $this->selectedUser->syncRoles($this->selectedRoles);
            session()->flash('message', 'Roles updated successfully.');
        }
    }

    public function render()
    {
        return view('livewire.administrator.manage-user-roles', [
            'users' => User::where('name', 'like', "%{$this->search}%")->paginate(15),
        ])->layout('components.layouts.portal', ['header' => 'Manage User Roles']);
    }
}