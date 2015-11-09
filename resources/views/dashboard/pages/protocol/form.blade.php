@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  @if($protocol->exists) Editar Protocolo: {{$protocol->name}} @else Nuevo Protocolo @endif
@stop
@section('title_form') Datos del Protocolo @stop
@section('form')
  {{ Form::model($protocol, $form_data) }}
    {{ Form::input('hidden', 'user_id', Auth::user()->id) }}
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Nombre del Protocolo <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nombre del Protocolo', 'required' => 'required'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div> 
    <div class="form-group">
      <label class="col-md-4 control-label" for="survey_aviable">Habilitar Examen </label>
      <div class="col-md-6">
          <div class="input-group">
              <label class="switch switch-info"><input type="checkbox" name="survey_aviable" value="true" @if($protocol->survey_aviable) checked @endif ><span></span></label>
          </div>
      </div>
    </div> 
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">Descripción del Protocolo </label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('description', null, array('class' => 'form-control', 'placeholder' => 'Descripción del Protocolo'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>   
    <div class="form-group">
      <label class="col-md-2 control-label" for="description" 
      title="Active esta casilla si desea subir el archivo Pdf a la Aplicación">
        PDF
      </label>
      <div class="col-md-2">
        <div class="input-group">
            <label class="switch switch-info" 
            title="Active esta casilla si desea subir el archivo Pdf a la Aplicación">
              <input type="checkbox" name="is_upload" id="is_upload" value="true"><span></span>
            </label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-group" id="div_file_pdf">
          <input id="file_pdf" name="url_pdf" type="file" class="file"></input>
        </div>
        <div class="input-group" id="div_link_pdf">
          {{ Form::url('url_pdf', null, array('class' => 'form-control', 'pattern' => 'https?://.+', 
            'placeholder' => 'http://pagina-externa/archivo.pdf', 'id' => 'link_pdf', 'required' => 'required', 
            'title' => 'Recuerde escribir la URL con http://')) 
          }}
          <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
        </div>
      </div>
    </div>   
    <div class="form-group">
      <label class="col-md-4 control-label" for="categories[]">Categorias <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::select('categories[]', $categories, $protocol->categories_lists, 
                array('class' => 'form-control', 'placeholder' => 'Categorías del Protocolo', 
                  'multiple' => 'multiple', 'required' => 'required'))
              }}
              <span class="input-group-addon"><i class="gi gi-tags"></i></span>
          </div>
      </div>
    </div>  
    <div class="form-group">
      <label class="col-md-4 control-label" for="areas[]">Áreas <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::select('areas[]', $areas, $protocol->areas_lists, 
                array('class' => 'form-control', 'placeholder' => 'Áreas del Protocolo', 
                  'multiple' => 'multiple', 'required' => 'required'))
              }}
              <span class="input-group-addon"><i class="gi gi-sort"></i></span>
          </div>
      </div>
    </div>    
    <div class="form-group">
      <label class="col-md-4 control-label" for="roles[]">Perfiles <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::select('roles[]', $roles, $protocol->roles_lists, 
                array('class' => 'form-control', 'placeholder' => 'Categorías del Protocolo', 
                  'multiple' => 'multiple', 'required' => 'required'))
              }}
              <span class="input-group-addon"><i class="gi gi-old_man"></i></span>
          </div>
      </div>
    </div> 
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Protocolo</button>
        </div>
    </div>
  {{Form::close()}}
@stop

@section('js_aditional')
  {{ HTML::script('assets/js/plugins/forms/file-validator.js') }}

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