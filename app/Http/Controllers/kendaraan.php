<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\jenisk;
use App\sys;

class kendaraan extends Controller
{
    public function showkendaraan()
    {
    	$loguser = Auth::user();
    	$getkendaraan = DB::table('sys')->where('npm',$loguser->npm)->get();
    	$getjnskendaraan = DB::table('jenis_kendaraan')->pluck('nama', 'id');
    	//dd($getkendaraan);

    	return view('daftarkendaraan',['getkendaraan'=>$getkendaraan,'getjnskendaraan'=>$getjnskendaraan]);
    }

    public function storetambah(Request $request)
    {
    	$this->validate($request, [
            'no_polis' => 'required|max:9|unique:sys',
            'jenisk' => 'required|numeric',
        ]);
    	//dd($request);

    	$loguser = Auth::user();

        $newkendaraan = new sys;
        $newkendaraan->no_polis = $request->no_polis;
        $newkendaraan->npm = $loguser->npm;
        $newkendaraan->jenis = $request->jenisk;
        $newkendaraan->save();

    	return redirect()->route('kendaraan');
    }

    public function hapus(Request $request, $nopol)
    {
        $loguser = Auth::user();
    	$kendaraanhps = DB::table('sys')->where('no_polis',$nopol)->where('npm',$loguser->npm);
    	//dd($kendaraanhps);
    	$kendaraanhps->delete();
    	return back();
    }
}
