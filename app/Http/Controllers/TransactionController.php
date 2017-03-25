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

        //DB::enableQueryLog();

        $getduser = DB::table('sys')
            ->select(['prodi.*','transaction.*','sys.*','users.*','prodi.nama as np','jenis_kendaraan.nama as njenis','sys.no_polis as nopol',DB::raw("datediff(MAX(transaction.expired_at), NOW())as days")])
            ->leftJoin('users','users.npm','=','sys.npm')
            ->leftJoin('jenis_kendaraan','jenis_kendaraan.id','=','sys.jenis')
            ->leftJoin('prodi','prodi.id','=','users.prodi')
            ->leftJoin('transaction','transaction.no_polis','=','sys.no_polis')
            ->leftJoin('admincfm','admincfm.transid','=','transaction.id')
            ->where('users.npm', $loguser->npm)
            ->where('transaction.paid', 1)
            ->where('admincfm.cfm', 1)
            ->orderBy('transaction.expired_at','desc')
            ->groupBy('nopol');
            //->get();
        //$queries = DB::getQueryLog();
        $getkendaraan = $getduser->get();
        //dd($getkendaraan);
        if ($getkendaraan->count() <= 1){
            $getkendaraan = $getkendaraan->first();
        }

        return view('pembayaran',[
            'loguser'=>$loguser,
            'getduser'=>$getduser->first(),
            'getkendaraan'=>$getkendaraan,
        ]);
    }

    public function tambah(Request $request)
    {
        //dd($request);
        // $this->validate($request,[
        //     'nopolis' => 'required',
        //     'bulan' => 'required|max:12|min:0|numeric'
        // ]);
        

        $date = date("Y-m-d");
        $bulan = $request->bulan+1;
        $date = strtotime(date("Y-m-1", strtotime($date)) . " +$bulan month");
        $date = date("Y-m-d",$date);
        //echo 'expired: '.$date;

        DB::enableQueryLog();
        $transaction = new transaction;
        $transaction->no_polis = $request->nopol;
        $transaction->bulan = $request->bulan;
        $transaction->expired_at = $date;
        // $transaction->prodi = $request->prodi;
        // $transaction->email = $request->email;
        // $transaction->phone = $request->phone;
        $transaction->save();
        $queries = DB::getQueryLog();
        //dd($queries);

        //dd('asdf');

        return redirect('pembayaran/baru');
    }
}
