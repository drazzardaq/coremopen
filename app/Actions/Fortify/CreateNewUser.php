<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Status;
use App\Models\Priority;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        Status::create(['user_id' => $user->id, 'name' => 'Active', 'color' => 'text-accent', 'icon' => 'play-circle']);
        Status::create(['user_id' => $user->id, 'name' => 'Paused', 'color' => 'text-sky-500', 'icon' => 'pause-circle']);
        Status::create(['user_id' => $user->id, 'name' => 'Canceled', 'color' => 'text-warning', 'icon' => 'times-circle']);
        Status::create(['user_id' => $user->id, 'name' => 'Completed', 'color' => 'text-emerald-500', 'icon' => 'check-circle']);
        Status::create(['user_id' => $user->id, 'name' => 'N/A', 'color' => 'text-gray-400', 'icon' => 'question-circle']);
        Priority::create(['user_id' => $user->id, 'name' => 'N/A', 'color' => 'text-gray-400']);
        Priority::create(['user_id' => $user->id, 'name' => 'Low', 'color' => 'text-orange-400']);
        Priority::create(['user_id' => $user->id, 'name' => 'Medium', 'color' => 'text-red-400']);
        Priority::create(['user_id' => $user->id, 'name' => 'High', 'color' => 'text-warning']);

        return $user;
    }
}
