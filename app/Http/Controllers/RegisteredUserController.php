<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $faker = \Faker\Factory::create();
        $attribute = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)->max(20)],
        ]);
        $email = User::where('email', request('email'))->first();
        if ($email) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, but user with this email already exists.'
            ]);
        }
        $user_uuid = $faker->uuid();
        $attributes = [
            'user_uuid' => $user_uuid,
            'first_name' => $attribute['first_name'],
            'last_name' => $attribute['last_name'],
            'email' => $attribute['email'],
            'password' => $attribute['password'],
        ];
        $user = User::create($attributes);
        Auth::login($user);
        return redirect('/pop-up');
    }
}
