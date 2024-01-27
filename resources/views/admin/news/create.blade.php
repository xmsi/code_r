@extends('layouts.admin.index')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">{{ __('Создать') }}</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-body">
		@include('error')
		<form action="/admin/news" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label for="title">{{ __('Название') }}</label>
				<input type="text" name="title" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="date">{{ __('Дата') }}</label>
				<input type="text" name="date" class="form-control datepicker-here" required>
			</div>
			<div class="form-group">
				<label for="text">{{ __('Описание') }}</label>
				<textarea name="text" class="form-control" id="" cols="10" rows="10"></textarea>
			</div>
			<div class="form-group">
				<label for="title">{{ __('Картинка') }}</label><br>
				<input type="file" name="image">
			</div>
			<button type="submit" class="btn btn-success">{{ __('Создать') }}</button>
		</form>
	</div>
</div>
@endsection

@section('extra_css')
<link rel="stylesheet" href="/assets/css/datepicker.min.css">
@endsection
@section('extra_js')

<script src="/assets/js/datepicker.min.js"></script>

@endsection