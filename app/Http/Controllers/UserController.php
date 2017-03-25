<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\prodi;
use App\users;

class UserController extends Controller
{
    public function showprodi()
    {
        $prodi = DB::table('prodi')->pluck('nama', 'id');
        //dd($prodi);
    	return view('4dm/users',['prodi'=>$prodi]);
    }

    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request,[
            'npm' => 'unique:users|required|numeric',
            'nama' => 'required',
            'jk' => 'required',
            'prodi' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric'
        ]);

        $users = new users;
        $users->npm = $request->npm;
        $users->nama = $request->nama;
        $users->jk = $request->jk;
        $users->prodi = $request->prodi;
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->save();

        return redirect('admin/users');
    }

    public function showuser()
    {
        $users = DB::table('users')
            ->leftJoin('prodi','users.prodi','=','prodi.id')
            ->select('users.*','prodi.nama as np')
            ->get();
        //$prodi = prodi::where('id', $users->prodi);
    	return view('4dm/userslist',['users'=>$users]);
    }

    public function edit($npm)
    {

        $users = users::find($npm);
        $prodi = DB::table('prodi')->pluck('nama', 'id');
        //dd($users);
        if (!$users) {
             //dd('not found!');
            abort(404);
        }
        return view('4dm/useredit',['users'=>$users,'prodi'=>$prodi]);
    }

    public function update(Request $request, $npm)
    {
        $this->validate($request,[
            //'npm' => 'unique:users|required',
            'nama' => 'required',
            'jk' => 'required',
            'prodi' => 'required',
            'email' => 'required'
        ]);

        $users = users::find($npm);
        //dd($users);
        //$users->npm = $request->npm;
        $users->nama = $request->nama;
        $users->jk = $request->jk;
        $users->prodi = $request->prodi;
        $users->email = $request->email;
        $users->save();

        return redirect('admin/users/'.$npm.'/edit');
    }
}
