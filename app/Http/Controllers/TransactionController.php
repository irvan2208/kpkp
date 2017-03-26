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

        //DB::enableQueryLog();
        $transaction = new transaction;
        $transaction->no_polis = $request->nopol;
        $transaction->bulan = $request->bulan;
        $transaction->expired_at = $date;
        //$transaction->timestamps();
        $transaction->save();
        //$queries = DB::getQueryLog();
        //dd($queries);

        //dd('asdf');

        return redirect('pembayaran/konfirmasi')
        ->with('success','Perpanjangan diterima, harap lakukan pembayaran lalu konfirmasi.');
    }

    public function showlist()
    {
        $loguser = Auth::user();
        $getall = DB::table('transaction')
        ->select(['admincfm.*','transaction.*','sys.*','jenis_kendaraan.nama as njenis',DB::raw('transaction.bulan*jenis_kendaraan.harga AS total')])
        ->leftJoin('sys','transaction.no_polis','=','sys.no_polis')
        ->leftJoin('jenis_kendaraan','sys.jenis','=','jenis_kendaraan.id')
        ->leftJoin('admincfm','transaction.id','=','admincfm.transid')
        ->where('sys.npm',$loguser->npm)
        //->where('transaction.paid',0)
        ->orderBy('transaction.expired_at','DESC')
        ->get();

        //dd($getall);
        return view('listpembayaran',['getall'=>$getall,]);
    }

    public function createconf($id)
    {
        $gettrans = DB::table('transaction')
        ->select(['transaction.id as noper','transaction.*','sys.*','users.*','jenis_kendaraan.nama as njenis','transaction.bank as bankid',DB::raw('transaction.bulan*jenis_kendaraan.harga AS total')])
        ->leftJoin('sys','transaction.no_polis','=','sys.no_polis')
        ->leftJoin('users','sys.npm','=','users.npm')
        ->leftJoin('jenis_kendaraan','sys.jenis','=','jenis_kendaraan.id')
        ->where('transaction.id',$id)
        ->first();

        if ($gettrans->paid == 0) {
            $getbank = DB::table('bank')->get();
        }else{
           $getbank = DB::table('bank')->where('bank.id',$gettrans->bank)->first();
        }
        //dd($getbank);
        //dd($getbank);
        return view('conpembayaran',['gettrans'=>$gettrans,'getbank'=>$getbank]);
    }

    public function storeconf(request $request, $id)
    {
        $this->validate($request, [
            'namatrans' => 'required',
            'bank' => 'required|numeric',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->bukti->getClientOriginalExtension();
        $request->bukti->move(public_path('images'), $imageName);

        $transaction = transaction::find($id);
        $transaction->paid = 1;
        $transaction->bank = $request->bank;
        $transaction->atas_nama = $request->namatrans;
        $transaction->image = "images/".$imageName;
        $transaction->save();

        return back()
            ->with('success','Konfirasi diterima, dan akan di cek oleh admin.');
            //->with('path',$imageName);
    }
}
