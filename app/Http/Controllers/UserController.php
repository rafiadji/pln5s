<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUser()
    {
        return response()->json(User::all());
    }

    public function getUserById($id)
    {
        return response()->json(User::find($id));
    }

    public function getLogin(Request $req)
    {
        $username = $req->input('username');
        $password = $req->input('password');

        $dt = User::where('username', '=', $username)->where('password', '=', $password)->get();
        return response()->json($dt);
    }
}
