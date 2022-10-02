<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $pegawai = Pegawai::latest()->get();
            return DataTables::of($pegawai)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-toggle="tooltip" data-id="' . $data->id . '">Edit</a>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<a href="javascript:void(0)" name="delete" class="delete btn btn-danger btn-sm" data-id="' . $data->id . '" ">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('home');
    }

    public function store(Request $request)
    {
        //validas
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:pegawais,email',
        ]);

        //cek validasi salah
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // buat 
        $pegawai = Pegawai::create([
            'nama' => $request->nama,
            'jk' => $request->jk,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);
        return response()->json([
            'success' => true,
            'message' => "Berhasil ditambahkan",
            'data' => $pegawai
        ]);
    }

    // show
    public function show(Pegawai $pegawai)
    {
        // dd($pegawai);
        return response()->json([
            'success' => true,
            'message' => "berhasil ditampilkan",
            'data' => $pegawai
        ]);
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:pegawais,email,' . $pegawai->id,
        ]);

        //cek validasi salah
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // update
        $pegawai->update([
            'nama' => $request->nama,
            'jk' => $request->jk,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        return response()->json([
            'success' => true,
            'message' => "Berhasil Diedit",
            'data' => $pegawai
        ]);
    }

    public function destroy($id)
    {
        Pegawai::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil dihapus',
        ]);
    }
}
