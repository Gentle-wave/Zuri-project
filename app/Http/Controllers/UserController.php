<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'min:3', 'max:75'],
            'email' => ['required', 'emain', 'unique:users'],
            'password' => ['required', 'string', 'confirm', 'min:8'],
        ]);

        return User::create($request->only('name', 'email') + [ 'password' => Hash::make($request->password)]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'emain', 'exists:users'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($this->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        return [
            'success' => true,
            'session' => Session::getId()
        ];
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => ['sometimes', 'string', 'min:3', 'max:75'],
            'email' => ['sometimes', 'emain', 'unique:users'],
        ]);

        $user->update($request->validated());

        return $user;
    }

    public function delete(User $user)
    {
        $user->delete();

        return [
            'message' => 'User deleted.'
        ];
    }

    public function user(User $user)
    {
        return $user;
    }

    public function users()
    {
        return User::all();
    }
}
