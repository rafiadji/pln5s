<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;

use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * @OA\Get(path="/nilai/getallpenilaian",
     *     tags={"Penilaian"},
     *     summary="Get All Penilaian",
     *     description="Untuk mendapatkan semua data Penilaian",
     *     operationId="getAllPenilaian",
     *     @OA\Response(
     *         response="200",
     *         description="Return All Data Penilaian",
     *         @OA\JsonContent(
     *           type="object",
     *           example= {
     *              {
     *                  "id":1,
     *                  "penilaian":"Seiri",
     *                  "deskripsi":"....."
     *              },
     *              {
     *                  "id":2,
     *                  "penilaian":"Seiton",
     *                  "deskripsi":"....."
     *              },
     *              {
     *                  "id":3,
     *                  "penilaian":"Seiso",
     *                  "deskripsi":"....."
     *              },
     *              {
     *                  "id":4,
     *                  "penilaian":"Seiketsu",
     *                  "deskripsi":"....."
     *              },
     *              {
     *                  "id":5,
     *                  "penilaian":"Shitsuke",
     *                  "deskripsi":"....."
     *              },
     *           },
     *         ),
     *     )
     * )
     */
    public function getAllPenilaian()
    {
        $nilais = Penilaian::all();
        $dt = [];
        foreach ($nilais as $nilai) {
            $tmp = [
                "id" => $nilai->id,
                "penilaian" => $nilai->penilaian,
                "deskripsi" => $nilai->deskripsi,
            ];
            array_push($dt, $tmp);
        }
        return response()->json($dt);
    }
}
