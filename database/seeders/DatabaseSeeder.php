<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasRoles;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    use HasRoles;
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // $permissions = [
        //     'create note',
        //     'edit note',
        //     'delete note',
        //     'create user',
        //     'edit user',
        //     'delete user',
        //     'make admin',
        //     'view user notes',
        // ];

        // foreach ($permissions as $permission) {
        //     Permission::create(['name' => $permission]);
        // }

        // $role = Role::create(['name' => 'user']);
        
        // if($role->name == 'user')
        // {
        //     $role->givePermissionTo(['create note', 
        //     'edit note', 
        //     'delete note']);
        // }

        // $role = Role::create(['name' => 'admin']);

        // if($role->name == 'admin')
        // {
        //     $role->givePermissionTo(Permission::all());
        // }
        // $role->givePermissionTo(['create note',
        // 'edit note',
        // 'delete note', 
        // 'create user', 
        // 'edit user', 
        // 'delete user', 
        // 'make admin', 
        // 'view user notes']);
    }
}
