@extends('layouts.admin.index')

@section('extra_css')
<link href="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">{{ __('Новости') }}</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<a href="/admin/news/create" class="btn btn-sm btn-success">
			<span class="text">{{ __('Создать') }}</span>
		</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>{{ __('Название') }}</th>
						<th>{{ __('Текст') }}</th>
						<th>{{ __('Дата') }}</th>
						<th>{{ __('Обложка') }}</th>
						<th></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>{{ __('Название') }}</th>
						<th>{{ __('Текст') }}</th>
						<th>{{ __('Дата') }}</th>
						<th>{{ __('Обложка') }}</th>
						<th></th>
					</tr>
				</tfoot>
				<tbody>
					@foreach($news as $new)
					<tr>
						<td>{{ $new->title }}</td>
						<td>{{ $new->cuttedDesc }}</td>
						<td>{{ date('d-m-Y', strtotime($new->date)) }}</td>
						<td><img src="/images/{{ $new->image }}" style="width: 40px" alt=""></td>
						<td width="120px">
							<form action="{{ route('news.destroy', $new->id) }}" method="POST">
							<a href="/admin/news/{{ $new->id }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Информация') }}">
                    			<i class="fas fa-info-circle"></i>
                  			</a>
                  			<a href="/admin/news/{{ $new->id }}/edit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Изменить') }}">
                  				<i class="fas fa-pen"></i>
                  			</a>
                  			@csrf
                  				@method('DELETE')
                  				<button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Удалить') }}"><i class="fas fa-trash"></i></button>
                  			</form>
                  		</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('extra_js')
<!-- Page level plugins -->
<script src="/assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="/assets/admin/js/demo/datatables-demo.js"></script>
@endsection