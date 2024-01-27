@extends('layouts.admin.index')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">{{ __('Информация') }}</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="text">
			<div class="row">
				<div class="col-md-3">
					<a href="/admin/news/{{ $news->id }}/edit"><button class="btn btn-sm btn-primary">Изменить</button></a>
				</div>
				<div class="col-md-2 offset-md-7" align="right">
					<form action="{{ route('news.destroy', $news->id) }}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger btn-sm">Удалить</button>
					</form>
				</div>
			</div>
		</span>
	</div>
	<div class="card-body">
		@include('success')
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th scope="row">{{ __('Название') }}</th>
					<td>{{ $news->title }}</td>
				</tr>
				<tr>
					<th scope="row">{{ __('Описание') }}</th>
					<td>{!! nl2br($news->text) !!}</td>
				</tr>
				<tr>
					<th scope="row">{{ __('Дата') }}</th>
					<td>{{ date('d-m-Y', strtotime($news->date)) }}</td>
				</tr>
				<tr>
					<th scope="row">{{ __('Картинкa') }}</th>
					<td>	
						<img src="/images/{{ $news->image }}" style="max-width: 200px" alt="">
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection