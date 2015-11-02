<div class="form-group">
	{!! Form::label($name1, $label, ['class' => 'col-md-3 control-label']) !!}
	<div class="col-md-8">
		<div class="input-group input-daterange" data-date-format="mm/dd/yyyy">
			{!! $control1 !!}
			<span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
			{!! $control2 !!}
			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		</div>
		@if ($error1)
			<div class="help-block animation-pullUp" style="color: #de815c;">{{ $error1 }}</div>
		@endif
		@if ($error2)
			<div class="help-block animation-pullUp" style="color: #de815c;">{{ $error2 }}</div>
		@endif
	</div>
</div> 
