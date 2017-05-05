@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

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