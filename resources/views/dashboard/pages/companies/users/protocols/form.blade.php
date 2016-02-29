@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  @if($protocol->exists) Editar Protocolo: {{$protocol->name}} @else Nuevo Protocolo @endif
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('protocols.protocol', $protocol) !!} @stop

@section('title_form') Datos del Protocolo @stop
@section('form')
  {!! Form::model($protocol, $form_data) !!}
    
    {!! Field::text('name', ['ph' => 'Nombre del Protocolo']) !!}

    <div class="form-group">
      <label class="col-md-4 control-label" for="survey_aviable">Habilitar Examen </label>
      <div class="col-md-6">
          <div class="input-group">
              <label class="switch switch-info"><input type="checkbox" name="aviable" value="1" @if($protocol->aviable) checked @endif ><span></span></label>
          </div>
      </div>
    </div>

    {!! Field::text('description', ['ph' => 'Descripción del Protocolo']) !!}
  
    <div class="form-group">
      <label class="col-md-2 control-label" for="description" 
      title="Active esta casilla si desea subir el archivo Pdf a la Aplicación">
        PDF
      </label>
      <div class="col-md-2">
        <div class="input-group">
            <label class="switch switch-info" data-toggle="tooltip" data-placement="top"
            title="Active esta opción para subir el Protocolo en PDF o desactivela y escriba la dirección URL">
              <input type="checkbox" name="is_upload" id="is_upload" value="true"><span></span>
            </label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-group" id="div_file_pdf">
          <input id="file_pdf" name="file_doc" type="file" class="file" accept="application/pdf"></input>
        </div>
        <div class="input-group" id="div_link_pdf" style="width:100%;">
          {!! Form::text('url_doc', null, array('class' => 'form-control',
            'placeholder' => 'http://pagina-externa/archivo.pdf', 'id' => 'link_pdf'))
          !!}
        </div>
      </div>
    </div>   

    {!! Field::select('categories.', $categories, $protocol->category_id_lists, ['multiple', 'required']) !!}

    {!! Field::select('areas.', $areas, $protocol->area_id_lists, [ 'multiple', 'required']) !!}

    {!! Field::select('roles.', $roles, $protocol->role_id_lists, [ 'multiple', 'required' ]) !!}
    
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Protocolo</button>
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