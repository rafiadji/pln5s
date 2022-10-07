<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Transaksi;

use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * @OA\Get(path="/nilai/getallpenilaian/{userId}/{tempatId}/{areaId}",
     *     tags={"Penilaian"},
     *     summary="Get All Penilaian",
     *     description="Untuk mendapatkan semua data Penilaian",
     *     operationId="getAllPenilaian",
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         description="ID User",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="tempatId",
     *         in="path",
     *         description="ID Tempat",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="areaId",
     *         in="path",
     *         description="ID Area",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
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
    public function getAllPenilaian($userId, $tempatId, $areaId)
    {
        $nilais = Penilaian::all();
        $dt = [];
        foreach ($nilais as $nilai) {
            $trans = Transaksi::where("userId", "=", $userId)
            ->where("tempatId", "=", $tempatId)
            ->where("areaId", "=", $areaId)
            ->where("penilaianId", "=", $nilai->id)
            ->orderBy("id", "desc")->first();
            $tr = 0;
            if($trans != null){
                $tr = $trans['status'];
            }
            $tmp = [
                "id" => $nilai->id,
                "penilaian" => $nilai->penilaian,
                "deskripsi" => $nilai->deskripsi,
                "status" => $tr,
            ];
            array_push($dt, $tmp);
        }
        return response()->json($dt);
    }
}
