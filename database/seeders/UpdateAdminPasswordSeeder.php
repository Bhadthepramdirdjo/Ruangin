<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UpdateAdminPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@ruangin.com')->first();
        
        if ($admin) {
            $admin->password = Hash::make('adminganteng123');
            $admin->save();
            $this->command->info('Password admin berhasil di-update dengan Bcrypt hash.');
        } else {
            $this->command->warn('Admin user tidak ditemukan.');
        }
    }
}
