<?php

namespace App\Http\Controllers;

use App\Models\JenisTempat;
use App\Models\Tempat;

use Illuminate\Http\Request;

class TempatController extends Controller
{
    /**
     * @OA\Get(path="/tempat/getjenistempat",
     *     tags={"Tempat"},
     *     summary="Get Jenis Tempat",
     *     description="Untuk mendapatkan semua data Jenis Tempat",
     *     operationId="getJenisTempat",
     *     @OA\Response(
     *         response="200",
     *         description="Return Jenis Tempat",
     *         @OA\JsonContent(
     *           type="object",
     *           example= {
     *              {
     *                  "id":0,
     *                  "jenis":""
     *              }
     *           }
     *         ),
     *     )
     * )
     */
    public function getJenisTempat()
    {
        $jenistempats = JenisTempat::all();
        $dt = [];
        foreach ($jenistempats as $jntempat) {
            $tmp = [
                "id" => $jntempat->id,
                "jenis" => $jntempat->jenis,
            ];
            array_push($dt, $tmp);
        }
        return response()->json($dt);
    }

    /**
     * @OA\Get(path="/tempat/gettempatbyjenis/{id}",
     *     tags={"Tempat"},
     *     summary="Get Tempat By Jenis",
     *     description="Untuk mendapatkan semua data Tempat by jenis",
     *     operationId="getTempatByJenis",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID Jenis",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Return Tempat List",
     *         @OA\JsonContent(
     *           type="object",
     *           example= {
     *              {
     *                  "id":0,
     *                  "namaTempat":"",
     *                  "jenisId":0,
     *                  "jenis":""
     *              }
     *           }
     *         ),
     *     )
     * )
     */
    public function getTempatByJenis($id)
    {
        $areas = Tempat::where("jenisId", "=", $id)->get();
        $dt = [];
        foreach ($areas as $area) {
            $tmp = [
                "id" => $area->id,
                "namaTempat" => $area->namaTempat,
                "jenisId" => $area->jenisId,
                "jenis" => $area->jenisTempat->jenis,
            ];
            array_push($dt, $tmp);
        }
        return response()->json($dt);
    }

    /**
     * @OA\Get(path="/tempat/getalltempat",
     *     tags={"Tempat"},
     *     summary="Get All Tempat",
     *     description="Untuk mendapatkan semua data Tempat",
     *     operationId="getAllTempat",
     *     @OA\Response(
     *         response="200",
     *         description="Return All Data Tempat",
     *         @OA\JsonContent(
     *           type="object",
     *           example= {
     *              {
     *                  "id":0,
     *                  "namaTempat":"",
     *                  "jenisId":0,
     *                  "jenis":""
     *              }
     *           }
     *         ),
     *     )
     * )
     */
    public function getAllTempat()
    {
        $tempats = Tempat::all();
        $dt = [];
        foreach ($tempats as $tempat) {
            $tmp = [
                "id" => $tempat->id,
                "namaTempat" => $tempat->namaTempat,
                "jenisId" => $tempat->jenisId,
                "jenis" => $tempat->jenisTempat->jenis,
            ];
            array_push($dt, $tmp);
        }
        return response()->json($dt);
    }
}
