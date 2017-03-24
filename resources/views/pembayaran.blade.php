@extends('layouts.master')
@section('title','Perpanjangan')
@section('page-header','Perpanjangan Member Parkir UIB')
@section('page-description','Silahkan isi form berikut')
@section('breadcrumblv2')
<li class="active">Perpanjangan</li>
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
            			<th>NPM</th>
            			<td>{{ $getduser->npm }}</td>
            		</tr>
            		<tr>
            			<th>Nama Mahasiswa</th>
            			<td>{{ $getduser->nama }}</td>
            		</tr>
            		<tr>
            			<th>Prodi</th>
            			<td>{{ $getduser->np }}</td>
            		</tr>
            		<tr>
            			<th>Email</th>
            			<td>{{ $getduser->email }}</td>
            		</tr>
            		<tr>
            			<th>No Hp</th>
            			<td>{{ $getduser->phone }}</td>
            		</tr>
            		<tr>
            			<th>No Polis</th>
            			<td>
                              @if (count($getkendaraan) <= 1)
                              {{ $getkendaraan->nopol }} ({{ $getkendaraan->njenis }}) <span class="text-red">{{$getkendaraan->days}} Hari Lagi</span> 
                              @else
                                    <select name="nopol" class="form-control">

                                          @foreach ($getkendaraan as $kend)
                                          @if($kend->days < 1)
                                                class="text-red"
                                          @endif
                                                <option 
                                                      @if($kend->days < 5)
                                                            class="text-red"
                                                      @endif
                                                 value="{{$kend->nopol}}">{{$kend->nopol}} ({{$kend->njenis}}) <span class="text-red">
                                                 @if($kend->days > 0)
                                                 {{$kend->days}} Hari Lagi
                                                 @else
                                                      Sudah Habis
                                                 @endif
                                                 </span>
                                          </option>
                                          @endforeach
                                    </select>
                              @endif
                              </td>
            		</tr>
            		<tr>
            			<th>Pilih Jumlah Bulan</th>
            			<td>
                              {{ Form::number('name', 'value', array('class' => 'form-control')) }}
            			</td>
            		</tr>
            		<tr>
            		<th colspan="2">{{Form::submit('Simpan',array('class'=>'btn btn-block btn-primary btn-clr'))}}</th>
            		</tr>
	            </tbody>
            </table>
            </div>
            {{ csrf_field() }}
            {{ Form::close() }}
          </div>
</section>
@endsection