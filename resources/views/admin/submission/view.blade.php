@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

        <form style="display: inline;" method="post" action="{{ url('admin/panel/home/submission/export') }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-success">Export Submissions</button>
        </form>

        <form style="display: inline;" method="post" action="{{ url('admin/panel/home/submission/export/code') }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-success">Export Unique Codes</button>
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
                        <th>City</th>
        				<th>Name</th>
        				<th>Email</th>
        				<th>Phone</th>
        				<th>ID Card</th>
                        <th>Address</th>
                        <th>Contact Accept</th>
        				<th>Store</th>
        				<th>Value</th>
                        <th>No Undian</th>
        				<th>Date</th>
        			</tr>
        		</thead>
        		<tbody>
        			@foreach($submissions as $item)
        			<tr>
        				<td>
                            <div class="dropdown">
                              <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Action
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="{{ url('/admin/panel/home/submission/'. $item->id) }}">View Detail</a></li>
                                <li><a href="{{ url('/admin/panel/home/submission/edit/'. $item->id) }}">Edit</a></li>
                              </ul>
                            </div>            
                        </td>
                        <td>{{ $item->kota }}</td>
        				<td>{{ $item->name }}</td>
        				<td>{{ $item->email }}</td>
        				<td>{{ $item->phone }}</td>
        				<td>{{ $item->id_card }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->contact_accept }}</td>
        				<td>{{ $item->store_name }}</td>
        				<td>{{ number_format($item->nominal) }}</td>
                        <td>
                            @foreach($item->coupon as $undian)
                            <span class="text-danger">{{ $undian->coupon_code }}</span>
                            @endforeach
                        </td>
        				<td>{{ $item->created_at->format('d/m/y') }}</td>
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