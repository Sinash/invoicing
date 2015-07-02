@extends('admin.layouts.modal') {{-- Content --}} @section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab"> {{
			trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
<form class="form-horizontal" enctype="multipart/form-data"	method="post" action="@if(isset($excelsap)){{ URL::to('admin/excelsap/'.$excelsap->id.'/edit') }} @else{{ URL::to('admin/excelsap/create') }}@endif" autocomplete="off">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<div class="tab-content">
		<div class="tab-pane active" id="tab-general">
			<div class="form-group">
				<div class="col-lg-12">
					<label class="control-label" for="excelfile">{{
						trans("admin/excelsap.excelfile") }}</label> <input type="file" name="excelfile"
						class="uploader" id="excelfile" value="Upload" />
				</div>
			</div>
			<div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
				<div class="col-md-12">
					<label class="control-label" for="description">{{
						trans("admin/excelsap.description") }}</label> <input
						class="form-control" type="text" name="description" id="description"
						value="{{{ Input::old('description', isset($excelsap) ? $excelsap->description : null) }}}" />
					{!!$errors->first('description', '<label class="control-label"
						for="name">:message</label>')!!}
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
			<button type="reset" class="btn btn-sm btn-warning close_popup">
				<span class="glyphicon glyphicon-ban-circle"></span> {{
				trans("admin/modal.cancel") }}
			</button>
			<button type="reset" class="btn btn-sm btn-default">
				<span class="glyphicon glyphicon-remove-circle"></span> {{
				trans("admin/modal.reset") }}
			</button>
			<button type="submit" class="btn btn-sm btn-success">
				<span class="glyphicon glyphicon-ok-circle"></span> 
				@if (isset($excelsap)) 
				    {{ trans("admin/modal.edit") }}
				@else 
				    {{trans("admin/modal.create") }}
			     @endif
			</button>
		</div>
	</div>
</form>
@stop
