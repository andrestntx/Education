<div class="form-group">
	{!! Form::label($name, $label, ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
	  <div class="input-group">
	  		{!! $control !!}
	      	<span class="input-group-addon"><i class="fa fa-bars"></i></span>
	  </div>
	  <div class="help-block animation-pullUp" style="color: #de815c;" id="error-{!! $name !!}"></div>
	</div>
</div>

