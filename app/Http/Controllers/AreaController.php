<?php

namespace App\Http\Controllers;

use App\Models\JenisArea;
use App\Models\Area;

use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * @OA\GET(path="/area/getjenisarea",
     *     tags={"Area"},
     *     summary="Get Jenis Area",
     *     description="Untuk mendapatkan semua data Jenis Area",
     *     operationId="getJenisArea",
     *     @OA\Response(
     *         response="200",
     *         description="Return Jenis Area",
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
    public function getJenisArea()
    {
        $jenisareas = JenisArea::all();
        $dt = [];
        foreach ($jenisareas as $jnarea) {
            $tmp = [
                "id" => $jnarea->id,
                "jenis" => $jnarea->jenis,
            ];
            array_push($dt, $tmp);
        }
        return response()->json($dt);
    }

    /**
     * @OA\GET(path="/area/getareabyjenis/{id}",
     *     tags={"Area"},
     *     summary="Get Area By Jenis",
     *     description="Untuk mendapatkan semua data Area by jenis",
     *     operationId="getAreaByJenis",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID Jeniss",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Return Area List",
     *         @OA\JsonContent(
     *           type="object",
     *           example= {
     *              {
     *                  "id":0,
     *                  "namaArea":"",
     *                  "jenisId":0,
     *                  "jenis":""
     *              }
     *           }
     *         ),
     *     )
     * )
     */
    public function getAreaByJenis($id)
    {
        $areas = Area::where("jenisId", "=", $id)->get();
        $dt = [];
        foreach ($areas as $area) {
            $tmp = [
                "id" => $area->id,
                "namaArea" => $area->namaArea,
                "jenisId" => $area->jenisId,
                "jenis" => $area->jenisArea->jenis,
            ];
            array_push($dt, $tmp);
        }
        return response()->json($dt);
    }
}
