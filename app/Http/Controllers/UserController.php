<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
class UserController extends Controller
{
    /**
     * @OA\GET(path="/user/getalluser",
     *     tags={"User"},
     *     summary="Get All User",
     *     description="Untuk mendapatkan semua data user",
     *     operationId="getAllUser",
     *     @OA\Response(
     *         response="200",
     *         description="Return All Data User"
     *     )
     * )
     */
    public function getAllUser()
    {
        return response()->json(User::all());
    }

    /**
     * @OA\GET(path="/user/getuserbyid/{id}",
     *     tags={"User"},
     *     summary="Get User By ID",
     *     description="Untuk mendapatkan data user berdasarkan id",
     *     operationId="getUserById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID user",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Return Data User by Id"
     *     )
     * )
     */
    public function getUserById($id)
    {
        return response()->json(User::find($id));
    }

    /**
     * @OA\POST(path="/user/getlogin",
     *     tags={"User"},
     *     summary="Login",
     *     description="Untuk Login User",
     *     operationId="getLogin",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="username",
     *                      type="string",
     *                      description="Masukkan Username"
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string",
     *                      description="Masukkan Password"
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Return Data User yang login"
     *     )
     * )
     */
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
                    "role" => $user->role,
                ]
            ];
            return response()->json($dt);
        }
        else {
            $dt = [
                "success" => false,
                "message" => "username atau password salah",
                "data" => [
                    "id" => -1,
                    "username" => "",
                    "nama" => "",
                    "role" => -1,
                ]
            ];
            return response()->json($dt);
        }
    }

    /**
     * @OA\POST(path="/user/register",
     *     tags={"User"},
     *     summary="Register",
     *     description="Untuk Registrasi user",
     *     operationId="register",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="username",
     *                      type="string",
     *                      description="Masukkan Username"
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string",
     *                      description="Masukkan Password"
     *                  ),
     *                  @OA\Property(
     *                      property="nama",
     *                      type="string",
     *                      description="Masukkan Nama"
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Return json info"
     *     )
     * )
     */
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
