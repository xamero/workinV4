<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //permission for admin
        $adminPermissions =[
          'view user', 'add user', 'update user', 'delete user'
        ];

        foreach ($adminPermissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        $adminRole = Role::create(['name' => 'administrator']);
        $adminRole->givePermissionTo([ 'view user', 'add user', 'update user', 'delete user']);

        $user = \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@ilocosnorte.gov.ph',
            'password' =>  Hash::make('erwinmaximo'),
            'email_verified_at' => now()
        ]);

        $user->assignRole($adminRole);

        //permission for peso
        $pesoPermissions = ['modify vacancy', 'modify company'];

        foreach ($pesoPermissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        $pesoRole = Role::create(['name' => 'peso']);
        $pesoRole->givePermissionTo(['modify vacancy', 'modify company']);

        $user = \App\Models\User::factory()->create([
            'name' => 'Peso',
            'email' => 'peso@ilocosnorte.gov.ph',
            'password' =>  Hash::make('erwinmaximo'),
            'email_verified_at' => now()
        ]);
        $user->assignRole($pesoRole);


        //permission for employers/peso
        $empesoPermissions = ['view vacancy', 'add vacancy', 'update vacancy', 'delete vacancy'];
        foreach ($empesoPermissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }
        $pesoRole->givePermissionTo(['view vacancy', 'add vacancy', 'update vacancy', 'delete vacancy']);

        //permission for employers
        $empPermissions = ['view applicants', 'feedback applicants', 'update company'];
        foreach ($empPermissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        $empRole = Role::create(['name' => 'employer']);
        $empRole->givePermissionTo(['view applicants', 'feedback applicants', 'update company','view vacancy', 'add vacancy', 'update vacancy', 'delete vacancy']);

        $user = \App\Models\User::factory()->create([
            'name' => 'Employer',
            'email' => 'employer@ilocosnorte.gov.ph',
            'password' =>  Hash::make('erwinmaximo'),
            'email_verified_at' => now()
        ]);
        $user->assignRole($empRole);

        //permission for applicants
        $appPermissions = ['create profile', 'update profile', 'delete profile', 'apply vacancy'];

        foreach ($appPermissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }
        $appRole = Role::create(['name' => 'applicant']);
        $appRole->givePermissionTo(['create profile', 'update profile', 'delete profile', 'view vacancy', 'apply vacancy']);

        $user = \App\Models\User::factory()->create([
            'name' => 'Applicant',
            'email' => 'applicant@ilocosnorte.gov.ph',
            'password' =>  Hash::make('erwinmaximo'),
            'email_verified_at' => now()
        ]);
        $user->assignRole($appRole);
    }
}
