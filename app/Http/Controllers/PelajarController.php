<?php

namespace App\Http\Controllers;

use App\Models\Pelajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelajarController extends Controller
{
    public function kampus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100',
            'prodi' => 'required|max:100',
            'jk' => 'required|max:100'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $validated = $validator->validated();

        Pelajar::create([
            'nama' => $validated['nama'],
            'prodi' => $validated['prodi'],
            'jk' => $validated['jk']
        ]);
        return response()->json('data berhasil disimpan')->setStatusCode(201);
    }
    public function show()
    {
        $Pelajar = Pelajar::all();

        return response()->json($Pelajar)->setStatusCode(200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100',
            'prodi' => 'required|max:100',
            'jk' => 'required|max:100'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $validated = $validator->validated();

        // dd($checkData);

        $checkData = Pelajar::find($id);
        if ($checkData) {

            Pelajar::where('id', $id)
                ->update([
                    'nama' => $validated['nama'],
                    'prodi' => $validated['prodi'],
                    'jk' => $validated['jk']
                ]);
            return response()->json([
                'messages' => 'Data berhasil disunting'
            ])->setStatusCode(201);
        }

        return response()->json([
            'messages' => 'Data Pelajar tidak ditemukan'
        ])->setStatusCode(404);
    }

    public function destory($id)
    {
        $checkData = Pelajar::find($id);
        if ($checkData) {
            Pelajar::destory($id);

            return response()->json([
                'messages' => 'Data Pelajar dihapus'
            ])->setStatusCode(200);
        }
        return response()->json([
            'messages' => 'Data Pelajar tidak ditemukan'
        ])->setStatusCode(404);
    }
}
