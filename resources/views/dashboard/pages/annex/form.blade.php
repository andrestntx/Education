@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  Protocolo {{$protocol->name}} -
  @if($annex->exists) Editar Anexo: {{$annex->name}}
  @else Nuevo Anexo @endif
@stop
@section('title_form') Datos de la Anexo @stop
@section('form')
  {{ Form::model($annex, $form_data) }}
    {{ Form::input('hidden', 'protocol_id', $protocol->id) }}
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Nombre del Anexo <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nombre del Anexo', 'required' => 'required'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>  
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">Descripción de la Anexo </label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('description', null, array('class' => 'form-control', 'placeholder' => 'Descripción del Anexo'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>     
    <div class="form-group">
      <label class="col-md-4 control-label" for="url">Archivo <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
            <input id="url" name="url" type="file" class="file"></input>
          </div>
      </div>
    </div>
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Anexo</button>
        </div>
    </div>
  {{Form::close()}}
@stop

@section('js_aditional')
  <script type="text/javascript">
    $("#url").fileinput({
      initialPreview: "<div class='file-preview-text' title='{{$annex->name}}'>" +
        "{{$annex->description}}" +
        "<span class='wrap-indicator' onclick='$(\"#show-detailed-text\").modal(\"show\")' title='{{$annex->name}}'>[…]</span>" +
        "</div>",
      showCaption: true, 
      showUpload: false, 
      showPreview: true, 
      maxFileCount: 10
    }); 
  </script>

  {{ HTML::script('assets/js/plugins/forms/file-validator.js') }}

@stop
