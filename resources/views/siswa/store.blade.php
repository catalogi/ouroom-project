@extends('master')

@section('title', '')

@section('content')

	<form method="post" action="{{ route('store-siswa') }}">

		@csrf

		<div class="form-group">
			<label>Nama Lengkap</label>
			<input type="text" class="form-control" value="" name="full_name">
			@if ($errors->has('full_name'))
			<div class="email">
				<p style="color: red"><span>&#42;</span> {{ $errors->first('full_name') }}</p>
			</div>
			@endif
		</div>

		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" value="" name="email">
			@if ($errors->has('username'))
			<div class="email">
				<p style="color: red"><span>&#42;</span> {{ $errors->first('email') }}</p>
			</div>
			@endif
		</div>

		<div class="form-group">
		<label>Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin">
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
		</div>

		<div class="form-group">
			<label>Jurusan</label>
			<select class="form-control" name="jurusan">
                <option value="Pemasaran">Pemasaran</option>
	   	        <option value="Pariwisata">Pariwisata</option>
                <option value="Peternakan">Peternakan</option>
            </select>
		</div>	

		<div class="form-group">
			<label>Angkatan</label>
            <select class="form-control" name="angkatan">
                @foreach ($years as $year)
                    <option value="{{ $year }}"> {{ $year }} </option>
                @endforeach
            </select>
		</div>

		<div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" value="" name="username">
			@if ($errors->has('username'))
			<div class="error">
				<p style="color: red"><span>&#42;</span> {{ $errors->first('username') }}</p>
			</div>
			@endif
		</div>

		<div class="form-group col-md-6" style="padding-left: 0px">
			<label>Password</label>
			<input type="password" class="form-control" value="" name="password">
			@if ($errors->has('password'))
			<div class="password">
				<p style="color: red"><span>&#42;</span> {{ $errors->first('password') }}</p>
			</div>
			@endif
		</div>

		<div class="form-group col-md-6" style="padding-left: 0px">
			<label>Retype Password</label>
			<input type="password" class="form-control" value="" name="password_confirmation">
			@if ($errors->has('password'))
			<div class="password">
				<p style="color: red"><span>&#42;</span> {{ $errors->first('password') }}</p>
			</div>
			@endif
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-info"> TAMBAH </button>
		</div>

	</form>

@endsection