<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class HashExistingPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hash-existing-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hash plaintext passwords for existing users in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $count = 0;

        foreach ($users as $user) {
            // Check if password looks like plaintext (not hashed with bcrypt)
            if (!str_starts_with($user->password, '$2y$') && !str_starts_with($user->password, '$2a$') && !str_starts_with($user->password, '$2b$')) {
                $user->password = Hash::make($user->password);
                $user->save();
                $count++;
                $this->line("✓ Hashed password for: {$user->email}");
            }
        }

        $this->info("\n✓ Successfully hashed $count user passwords!");
    }
}
