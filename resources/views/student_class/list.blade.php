@extends('master')

@section('title', '')

@section('alert')
    @if(Session::has('alert_success'))
        @component('components.alert')
            @slot('class')
                success
            @endslot
            @slot('title')
                Terimakasih
            @endslot
            @slot('message')
                {{ session('alert_success') }}
            @endslot
        @endcomponent
        @elseif(Session::has('alert_error'))
        @component('components.alert')
                @slot('class')
                    error
                @endslot
                @slot('title')
                    Cek Kembali
                @endslot
                @slot('message')
                    {{ session('alert_error') }}
                @endslot
        @endcomponent 
    @endif
@endsection

@section('content')
	<?php 
		use Yajra\Datatables\Datatables; 
		use App\Model\User\User;
		use Carbon\Carbon;

		// get user auth
		$user = Auth::user();
	?>

	@if($user->account_type == User::ACCOUNT_TYPE_CREATOR || $user->account_type == User::ACCOUNT_TYPE_ADMIN || $user->account_type == User::ACCOUNT_TYPE_TEACHER)
	<div class="data-tugas">
		<a  href="{{ route('feed-data') }}" type="button" class="btn btn-info custombtn"> DATA POSTING </a>
    </div>
	<hr style="border-top: 1px solid #c6c6c6">
	<form method="POST" action="{{ route('upload-feed') }}" class="upload-container" enctype="multipart/form-data">

		@csrf

		<div class="ui raised segments">
			<div class="ui segment">
				<a class="ui blue ribbon huge label">Tambahkan Sesuatu</a>
			</div>
			<div class="upload">
				<label>Judul</label>
				<input type="text" class="form-control" id="judul" name="judul">

				<label>Kategori</label>
				<select class="form-control" name="kategori">
                    <option selected="true" disabled="disabled">Pilih Kategori</option> 
                    <option value="Artikel">Artikel</option>
					<option value="Tugas">Tugas</option>
					<option value="Ujian">Ujian</option>
				</select>
			</div>
			<div class="ui segments">
				<textarea class="form-control" placeholder="Detail" rows="10" id="detail" name="detail"></textarea>
			</div>
			<div class="upload">
				<label>Upload File</label>
				<input type="file" class="form-control" id="file" name="file">

				<label>Tenggat Waktu</label>
				<input type="date" min="2020-01-01" class="form-control" id="deadline" name="deadline">
			</div>
			<div class="ui segments">
				<button type="submit" class="ui primary fluid bottom huge button">
					POST
				</button>
			</div>
		</div>
	</form>
	@endif

	<fieldset>
	@foreach ($detail_kelas as $df)
		<legend>{{$df->class_name}}</legend>
		<div class="ui raised segment">
			<div class="top-attribute">
				@if($df->kategori == 'Artikel')
					<a class="ui green ribbon huge label">{{$df->kategori}}
				@endif
				@if($df->kategori == 'Tugas')
					<a class="ui orange ribbon huge label">{{$df->kategori}}
				@endif
				@if($df->kategori == 'Ujian')
					<a class="ui red ribbon huge label">{{$df->kategori}}
				@endif
				</a><span class="judul">{{$df->judul}}</span>
				<div class="ui red large label deadline">{{$df->deadline}}</div>
				<a class="ui top right attached huge image label">
					<span class="date-post">{{$df->created_at}}</span>
					@if($user->account_type == User::ACCOUNT_TYPE_CREATOR || $user->account_type == User::ACCOUNT_TYPE_ADMIN || $user->account_type == User::ACCOUNT_TYPE_TEACHER)
					<div class="detail">
						<i class="glyphicon glyphicon-trash"></i>
					</div>
					@endif
				</a>
			</div>
			<p style="margin: 10px 0px">{{$df->detail}}</p>
			<a href="{{ route('class-feed') }}" class="ui bottom attached large button">
				Lihat
			</a>
		</div>
	@endforeach
@endsection