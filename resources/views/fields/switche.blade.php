<div class="form-group">
	{!! Form::label($name, $label, ['class' => 'col-md-3 control-label']) !!}
	<div class="col-md-8">
	  <label class="switch switch-primary">
	  	{!! $control !!}
	  	<span></span>
	  </label>
	</div>
	@if ($error)<div class="help-block animation-pullUp" style="color: #de815c;">{{ $error }}</div>@endif
</div>
