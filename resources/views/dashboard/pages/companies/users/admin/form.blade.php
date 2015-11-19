@extends('dashboard.pages.form-layouts.horizontal')

@section('title_page') <i class="fa fa-user"></i> @if($user->exists) {{$user->name}} @else Nuevo Usuario @endif @stop
@section('title_form') Datos de Usuario @stop

@section('breadcrumbs') {!! Breadcrumbs::render('users.user', $user) !!} @stop
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

    {!! Field::text('username', ['ph' => 'Nombre con el que iniciará sesión', 'required' => 'required'])!!}
    {!! Field::password('password', ['ph' => 'Contraseña'])!!}
    {!! Field::password('password_confirmation', ['ph' => 'Confirmar Contraseña '])!!}
    {!! Field::text('name', ['ph' => 'Nombres y Apellidos'])!!}
    {!! Field::text('email', ['ph' => 'Correo electrónico'])!!}
    {!! Field::text('tel', ['ph' => 'Teléfono fijo o Celular'])!!}
    {!! Field::select('roles.', $roles, $user->role_id_lists, ['multiple', 'required']) !!}
    {!! Field::select('areas.', $areas, $user->area_id_lists, ['multiple', 'required']) !!}

<div class="form-group form-actions">
    <div class="col-md-8 col-md-offset-4">
        <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Usuario</button>
    </div>
</div>
{!! Form::close() !!}
@stop

@section('js_aditional')
  <script type="text/javascript">
    $('.file').fileinput({
      initialPreview: "<img src='{!!url($user->image)!!}' class='file-preview-image' alt='Foto de Perfil' title='Foto de Perfil' >",
      showCaption: true, 
      showUpload: false, 
      showPreview: true, 
      maxFileCount: 1, 
    }); 
  </script>

  {!! Html::script('assets/js/plugins/forms/file-validator.js') !!}
@stop