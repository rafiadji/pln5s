<?php

namespace App\Http\Controllers;

use App\Models\JenisTempat;
use App\Models\Tempat;

use Illuminate\Http\Request;

class TempatController extends Controller
{
    /**
     * @OA\GET(path="/tempat/getalltempat",
     *     tags={"Tempat"},
     *     summary="Get All Tempat",
     *     description="Untuk mendapatkan semua data Tempat",
     *     operationId="getAllTempat",
     *     @OA\Response(
     *         response="200",
     *         description="Return All Data Tempat"
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
