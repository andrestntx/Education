@extends('dashboard.pages.form-layouts.horizontal')
@section('class_icon_page') fa fa-user @stop
@section('title_page')
  <i class="fa fa-building-o"></i> {{ $company->name }}: 
  @if($user->exists) Usuario {{ $user->name }} @else Nuevo Usuario @endif 
@stop
@section('breadcrumbs') @stop
@section('title_form') Datos del Usuario @stop
@section('form')

  {!! Form::model($user, $form_data) !!}

      <div class="form-group">
          <label class="col-md-4 control-label" for="url_photo">Foto de Perfil <span class="text-danger">*</span></label>
          <div class="col-md-6">
              <div class="input-group">
                <input id="url_photo" name="url_photo" type="file" class="file"></input>
              </div>
          </div>
      </div>

      {!! Field::text('username', null, ['ph' => 'Nombre con el que iniciará sesión']) !!}
      
      {!! Field::password('password', ['ph' => 'Contraseña']) !!}
      
      {!! Field::password('password_confirmation', ['ph' => 'Repita la Contraseña']) !!}
      
      {!! Field::text('name', null, ['ph' => 'Nombres y Apellidos']) !!}
      
      {!! Field::email('email', null, ['ph' => 'Correo electrónico']) !!}

      {!! Field::text('tel', null, ['ph' => 'Teléfono fijo o Celular']) !!}
      
      @if(Auth::user()->isAdmin())
        <div class="form-group">
            <label class="col-md-4 control-label" for="roles[]">Perfiles <span class="text-danger">*</label>
            <div class="col-md-6">
                <div class="input-group">
                    {!! Form::select('roles[]', $roles, $user->roles()->lists('id'), array('class' => 'form-control', 'multiple' => 'multiple', 'required' => 'required')) !!}
                    <span class="input-group-addon"><i class="gi gi-old_man"></i></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="areas[]">Áreas <span class="text-danger">*</label>
            <div class="col-md-6">
                <div class="input-group">
                    {!! Form::select('areas[]', $areas, $user->areas()->lists('id'), array('class' => 'form-control', 'multiple' => 'multiple', 'required' => 'required')) !!}
                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                </div>
            </div>
        </div>
      @endif
      
  <!-- END First Step -->

    <!-- Form Buttons -->
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
        </div>
    </div>
    <!-- END Form Buttons -->
  {!! Form::close() !!}
@stop

@section('js_aditional')
  
@stop