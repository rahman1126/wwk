@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <h3>Edit Receipt</h3>

        @if(Session::has('error'))
            <p class="alert alert-danger">{{ Session::get('error') }}</p>
        @elseif(Session::has('success'))
            <p class="alert alert-success">{{ Session::get('success') }}</p>
        @endif

        <div class="row">
            @foreach($images as $item)
            <div class="col-md-3">
                <img src="{{ $item->image_url }}" class="thumbnail img-responsive" alt="Responsive image" data-toggle="modal" data-target="#myModal-{{ $item->id }}" style="cursor: zoom-in;">
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <img src="{{ $item->image_url }}" class="img-responsivex">
                </div>
              </div>
            </div>
            @endforeach
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                @if(Session::has('error'))
                <p class="text-danger">
                    {{ Session::get('error') }}
                </p>
                @endif
                <form method="post" action="{{ url('admin/panel/home/submission/update') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ ( $errors->has('name') ? 'has-error' : '' ) }}">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ $data->name }}">
                                @if($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ ( $errors->has('phone') ? 'has-error' : '' ) }}">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ $data->phone }}">
                                @if($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ ( $errors->has('id_card') ? 'has-error' : '' ) }}">
                                <label>ID Card</label>
                                <input type="text" name="id_card" class="form-control" value="{{ $data->id_card }}">
                                @if($errors->has('id_card'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_card') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ ( $errors->has('address') ? 'has-error' : '' ) }}">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $data->address }}">
                                @if($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ ( $errors->has('store_name') ? 'has-error' : '' ) }}">
                                <label>Store Name</label>
                                <input type="text" name="store_name" class="form-control" value="{{ $data->store_name }}">
                                @if($errors->has('store_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('store_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ ( $errors->has('nominal') ? 'has-error' : '' ) }}">
                                <label>Nominal</label>
                                <input type="text" name="nominal" class="form-control" value="{{ $data->nominal }}">
                                <small><i>*Tanpa tanda baca</i></small>
                                @if($errors->has('nominal'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nominal') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Unique Code</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($data->coupon as $undian)                            
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $undian->coupon_code }}</td>
                            <td>{{ $undian->created_at->format('d/m/y h:i:s') }}</td>
                            <td>
                                <form style="display: inline;" method="post" action="{{ url('admin/panel/home/submission/send/code') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="code" value="{{ $undian->coupon_code }}">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <button class="btn btn-sm btn-info">Send Code</button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                        <tr>
                            <td>
                                <form style="display: inline;" method="post" action="{{ url('admin/panel/home/submission/edit/add/code') }}">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="btn btn-sm btn-warning">Add new code</button><br>
                                </form>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <p><i>Press <b>Add new code</b> button to add more coupon code to this user. There is no alert when you press this button. So make sure you know what you doing.</i></p>
                        <p><i>Press <b>Send code</b> button to send code to this user. Make sure you only send the new code you just created. (see the date created)</i></p>
                    </tbody>
                </table>
            </div>
        </div>

        </div>
    </div>
</div>
@stop