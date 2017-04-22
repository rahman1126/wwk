@extends('layouts.app')
@section('content')

<div class="col-md-8 col-md-offset-2">
	<section class="main">
		<div class="row">
			<div class="col-md-12">
				<div class="pull-right">
					<img src="{{ asset('img/logo-dulux.png') }}" class="img-responsive img-logo pull-right">
				</div>
				<img src="{{ url('img/download-done.jpg') }}" class="img-responsive">
			</div>
		</div>		
	</section>
</div>

<form id="formDownload" action="{{ url('fire-download') }}" method="post" style="display: none">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>

@stop
@section('script')

@if(Session::has('download_url_activated'))
<script type="text/javascript">
	$(function() {
		$('#formDownload').submit();
	});
</script>
@endif

@stop