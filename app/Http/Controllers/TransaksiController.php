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
     * @OA\Get(path="/trans/history/{id}",
     *     tags={"Transaksi"},
     *     summary="Get Transaksi By User Id",
     *     description="Untuk mendapatkan semua data Transaksi By User Id",
     *     operationId="history",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID User",
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
    public function history($id)
    {
        $trans = Transaksi::where("userId", "=", $id)->get();
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
