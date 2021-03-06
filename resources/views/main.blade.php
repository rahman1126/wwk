@extends('layouts.app')
@section('content')
<div class="modal-backdrop fade in" style="display: none"></div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <img data-dismiss="modal" src="{{ asset('img/thank-you-image.png') }}" class="img-responsive" style="cursor: pointer;">
      </div>
    </div>
  </div>
</div>

<div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
	<section class="heading">
		<div class="pull-right">
			<img src="{{ asset('img/logo-dulux.png') }}" class="img-responsive img-logo pull-right">
		</div>
		<br><br><br>
		<img src="{{ asset('img/KV-desktop.png') }}" class="img-responsive">
		<br><br>
		<h2 class="text-center" style="font-weight: bolder;font-size: 44px;">Register</h2>
		<p class="text-center">Lengkapi data diri anda dengan benar &amp; upload struk atau kumpulan<br> struk pembelian produk Dulux senilai akumulasi minimal <b>Rp. 750.000,-</b></p>
		<br><br>
	</section>


	<section class="main">
		<div class="row">
			<form method="post" enctype="multipart/form-data" action="{{ url('/submit') }}">
			<div class="col-md-6 col-lg-6">
				
				<div class="form-group {{ ( $errors->has('name') ? 'has-error' : '' ) }}">
					<input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nama *">
					@if($errors->has('name'))
					<label class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</label>
					@endif
				</div>

				<div class="form-group {{ ( $errors->has('address') ? 'has-error' : '' ) }}">
					<input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Alamat *">
					@if($errors->has('address'))
					<label class="help-block">
						<strong>{{ $errors->first('address') }}</strong>
					</label>
					@endif
				</div>

				<div class="form-group {{ ( $errors->has('phone') ? 'has-error' : '' ) }}"">
					<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Nomor Handphone *">
					@if($errors->has('phone'))
					<label class="help-block">
						<strong>{{ $errors->first('phone') }}</strong>
					</label>
					@endif
				</div>

				<div class="form-group {{ ( $errors->has('email') ? 'has-error' : '' ) }}"">
					<input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email *">
					<small><i>Pastikan alamat email yang digunakan aktif. Nomor undian akan dikirimkan ke email Anda.</i></small>
					@if($errors->has('email'))
					<label class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</label>
					@endif
				</div>

				<div class="form-group {{ ( $errors->has('id_card') ? 'has-error' : '' ) }}"">
					<input type="text" name="id_card" class="form-control" value="{{ old('id_card') }}" placeholder="Nomor KTP/SIM *">
					@if($errors->has('id_card'))
					<label class="help-block">
						<strong>{{ $errors->first('id_card') }}</strong>
					</label>
					@endif
				</div>

				<div class="form-group {{ ( $errors->has('region') ? 'has-error' : '' ) }}"">
					<select class="form-control" name="region" id="region">
					  <option value="">Pilih Provinsi *</option>
					  @foreach($provinsi as $item)
					  	<option value="{{ $item->id }}" {{ ( old('region') == $item->id ? 'selected' : '' ) }}>{{ $item->provinsi }}</option>
					  @endforeach
					</select>
					@if($errors->has('region'))
					<label class="help-block">
						<strong>{{ $errors->first('region') }}</strong>
					</label>
					@endif
				</div>

				<div class="form-group {{ ( $errors->has('city') ? 'has-error' : '' ) }}"">
					<select class="form-control" name="city" id="city" disabled>
					  <option value="">Pilih Kota *</option>
					</select>
					@if($errors->has('city'))
					<label class="help-block">
						<strong>{{ $errors->first('city') }}</strong>
					</label>
					@endif
				</div>

				<div id="location" class="form-group {{ ( $errors->has('location') ? 'has-error' : '' ) }}">
					<input type="text" name="location" class="form-control" value="{{ old('location') }}" placeholder="Nama Kota (Wajib jika kota tidak ada)">
					@if($errors->has('location'))
					<label class="help-block">
						<strong>{{ $errors->first('location') }}</strong>
					</label>
					@endif
				</div>

				<div class="form-group {{ ( $errors->has('store_name') ? 'has-error' : '' ) }}"">
					<input type="text" name="store_name" class="form-control" value="{{ old('store_name') }}" placeholder="Nama Toko *">
					@if($errors->has('store_name'))
					<label class="help-block">
						<strong>{{ $errors->first('store_name') }}</strong>
					</label>
					@endif
				</div>

				<div class="form-group {{ ( $errors->has('nominal') ? 'has-error' : '' ) }}">
					<input type="number" name="nominal" class="form-control" value="{{ old('nominal') }}" placeholder="Nilai pembelian Dulux dan Dulux Catylac *">
					@if($errors->has('nominal'))
					<label class="help-block">
						<strong>{{ $errors->first('nominal') }}</strong>
					</label>
					@endif
				</div>
				
			</div>
			<div class="col-md-6 col-lg-6">
				<div class="form-group">
					<h4 style="margin-bottom: 25px; font-size: 16px;">Bersedia menerima informasi program lainnya melalui:</h4>
					<div class="checkbox">
					  <label>
					    <input type="checkbox" name="contact_accept[]" id="optionsRadios1" value="sms" {{ ( old('contact_accept.0') == 'sms' ? 'checked' : '' ) }}>
					    SMS
					  </label>
					</div>
					<div class="checkbox">
					  <label>
					    <input type="checkbox" name="contact_accept[]" id="optionsRadios2" value="telepon" {{ ( old('contact_accept.1') == 'telepon' ? 'checked' : '' ) }}>
					    Telepon
					  </label>
					</div>
					<div class="checkbox">
					  <label>
					    <input type="checkbox" name="contact_accept[]" id="optionsRadios3" value="email" {{ ( old('contact_accept.2') == 'email' ? 'checked' : '' ) }}>
					    Email
					  </label>
					</div>
					<div class="form-group {{ ( $errors->has('contact_accept.*') ? 'has-error' : '' ) }}">
						@if($errors->has('contact_accept.*'))
						<label class="help-block">
							<strong>{{ $errors->first('contact_accept.*') }}</strong>
						</label>
						@endif
					</div>
				</div>
				<style type="text/css">
					.upload-box.error{
					    background-color: #ff7979 !important;
					}
				</style>
				<div class="form-group {{ ( Session::has('error') ? 'has-error' : '' ) }}">
					<div class="row">
						<div class="col-xs-6 col-sm-6">
							<div id="uploading">
								<div id="loader1" style="display: none"></div>
								<div class="upload-box {{ ( $errors->has('images.*') ? 'error' : '' ) }}" id="btnUpload">
									<img src="{{ ( Session::has('image1') ? Session::get('image1') : asset('img/upload.png') ) }}" class="img-responsive upload-placeholder" id="imgPlaceholder1">
								</div>
								{{-- <input type="file" name="images[]" id="file1" accept="image/*" style="display: none"> --}}
							</div>
						</div>
						<div class="col-xs-6 col-sm-6">
							<div id="uploading">
								<div id="loader2" style="display: none"></div>
								<div class="upload-box" id="btnUpload2">
									<img src="{{ ( Session::has('image2') ? Session::get('image2') : asset('img/upload.png') ) }}" class="img-responsive upload-placeholder" id="imgPlaceholder2">
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6">
							<div id="uploading">
								<div id="loader3" style="display: none"></div>
								<div class="upload-box" id="btnUpload3">
									<img src="{{ ( Session::has('image3') ? Session::get('image3') : asset('img/upload.png') ) }}" class="img-responsive upload-placeholder" id="imgPlaceholder3">
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6">
							<div id="uploading">
								<div id="loader4" style="display: none"></div>
								<div class="upload-box" id="btnUpload4">
									<img src="{{ ( Session::has('image4') ? Session::get('image4') : asset('img/upload.png') ) }}" class="img-responsive upload-placeholder" id="imgPlaceholder4">
								</div>
							</div>
						</div>
					</div>
					@if(Session::has('error'))
						<label class="help-block">
							<strong>{{ Session::get('error') }}</strong>
						</label>
					@endif
				</div>
			</div>

			<div class="col-md-12 col-lg-12">
				<div class="form-group text-center {{ ( $errors->has('term') ? 'has-error' : '' || $errors->has('mendaftar') ? 'has-error' : '' ) }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="checkbox">
					  <label class="control-label">
					    <input type="checkbox" name="term" id="term" value="1"> Saya telah menyetujui <a href="{{ url('term-and-conditions') }}">syarat dan ketentuan</a> yang berlaku untuk activity ini.<br>
					  </label>
					</div>
					<div class="checkbox">
						<label class="control-label">
							<input type="checkbox" name="mendaftar"> Dengan mendaftar dan ikut serta dalam program undian ini, Anda setuju untuk memperbolehkan PT ICI Paints Indonesia untuk mengumpulkan, menggunakan dan mengungkapkan data pribadi Anda untuk pelaksanaan program undian ini dan komunikasi marketing di masa yang akan datang. Untuk informasi lebih lanjut, silakan lihat syarat dan ketentuan.
						</label>
					</div>
					<p class="help-block">
						<strong class="text-danger">{{ ( $errors->has('term') || $errors->has('mendaftar') ? 'Centang untuk menyetujui' : '' ) }}</strong>
					</p>
					<button type="submit" class="button-kirim">
						<img src="{{ asset('img/kirim-button.png') }}" class="img-responsive" style="margin: auto">
					</button>
				</div>
			</div>
			</form>

			{{-- Upload form --}}
			<form id="form1" method="post" enctype="multipart/form-data" action="{{ url('/upload') }}">
				<input type="file" name="image" id="file1" accept="image/*" style="display: none;">
				<input type="hidden" name="id" value="1">
				{{ csrf_field() }}
			</form>
			<form id="form2" method="post" enctype="multipart/form-data" action="{{ url('/upload') }}">
				<input type="file" name="image" id="file2" accept="image/*" style="display: none;">
				<input type="hidden" name="id" value="2">
				{{ csrf_field() }}
			</form>
			<form id="form3" method="post" enctype="multipart/form-data" action="{{ url('/upload') }}">
				<input type="file" name="image" id="file3" accept="image/*" style="display: none;">
				<input type="hidden" name="id" value="3">
				{{ csrf_field() }}
			</form>
			<form id="form4" method="post" enctype="multipart/form-data" action="{{ url('/upload') }}">
				<input type="file" name="image" id="file4" accept="image/*" style="display: none;">
				<input type="hidden" name="id" value="4">
				{{ csrf_field() }}
			</form>
		</div>
	</section>

	<section class="footer">
		<div class="desktop">
			<img src="{{ asset('img/mekanisme-desktop.png') }}" class="img-responsive visible-md visible-lg hidden-sm hidden-xs">
			<img src="{{ asset('img/mekanisme-mobile.png') }}" class="img-responsive visible-xs visible-sm hidden-lg">
		</div>
	</section>
</div>

<div id="start"></div>
<div id="myModal2" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body text-center" style="padding: 25px 10px 0 10px;">
        <p id="information" style="font-size: 12px; color: #fff">Silahkan periksa file foto agar tidak melebihi ukuran yang telah ditentukan (5 mb). Pastikan koneksi internet anda stabil.</p>
      </div>
      <div class="modal-footer" style="text-align: center!important; ">
        <button type="button" class="btn btn-primary triangle" data-dismiss="modal">Coba lagi</button>
      </div>
    </div>
  </div>
</div>

@stop
@section('script')

@if(Session::has('message'))
	<script type="text/javascript">
		$('#myModal').modal('show');
	</script>
@endif

<script type="text/javascript">

	$("#btnUpload").click(function() {
        $("#file1").click();
    });

    $('#file1').change(function() {
          var status = $('#status');
          console.log('start!');
          $('#form1').ajaxForm({
              beforeSend: function() {
                  status.empty();
              },
              uploadProgress: function(event, position, total, percentComplete) {
                  console.log('uploading...');
                  $('#loader1').css('display','block');
                  var bd = $('.modal-backdrop');
                  bd.css('display','block');
              },
              complete: function(xhr) {
                console.log(xhr.responseText.replace(/\"|\\/g, ""));
                var ct = xhr.getResponseHeader("content-type") || "";
                if (ct.indexOf('text') > -1) {
                  //do something
                  var x = xhr.responseText.replace(/\"|\\/g, "");
                  var newSrc = $('#imgPlaceholder1').attr('src').replace( $('#imgPlaceholder1').attr('src'), x);
                  $("#imgPlaceholder1").attr("src", x);
                  $('#loader1').css('display','none');
                  var bd = $('.modal-backdrop');
                  bd.css('display','none');
                }
                if (ct.indexOf('json') > -1) {
                  // handle json here
                  var x = xhr.responseText.replace(/\"|\\/g, "");
                  $('#myModal2').modal('show');
                  $('#information').innerHTML = x;
                  $('#loader1').css('display','none');
                  var bd = $('.modal-backdrop');
                  bd.css('display','none');
                }
              }
          });

          $('#form1').submit();
    });


    $("#btnUpload2").click(function() {
        $("#file2").click();
    });

    $('#file2').change(function() {
          var status = $('#status');
          console.log('start!');
          $('#form2').ajaxForm({
              beforeSend: function() {
                  status.empty();
              },
              uploadProgress: function(event, position, total, percentComplete) {
                  console.log('uploading...');
                  $('#loader2').css('display','block');
                  var bd = $('.modal-backdrop');
                  bd.css('display','block');
              },
              complete: function(xhr) {
                console.log(xhr.responseText.replace(/\"|\\/g, ""));
                var ct = xhr.getResponseHeader("content-type") || "";
                if (ct.indexOf('text') > -1) {
                  //do something
                  var x = xhr.responseText.replace(/\"|\\/g, "");
                  var newSrc = $('#imgPlaceholder2').attr('src').replace( $('#imgPlaceholder2').attr('src'), x);
                  $("#imgPlaceholder2").attr("src", x);
                  $('#loader2').css('display','none');
                  var bd = $('.modal-backdrop');
                  bd.css('display','none');
                }
                if (ct.indexOf('json') > -1) {
                  // handle json here
                  var x = xhr.responseText.replace(/\"|\\/g, "");
                  $('#myModal2').modal('show');
                  $('#information').innerHTML = x;
                  $('#loader2').css('display','none');
                  var bd = $('.modal-backdrop');
                  bd.css('display','none');
                }
              }
          });

          $('#form2').submit();
    });



    $("#btnUpload3").click(function() {
        $("#file3").click();
    });

    $('#file3').change(function() {
          var status = $('#status');
          console.log('start!');
          $('#form3').ajaxForm({
              beforeSend: function() {
                  status.empty();
              },
              uploadProgress: function(event, position, total, percentComplete) {
                  console.log('uploading...');
                  $('#loader3').css('display','block');
                  var bd = $('.modal-backdrop');
                  bd.css('display','block');
              },
              complete: function(xhr) {
                console.log(xhr.responseText.replace(/\"|\\/g, ""));
                var ct = xhr.getResponseHeader("content-type") || "";
                if (ct.indexOf('text') > -1) {
                  //do something
                  var x = xhr.responseText.replace(/\"|\\/g, "");
                  var newSrc = $('#imgPlaceholder3').attr('src').replace( $('#imgPlaceholder3').attr('src'), x);
                  $("#imgPlaceholder3").attr("src", x);
                  $('#loader3').css('display','none');
                  var bd = $('.modal-backdrop');
                  bd.css('display','none');
                }
                if (ct.indexOf('json') > -1) {
                  // handle json here
                  var x = xhr.responseText.replace(/\"|\\/g, "");
                  $('#myModal2').modal('show');
                  $('#information').innerHTML = x;
                  $('#loader3').css('display','none');
                  var bd = $('.modal-backdrop');
                  bd.css('display','none');
                }
              }
          });

          $('#form3').submit();
    });


    $("#btnUpload4").click(function() {
        $("#file4").click();
    });

    $('#file4').change(function() {
          var status = $('#status');
          console.log('start!');
          $('#form4').ajaxForm({
              beforeSend: function() {
                  status.empty();
              },
              uploadProgress: function(event, position, total, percentComplete) {
                  console.log('uploading...');
                  $('#loader4').css('display','block');
                  var bd = $('.modal-backdrop');
                  bd.css('display','block');
              },
              complete: function(xhr) {
                console.log(xhr.responseText.replace(/\"|\\/g, ""));
                var ct = xhr.getResponseHeader("content-type") || "";
                if (ct.indexOf('text') > -1) {
                  //do something
                  var x = xhr.responseText.replace(/\"|\\/g, "");
                  var newSrc = $('#imgPlaceholder4').attr('src').replace( $('#imgPlaceholder4').attr('src'), x);
                  $("#imgPlaceholder4").attr("src", x);
                  $('#loader4').css('display','none');
                  var bd = $('.modal-backdrop');
                  bd.css('display','none');
                }
                if (ct.indexOf('json') > -1) {
                  // handle json here
                  var x = xhr.responseText.replace(/\"|\\/g, "");
                  $('#myModal2').modal('show');
                  $('#information').innerHTML = x;
                  $('#loader4').css('display','none');
                  var bd = $('.modal-backdrop');
                  bd.css('display','none');
                }
              }
          });

          $('#form4').submit();
    });



	$(function() { // Shorthand for $(document).ready(
	    $('#region').change(function() {
	        if($("#region").val() == "")
	            $("#city").prop("disabled", true);
	        else
	            $("#city").prop("disabled", false);
	    });
	});

	$(function() {
	    $('#region').change(function() {
	        var product = $('#region').val();
	        var token = "<?php echo csrf_token() ?>";
	        if(product != 0) {
	            $.ajax({
	                type:'post',
	                url:"{{ url('get-city') }}",
	                data: { 
	                	"id": product,
	                	"_token": token,
	                },
	                cache: false,
	                success: function(returndata){
						$('#city')
						    .find('option')
						    .remove()
						    .end();
						// push json data
						returndata.push(
						    { id: 9999, provinsi: "Lainnya", kota: "Lainnya" }
						);
	                	$.each(returndata, function(index, element) {
	                		
							console.log(element);
				            $('#city').append($('<option>', {
				            	value: element.id,
				                text: element.kota
				            }));
				            // $('#city').append($('<option>', {
				            // 	value: 'lainnya',
				            //     text: 'Lainnya'
				            // }));
				        });
	                }
	            });
	        }
	    }).change();
	});

</script>
@stop