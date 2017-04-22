@extends('layouts.app')
@section('content')

<div class="col-md-8 col-md-offset-2">
	<section class="main">
		<div class="row">
			<div class="col-md-12">
				<div class="pull-right">
					<img src="{{ asset('img/logo-dulux.png') }}" class="img-responsive img-logo pull-right" style="margin-bottom: 10%">
				</div>	
			</div>
			<div class="col-sm-6">
				<img src="{{ url('img/png-09.png') }}" class="img-responsive download-banner">
			</div>
			<div class="col-sm-6">		
				<p class="download-info">Lengkapi data diri Anda dan temukan<br><b>Inspirasi Warna Dulux 2017</b><br>untuk mempercantik ruangan Anda.</p>
				<br>
				<form method="post" action="{{ url('/download') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group {{ ( $errors->has('name') ? 'has-error' : '' ) }}">
						<input type="text" name="name" class="form-control" placeholder="Nama *">
						@if($errors->has('name'))
						<label class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</label>
						@endif
					</div>
					<div class="form-group {{ ( $errors->has('email') ? 'has-error' : '' ) }}">
						<input type="text" name="email" class="form-control" placeholder="Email *">
						@if($errors->has('email'))
						<label class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</label>
						@endif
					</div>
					<div class="form-group {{ ( $errors->has('email') ? 'has-error' : '' ) }} text-center">
						<button type="submit" class="button-kirim-download">
							<img src="{{ asset('img/download-button.png') }}" class="img-responsive" style="margin: auto">
						</button>
					</div>				
				</form>
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