<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catatan\CreateRequest;
use App\Http\Requests\Catatan\UpdateRequest;
use App\Models\Catatan;

class CatatanController extends Controller
{
    protected $catatanModel;
    public function __construct()
    {
        $this->catatanModel = new Catatan();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json([
                "status" => true,
                "message" => "Data berhasil diambil",
                "data" => $this->catatanModel->get()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => "Data gagal diambil",
            ],422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        try {
            if (isset($request->validator) && $request->validator->fails()) {
                return response()->json([ 
                    "status" => false,
                    "message" => $request->validator->errors()],422);
            }

            $payload = $request->only([
                'judul',
                'deskripsi'
            ]);

            $data = $this->catatanModel->create($payload);
            return response()->json([
                "status" => true,
                "message" => "Data berhasil ditambahkan",
                "data"    => $data
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => "Data gagal ditambahkan",
            ],422);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = $this->catatanModel->find($id);
            if (!$data) {
                return response()->json([
                    "status" => false,
                    "message" => "Data tidak ditemukan"
                ],422);
            }
            return response()->json([
                "status" => true,
                "message" => "Data berhasil diambil",
                "data" => $data
            ],422);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => "Data gagal diambil",
            ],422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {  
            try {
                if (isset($request->validator) && $request->validator->fails()) {
                    return response()->json([ 
                        "status" => false,
                        "message" => $request->validator->errors()],422);
                }
    
                $payload = $request->only([
                    'judul',
                    'deskripsi'
                ]);
    
                $data = $this->catatanModel->find($id);
                if (!$data) {
                    return response()->json([
                        "status" => false,
                        "message" => "Data tidak ditemukan"
                    ],422);
                }
    
                $data->update($payload);
                return response()->json([
                    "status" => true,
                    "message" => "Data berhasil diupdate"
                ]);
    
            } catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "message" => "Data gagal diupdate",
                ],422);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = $this->catatanModel->find($id);
            if (!$data) {
                return response()->json([
                    "status" => false,
                    "message" => "Data tidak ditemukan"
                ],422);
            }

            $data->delete();
            return response()->json([
                "status" => true,
                "message" => "Data berhasil dihapus"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => "Data gagal dihapus"
            ],422);
        }
    }
}
