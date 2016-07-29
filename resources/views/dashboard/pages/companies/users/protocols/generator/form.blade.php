@extends('dashboard.pages.form-layouts.horizontal-large')
@section('title_page')
  <i class="fa fa-file-text"></i> 
  @if($generatedProtocol->exists) Editar Protocolo Generado @else Generar nuevo Protocolo @endif
@stop
@section('breadcrumbs') {!! Breadcrumbs::render('generated-protocols.protocol', $generatedProtocol) !!} @stop 
@section('title_form') Datos del Protocolo @stop
@section('form')
  {!! Form::model($generatedProtocol, $form_data) !!}
    <div class="row">

      {!! Field::text('title', ['ph' => 'Titulo del protocolo', 'tpl' => 'themes.bootstrap.fields.large', 'required']) !!}

        <div class="col-md-12">
          @foreach($questions as $question)
            @include('dashboard.pages.companies.users.protocols.generator.fieldset-question', ['question' => $question, 'generatedProtocol' => $generatedProtocol])
          @endforeach
        </div>
      </div>
      <div class="form-group form-actions">
          <div class="col-md-12 text-center">
              <button type="submit" class="btn btn-effect-ripple btn-primary btn-lg">Guardar Protocolo</button>
          </div>
      </div>
    </div>
  {!! Form::close() !!}
@stop

@section('js_aditional')
  <!-- ckeditor.js, load it only in the page you would like to use CKEditor (it's a heavy plugin to include it with the others!) -->
  <script src="/assets/js/plugins/ckeditor/ckeditor.js"></script>
@endsection

