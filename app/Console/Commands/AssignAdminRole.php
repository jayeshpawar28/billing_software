<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;

class AssignAdminRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:admin-role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign admin role to admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $admin = User::where('username', 'admin')->first();
        $adminRole = Role::where('name', 'admin')->first();

        if (!$admin) {
            $this->error('Admin user not found');
            return;
        }

        if (!$adminRole) {
            $this->error('Admin role not found');
            return;
        }

        $admin->roles()->sync([$adminRole->id]);
        $this->info('Admin role assigned successfully to admin user');
    }
}
