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
            {{ Form::open(array('url' => 'pembayaran/baru')) }}
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
                              @if (count($getkendaraan) == 1)
                                    {{ $getkendaraan->nopol }} ({{ $getkendaraan->njenis }}) 
                                    <input type="hidden" name="nopol" value="{{ $getkendaraan->nopol }}">
                                    <span class="text-red">
                                    @if($getkendaraan->days > 0)
                                     {{$getkendaraan->days}} Hari Lagi
                                     @else
                                          Sudah Habis
                                     @endif
                                     </span> 
                              @else
                                    <select name="nopol" class="form-control">

                                          @foreach ($getkendaraan as $kend)
                                          @if($kend->days < 1)
                                                class="text-red"
                                          @endif
                                                <option class="{{ $kend->days <5 ? 'text-red' :'' }}" value="{{$kend->nopol}}">{{$kend->nopol}} ({{$kend->njenis}}) <span class="text-red">
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
            			<td class="{{ $errors->has('bulan') ? 'has-error' :'' }}">
                              {{ Form::number('bulan', 1, array('class' => 'form-control','min'=>1, 'max' => 12)) }}

                              @if($errors->has('bulan'))
                                    <span class="help-block">{{$errors->first('bulan')}}</span>
                              @endif
            			</td>
            		</tr>
            		<tr>
            		<th colspan="2">
                        {{Form::submit('Simpan',array('class'=>'btn btn-block btn-primary btn-clr'))}}</th>
            		</tr>
	            </tbody>
            </table>
            </div>
            {{ csrf_field() }}
            {{ Form::close() }}
          </div>
</section>
@endsection