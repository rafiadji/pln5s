<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * @OA\Post(path="/trans/submitnilai",
     *     tags={"Transaksi"},
     *     summary="Submit Nilai",
     *     description="Untuk Submit Nilai",
     *     operationId="submitNilai",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="userId",
     *                      type="integer",
     *                      description="Masukkan User Id"
     *                  ),
     *                  @OA\Property(
     *                      property="penilaianId",
     *                      type="integer",
     *                      description="Masukkan Penilaian Id"
     *                  ),
     *                  @OA\Property(
     *                      property="tempatId",
     *                      type="integer",
     *                      description="Masukkan Tempat Id"
     *                  ),
     *                  @OA\Property(
     *                      property="areaId",
     *                      type="integer",
     *                      description="Masukkan Area Id"
     *                  ),
     *                  @OA\Property(
     *                      property="tanggal",
     *                      type="integer",
     *                      description="Masukkan Tanggal"
     *                  ),
     *                  @OA\Property(
     *                      property="statusKondisi",
     *                      type="integer",
     *                      description="Masukkan Status Kondisi (Ya = 1 / Tidak = 0)"
     *                  ),
     *                  @OA\Property(
     *                      property="catatan",
     *                      type="string",
     *                      description="Masukkan Catatan"
     *                  ),
     *                  @OA\Property(
     *                      property="bukti",
     *                      type="file",
     *                      description="Masukkan Gambar bukti"
     *                  ),
     *                  @OA\Property(
     *                      property="status",
     *                      type="integer",
     *                      description="Masukkan status"
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Return json info",
     *         @OA\JsonContent(
     *           type="object",
     *           example={
     *              "success":true,
     *              "message":"Data berhasil disimpan"
     *           }
     *         ),
     *     )
     * )
     */
    public function submitNilai(Request $req)
    {
        if($req->file('bukti')){
			$file = $req->file('bukti');
			$namefile = $req->input('userId').$req->input('penilaianId').$req->input('tempatId').$req->input('areaId')."_".$req->input('tanggal').".".$file->getClientOriginalExtension();
            $file->move(storage_path('app/bukti'), $namefile);
            $image_url = base64_encode("http://" . $req->getHost() . ":8002/bukti/" . $namefile);
            $req->merge(["gambar" => $image_url]);
		}
        if(Transaksi::create($req->except(['bukti']))) {
            $dt = [
                "success" => true,
                "message" => "Data berhasil disimpan"
            ];
        }
        else {
            $dt = [
                "success" => false,
                "message" => "Data gagal disimpan"
            ];
        }
        return response()->json($dt);
    }

    /**
     * @OA\Get(path="/trans/history/{nilai}",
     *     tags={"Transaksi"},
     *     summary="Get history by penilaian",
     *     description="Untuk mendapatkan semua data Transaksi By Penilaian Id",
     *     operationId="historyNilai",
     *     @OA\Parameter(
     *         name="nilai",
     *         in="path",
     *         description="ID Penilaian",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Return Transaksi List",
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

     /**
     * @OA\Get(path="/trans/history/{nilai}/{tempatId}",
     *     tags={"Transaksi"},
     *     summary="Get history by penilaian and tempat",
     *     description="Untuk mendapatkan semua data Transaksi By Penilaian Id dan Tempat Id",
     *     operationId="historyTempat",
     *     @OA\Parameter(
     *         name="nilai",
     *         in="path",
     *         description="ID Penilaian",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="tempatId",
     *         in="path",
     *         description="ID Tempat",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Return Transaksi List",
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

     /**
     * @OA\Get(path="/trans/history/{nilai}/{tempatId}/{areaId}",
     *     tags={"Transaksi"},
     *     summary="Get history by penilaian and tempat and area",
     *     description="Untuk mendapatkan semua data Transaksi By Penilaian Id, Tempat Id dan Area Id",
     *     operationId="historyArea",
     *     @OA\Parameter(
     *         name="nilai",
     *         in="path",
     *         description="ID Penilaian",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="tempatId",
     *         in="path",
     *         description="ID Tempat",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="areaId",
     *         in="path",
     *         description="ID Area",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Return Transaksi List",
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

     /**
     * @OA\Get(path="/trans/history/{nilai}/{tempatId}/{areaId}/{id}",
     *     tags={"Transaksi"},
     *     summary="Get history by penilaian and tempat and area and user",
     *     description="Untuk mendapatkan semua data Transaksi By Penilaian Id, Tempat Id, Area Id and User Id",
     *     operationId="historyUser",
     *     @OA\Parameter(
     *         name="nilai",
     *         in="path",
     *         description="ID Penilaian",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="tempatId",
     *         in="path",
     *         description="ID Tempat",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="areaId",
     *         in="path",
     *         description="ID Area",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID User",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Return Transaksi List",
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
    public function history($nilai, $tempatId = null, $areaId = null, $id = null)
    {
        $trans = Transaksi::where("penilaianId", "=", $nilai);
        if ($tempatId != null) {
            $trans->where("tempatId", "=", $tempatId);
        }
        if ($areaId != null) {
            $trans->where("areaId", "=", $areaId);
        }
        if ($id != null) {
            $trans->where("userId", "=", $id);
        }
        $trans = $trans->get();
        $dt = [];
        foreach ($trans as $tr) {
            $tmp = [
                "id" => $tr->id,
                "userId" => $tr->userId,
                "nama" => $tr->user->nama,
                "penilaianId" => $tr->penilaianId,
                "penilaian" => $tr->penilaian->penilaian,
                "tempatId" => $tr->tempatId,
                "namaTempat" => $tr->tempat->namaTempat,
                "jenisIdTempat" => $tr->tempat->jenisId,
                "namaJenisTempat" => $tr->tempat->jenisTempat->jenis,
                "areaId" => $tr->areaId,
                "namaArea" => $tr->area->namaArea,
                "jenisIdArea" => $tr->area->jenisId,
                "namaJenisArea" => $tr->area->jenisArea->jenis,
                "tanggal" => $tr->tanggal,
                "statusKondisi" => $tr->statusKondisi,
                "catatan" => $tr->catatan,
                "gambar" => $tr->gambar,
                "status" => $tr->status,
            ];
            array_push($dt, $tmp);
        }
        return response()->json($dt);
    }
}
