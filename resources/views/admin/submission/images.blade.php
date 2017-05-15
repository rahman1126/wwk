@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

        <div class="row">
            <ul>
                <li>Submited at: {{ $data->created_at }}</li>
                <li>Name: {{ $data->name }}</li>
                <li>Email: {{ $data->email }}</li>
                <li>Phone: {{ $data->phone }}</li>
                <li>ID Card: {{ $data->id_card }}</li>
                <li>Address: {{ $data->address }}</li>
                <li>Store Name: {{ $data->store_name }}</li>
                <li>Contact Accept: {{ $data->contact_accept }}</li>
                <li>Value: {{ number_format($data->nominal) }}</li>
                <li>
                    Unique Code:
                    <ul>
                        @foreach($coupons as $item)
                        <li>{{ $item->coupon_code }}</li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>

        <div class="row">
        	@foreach($images as $item)
        	<div class="col-md-6">
        		<img src="{{ $item->image_url }}" class="img-responsive thumbnail" alt="Responsive image">
        	</div>
        	@endforeach
        </div>

        </div>
    </div>
</div>
@stop