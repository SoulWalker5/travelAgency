<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name'] = $this->ask('Enter user\'s name');
        $user['email'] = $this->ask('Enter user\'s email');
        $user['password'] = $this->secret('Enter user\'s password');

        $roleName = $this->choice('Choose user\'s role', Role::$roles, 1);

        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            $this->error('Role not found');

            return self::INVALID;
        }

        $validator = Validator::make($user, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Password::default()],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::INVALID;
        }

        DB::transaction(function () use ($role, $user) {
            $user = User::create($user);
            $user->roles()->attach($role->id);
        });

        $this->info('User ' . $user['email'] . ' - is created');
        $this->info('Role ' . $roleName . ' - is assigned to user');
    }
}
