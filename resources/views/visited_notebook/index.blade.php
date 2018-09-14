@extends('navs.layouts')

@section('content')
<div id="visitednotebook">
	<div class="content-wrapper">
		<visitednotebook :notebook_id="{{ $id }}" :notebook="{{ $notebook }}" :pinned_notes="{{ $pinned_notes }}" :note_list="{{ $note_list }}"></visitednotebook>
	</div>
</div>
@stop