@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

        <form style="display: inline;" method="post" action="{{ url('admin/panel/home/downloads/export') }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-success">Export Downloads</button>
        </form>

        <br><br>

        @if(Session::has('success'))
        <p class="text-success">
            {{ Session::get('success') }}
        </p>
        @endif

        <div class="table-responsive">
        	<table class="table table-bordered">
        		<thead>
        			<tr>
        				<th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Date</th>
        			</tr>
        		</thead>
        		<tbody>
        			@foreach($downloads as $item)
        			<tr>
        			     <td>{{ $item->id }}</td>
                         <td>{{ $item->name }}</td>
                         <td>{{ $item->email }}</td>
                         <td>{{ $item->created_at->format('d/m/y h:i:s a') }}</td>
        			</tr>
        			@endforeach
        		</tbody>
        	</table>
        	{{ $downloads->links() }}
        </div>

        </div>
    </div>
</div>
@stop