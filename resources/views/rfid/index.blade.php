@extends('navs.layouts')

@section('title')

@stop

@section('content')
@section('styles')
<style type="text/css">
	.card-body {
		padding: 0px !important;
	}

	.card-text {
		padding: 1em;
	}
</style>
@show
<div id="rfidContainer">
	<navbar></navbar>
	<div class="container">
		<rfid title="RFID Niggas"></rfid>
	</div>
</div>
@stop

@section('scripts')

@stop