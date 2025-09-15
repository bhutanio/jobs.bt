<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        // Create base roles if they do not exist
        foreach (['admin', 'job_seeker', 'employer'] as $role_name) {
            Role::findOrCreate($role_name);
        }
    }
}
