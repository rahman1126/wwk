@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

        <div class="table-responsive">
        	<table class="table table-bordered">
        		<thead>
        			<tr>
        				<th>ID</th>
        				<th>Name</th>
        				<th>Email</th>
        				<th>Phone</th>
        				<th>ID Card</th>
        				<th>Store</th>
        				<th>Value</th>
        				<th>Date</th>
        				<th>Images</th>
        			</tr>
        		</thead>
        		<tbody>
        			@foreach($submissions as $item)
        			<tr>
        				<td>{{ $item->id }}</td>
        				<td>{{ $item->name }}</td>
        				<td>{{ $item->email }}</td>
        				<td>{{ $item->phone }}</td>
        				<td>{{ $item->id_card }}</td>
        				<td>{{ $item->store_name }}</td>
        				<td>{{ $item->nominal }}</td>
        				<td>{{ $item->created_at->format('d M y') }}</td>
        				<td><a href="{{ url('/admin/panel/home/submission/'. $item->id) }}">View</a></td>
        			</tr>
        			@endforeach
        		</tbody>
        	</table>
        	{{ $submissions->links() }}
        </div>

        </div>
    </div>
</div>
@stop