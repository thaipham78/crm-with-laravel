<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('limit')) {
            $limit = $request->input('limit');
        } else {
            $limit = 5;
        }

        if ($request->has('offset')) {
            $offset = $request->input('offset');
        } else {
            $offset = 0;
        }

        $success = User::skip($offset)->take($limit)->get();
        return $success;
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string',
            'role' => 'required|string'
        ]);
        $success = $user::create($validated);
        return $success;
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $queryUser = User::where('name', $request->input('name'))->first();
        if ($queryUser->password == $request->input('password')) {
            $token =$queryUser->createToken("Api Token");
            $role=Role::where('name',$queryUser->role)->first();
            $queryUser->assignRole($role);
            return ['token' => $token->plainTextToken];
        };

    }

    public function show(string $id)
    {
        $success = User::find($id);
        return $success;
    }

    public function update(Request $request, $id, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string',
            'role' => 'required|string',
            'email' => 'required|string',
        ]);

        $success = $user::where('id', $id)->update($validated);
        return $success;
    }

    public function destroy(User $user, $id)
    {
        $success = $user::where('id', $id)->delete();
        return $success;
    }
}
