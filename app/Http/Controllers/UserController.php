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

        $user = User::where('username', '=', $username)->where('password', '=', $password)->first();
        if(!empty($user)) {
            $dt = [
                "success" => true,
                "message" => "berhasil login",
                "data" => [
                    "id" => $user->id,
                    "username" => $user->username,
                    "nama" => $user->nama,
                ]
            ];
            return response()->json($dt);
        }
        else {
            $dt = [
                "success" => false,
                "message" => "username atau password salah",
                "data" => [
                    "id" => 0,
                    "username" => "",
                    "nama" => "",
                ]
            ];
            return response()->json($dt);
        }
    }

    public function register(Request $req)
    {
        $req['role'] = 1;
        if(User::create($req->all())) {
            $dt = [
                "success" => true,
                "message" => "Data berhasil disimpan"
            ];
            return response()->json($dt);
        }
        else {
            $dt = [
                "success" => false,
                "message" => "Data gagal disimpan"
            ];
            return response()->json($dt);
        }
    }
}
