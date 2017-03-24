<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\transaction;
use App\prodi;
use App\sys;
use App\users;
use App\jenisk;
use Auth;
use DateTime;


class TransactionController extends Controller
{
    public function show()
    {
        $loguser = Auth::user();

        DB::enableQueryLog();

        $getduser = DB::table('sys')
            ->select(['prodi.*','transaction.*','sys.*','users.*','prodi.nama as np','jenis_kendaraan.nama as njenis','sys.no_polis as nopol',DB::raw("datediff(transaction.expired_at, NOW())as days")])
            ->leftJoin('users','users.npm','=','sys.npm')
            ->leftJoin('jenis_kendaraan','jenis_kendaraan.id','=','sys.jenis')
            ->leftJoin('prodi','prodi.id','=','users.prodi')
            ->leftJoin('transaction','transaction.no_polis','=','sys.no_polis')
            ->leftJoin('admincfm','admincfm.transid','=','transaction.id')
            ->where('users.npm', $loguser->npm)
            ->where('transaction.paid', 1)
            ->where('admincfm.cfm', 1);
            //->get();
        //$queries = DB::getQueryLog();

        //dd($getduser);

        $getkendaraan = $getduser->get();
        //dd($getkendaraan);
        // foreach ($getkendaraan as $looptgl) {
        //     if ($looptgl->days < 1) {
        //          echo "lewat";
        //      }
        // }
        //dd($getkendaraan);
        //$kend = array_shift($getkendaraan->toArray(),$datediff);
        //dd($kend)->nama;
        //array_push($datediff, $getkendaraan);
        // $test = $getkendaraan->push($datediff);
        // dd($test);
        // if ($diff->invert == true) {
        //     echo "lewat";
        // }
        //dd($datediff)->days;

        //$kend = array_combine($datediff, $getkendaraan);
        if ($getkendaraan->count() <= 1){
            $getkendaraan = $getkendaraan->first();
        }
        //dd($kend);


        return view('pembayaran',[
            'loguser'=>$loguser,
            'getduser'=>$getduser->first(),
            'getkendaraan'=>$getkendaraan,
        ]);
    }
}
