<div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <!-- Search Bar -->
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Search users..."
                        wire:model.live="search">
                </div>
                  <!-- Role Management Section -->
                @if ($selectedUser)
                    <div class="mt-4">
                        <h4 class="mb-3">Assign Roles to {{ $selectedUser->name }}</h4>
                        <div class="mb-3">
                            @foreach ($roles as $role)
                                <label class="me-3">
                                    <input type="checkbox" value="{{ $role->name }}" wire:model="selectedRoles">
                                    {{ $role->name }}
                                </label>
                            @endforeach
                        </div>
                        <button class="btn btn-primary" wire:click="updateRoles">Update Roles</button>
                    </div>
                @endif

                <!-- Users Table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" wire:click="selectUser({{ $user->id }})">
                                        Manage Roles
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-end">
                    {{ $users->links() }}
                </div>

              
            </div>
        </div>
    </div>


</div>
