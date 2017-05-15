@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
            	<div class="col-md-6">
            		<div class="panel panel-default">
		            	<div class="panel-heading">
		            		Total Submission
		            	</div>
		            	<div class="panel-body">
		            		<a href="{{ url('admin/panel/home/submissions') }}">{{ $total_submission }}</a>
		            	</div>
		            </div>
            	</div>
            	<div class="col-md-6">
            		<div class="panel panel-default">
		            	<div class="panel-heading">
		            		Unique Submission
		            	</div>
		            	<div class="panel-body">
		            		{{ $unique_submission }}
		            	</div>
		            </div>
            	</div>
            	<div class="col-md-6">
            		<div class="panel panel-default">
		            	<div class="panel-heading">
		            		Total Download
		            	</div>
		            	<div class="panel-body">
		            		{{ $total_download }}
		            	</div>
		            </div>
            	</div>
            	<div class="col-md-6">
            		<div class="panel panel-default">
		            	<div class="panel-heading">
		            		Unique Download
		            	</div>
		            	<div class="panel-body">
		            		{{ $unique_download }}
		            	</div>
		            </div>
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection
