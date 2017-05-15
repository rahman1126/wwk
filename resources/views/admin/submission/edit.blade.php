@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <h3>Edit Receipt</h3>
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

        </div>
    </div>
</div>
@stop