<div class="form-group">
	<label class="col-md-2 control-label" for="{{ $name }}"> {{ $label }} 
		@if(isset($required))
			<span class="text-danger">*</span>
		@endif
	</label>
	<div class="col-md-9">
	  <div class="input-group">
	  		{!! $control !!}
	      	<span class="input-group-addon"><i class="fa fa-bars"></i></span>
	  </div>
	  @if ($error)<div class="help-block animation-pullUp" style="color: #de815c;">{{ $error }}</div>@endif
	</div>
</div>