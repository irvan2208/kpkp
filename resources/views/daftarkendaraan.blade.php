@extends('layouts.master')
@section('title','Kendaraan')
@section('page-header','Tambah Kendaraan')
@section('page-description','Silahkan isi form berikut')
@section('breadcrumblv2')
<li class="active">Daftar Kendaraan</li>
@endsection

@section('content')

<section class="content">
	<div class="box box-primary">
	@if (count($errors) > 0)
        <div class="alert alert-danger">
              There were some problems with your input.<br><br>
              <ul>
                    @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                    @endforeach
              </ul>
        </div>
  @endif
		<div class="box-header with-border">
	      <div class="row">
	        <h3 class="box-title col-xs-6">Daftar Kendaraan </h3>
	        <div class="col-xs-6 right" style="text-align: right;"><button data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-danger">Tambah Kendaraan Baru</button></div>
	      </div>
	    </div>
		<div class="box-body">
			<table id="pembayaran" class="table table-bordered table-striped">
		        <thead>
		          <tr>
		            <th>No Polis</th>
		            <th>Jenis</th>
		            <th>Option</th>
		          </tr>
		        </thead>
		        <tbody>
		        	@foreach($getkendaraan as $listkendaraan)
		        		<tr>
		        			<td>{{$listkendaraan->no_polis}}</td>
		        			<td>{{$listkendaraan->jenis}}</td>
		        			{{ Form::open(array('url' => 'kendaraan/'.$listkendaraan->no_polis.'/del')) }}
			        			{{ method_field('DELETE') }}
			        				<td>{{Form::submit('Hapus',array('class'=>'btn btn-primary btn-warning'))}}</td>
			        			{{ csrf_field() }}
	   						{{ Form::close() }}
		        		</tr>
		        	@endforeach
		        </tbody>
		        <thead>
		          <tr>
		            <th>No Polis</th>
		            <th>Jenis</th>
		            <th>Option</th>
		          </tr>
		        </thead>
		        </table>
		</div>		
	</div>
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Kendaraan Baru</h4>
      </div>
        {{ Form::open(array('url' => 'kendaraan/tambah','id'=>'newKendaraan')) }}
      <div class="modal-body">
      <table class="table">
		<tr>
			<th>Jenis Kendaraan</th>
			<td>{{ Form::text('no_polis', '', array('class' => 'form-control', 'placeholder' => 'BP1234AA')) }}</td>
		</tr>
		<tr>
			<th>Jenis Kendaraan</th>
			<td>{{ Form::select('jenisk', $getjnskendaraan, null, array('class' => 'form-control','style' => 'width:100%')) }}</td>
		</tr>
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {{Form::submit('Simpan',array('class'=>'btn btn-primary btn-clr'))}}
      </div>
	    {{ csrf_field() }}
	    {{ Form::close() }}
    </div>
  </div>
</div>
@endsection