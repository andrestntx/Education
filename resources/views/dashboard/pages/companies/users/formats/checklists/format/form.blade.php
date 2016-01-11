@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  <i class="fa fa-check-square-o"></i>
  @if($format->exists) Editar Formato de Chequeo: {{$format->name}} @else Nuevo Formato de Chequeo @endif
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('formats.checklists.format', $format) !!} @stop

@section('title_form') Datos Formato @stop
@section('form')
  {!! Form::model($format, $form_data) !!}
    
    {!! Field::text('name', ['ph' => 'Nombre Formato']) !!}

    <div class="form-group">
      <label class="col-md-4 control-label" for="survey_aviable">Habilitar Formato </label>
      <div class="col-md-6">
          <div class="input-group">
              <label class="switch switch-info"><input type="checkbox" name="aviable" value="1" @if($format->aviable) checked @endif ><span></span></label>
          </div>
      </div>
    </div>

    {!! Field::text('description', ['ph' => 'Descripción Formato']) !!}

    {!! Field::select('areas.', $areas, $format->area_id_lists, [ 'multiple', 'required']) !!}

    {!! Field::select('roles.', $roles, $format->role_id_lists, [ 'multiple', 'required' ]) !!}
    
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Formato</button>
        </div>
    </div>
  {!! Form::close() !!}
@stop

@section('js_aditional')
  {{ Html::script('assets/js/plugins/forms/file-validator.js') }}

  <script type="text/javascript">
    $( document ).ready(function() {
      //Inicialite the HTML
      $("#div_file_pdf").hide();
      $("#div_file_pdf #file_pdf").prop("disabled", true);

      $("#is_upload").change(function() {
        if($(this).is(":checked"))       
        {
          $("#div_link_pdf").hide();
          $("#div_link_pdf #link_pdf").prop("disabled", true);

          $("#div_file_pdf").show();
          $("#div_file_pdf #file_pdf").prop("disabled", false);
        }
        else
        {
          $("#div_file_pdf").hide();
          $("#div_file_pdf #file_pdf").prop("disabled", true);

          $("#div_link_pdf").show();
          $("#div_link_pdf #link_pdf").prop("disabled", false);
        }
      });
    });
  </script>
@stop