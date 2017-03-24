@extends('layouts.master-admin')
@section('title','Perpanjangan')
@section('page-header','Daftar Perpanjangan')
@section('page-description','Silahkan isi form berikut')
@section('breadcrumblv2')
<li class="active">Daftar Perpanjangan</li>
@endsection

@section('content')

<section class="content">
      <div class="box box-primary">

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>No. Hp</th>
                  <th>No. Polis</th>
                  <th>Tgl konfirmasi</th>
                  <th>Jml Bln</th>
                  <th>Total</th>
                  <th>Img</th>
                </tr>
                </thead>
                <tbody>
                	<tr>
                	<td>17031601</td>
                	<td>Irvan Santoso</td>
                	<td>083184476796</td>
                	<td>BP 1078 FD</td>
                	<td>Kamis, 16-Maret-2017 11:23 PM</td>
                	<th>2 Bulan</th>
                	<td>Rp. 120.000</td>
                	<td><img src="" alt="Gambar konfirmasi"></td>
                	</tr>
                	<tr>
                	<td>17031602</td>
                	<td>Alexander</td>
                	<td>083184476796</td>
                	<td>BP 1234 AA</td>
                	<td>Kamis, 16-Maret-2017 10:23 AM</td>
                	<th>1 Bulan</th>
                	<td>Rp. 60.000</td>
                	<td><img src="" alt="Gambar konfirmasi"></td>
                	</tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>No. Hp</th>
                  <th>No. Polis</th>
                  <th>Tgl konfirmasi</th>
                  <th>Jml Bln</th>
                  <th>Total</th>
                  <th>Img</th>
                </tr>
                </tfoot>
              </table>
            </div>

          </div>
</section>
@endsection