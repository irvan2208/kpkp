@extends('layouts.master')
@section('title','Konfirmasi')
@section('page-header','Konfirmasi Pembayaran Member Parkir UIB')
@section('page-description','Silahkan isi form berikut')
@section('breadcrumblv2')
<li class="active">Konfirmasi</li>
@endsection

@section('content')

<section class="content">
      <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            {{ Form::open(array('url' => 'admin/users','id'=>'newU')) }}
            <div class="box-body">
            <table class="table">
	            <tbody>
            		<tr>
            			<th>No Perpanjangan</th>
            			<td>17031601</td>
            		</tr>
            		<tr>
            			<th>Nama Mahasiswa</th>
            			<td>Irvan Santoso</td>
            		</tr>
            		<tr>
            			<th>No Hp</th>
            			<td>083184476796</td>
            		</tr>
            		<tr>
            			<th>No Polis</th>
            			<td>BP 1078 FD</td>
            		</tr>
            		<tr>
            			<th>Jenis Kendaraan</th>
            			<td>Mobil</td>
            		</tr>
            		<tr>
            			<th>Jumlah Bulan</th>
            			<td>2 Bulan</td>
            		</tr>
                        <tr>
                              <th>Total Pembayaran</th>
                              <td>Rp. 120.000</td>
                        </tr>
                        <tr>
                              <th>Bank Tujuan</th>
                              <td>{{ Form::select('jk', ['1'=>'Bank BCA (12345678)','f'=>'Wanita'], null, array('class' => 'form-control')) }}</td>
                        </tr>
                        <tr>
                              <th>Transfer A.N</th>
                              <td>{{ Form::text('nama', 'Irvan Santoso', array('class' => 'form-control')) }}</td>
                        </tr>
                        <tr>
                              <th>Bank Tujuan</th>
                              <td>{{ Form::select('jk', ['1'=>'Bank BCA (12345678)','f'=>'Wanita'], null, array('class' => 'form-control')) }}</td>
                        </tr>
                        <tr>
                              <th>Bukti Pembayaran</th>
                              <td>{{ Form::file('jk', '', null, array('class' => 'form-control')) }}</td>
                        </tr>
            		<tr>
            		<th colspan="2">{{Form::submit('Kirim',array('class'=>'btn btn-block btn-primary btn-clr'))}}</th>
            		</tr>
	            </tbody>
            </table>
            </div>
            {{ csrf_field() }}
            {{ Form::close() }}
          </div>
</section>
@endsection