<div class="form-group">
	<label class="col-md-4 control-label" for="{{ $name }}"> 
		<img src="/images/placeholders/icons/loading.gif" id="loading-gif" style="display:none;"> 
		{{ $label }} 
		
		@if(isset($required))
			<span class="text-danger">*</span>
		@endif
	</label>
	<div class="col-md-6">
	  <div class="input-group">
	  		{!! $control !!}
	      	<span class="input-group-addon"><i class="fa fa-bars"></i></span>
	  </div>
	  @if ($error)<div class="help-block animation-pullUp" style="color: #de815c;">{{ $error }}</div>@endif
	</div>
</div>