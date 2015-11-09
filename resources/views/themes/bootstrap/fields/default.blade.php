<div id="field_{{ $id }}"{!! Html::classes(['form-group', 'has-error' => $hasErrors]) !!}>
    <label for="{{ $id }}" class="col-md-4 control-label">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>

    <div class="controls">
        <div class="col-md-6">
            {!! $input !!}
            @foreach ($errors as $error)
                <p class="help-block">{{ $error }}</p>
            @endforeach
        </div>
    </div>
</div>
