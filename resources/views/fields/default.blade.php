     <div class="form-group">
          <div class="col-xs-12">
              {!! $control !!}
              @if ($error)
                <div class="help-block animation-pullUp" style="color:#de815c;">{{ $error }}</div>
              @endif
          </div>
      </div>