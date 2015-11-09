@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-users @stop
@section('title_page') Mi Perfil @stop
@section('breadcrumbs')

@stop
@section('content_body_page')
	<!-- User Profile Row -->
    <div class="row">
        <div class="col-md-5 col-lg-4">
            <div class="widget">
                <div class="widget-image widget-image-sm">
                    <img src="img/placeholders/photos/photo1@2x.jpg" alt="image">
                    <div class="widget-image-content text-center">
                        <img src="{{URL::to($user->image)}}" alt="avatar" class="img-circle img-thumbnail img-thumbnail-transparent img-thumbnail-avatar-2x push">
                        <h2 class="widget-heading text-light"><strong>{{ $user->name }}</strong></h2>
                        <h4 class="widget-heading text-light-op"><em>{{ $user->name_role }}</em></h4>
                    </div>
                </div>
                <div class="widget-content widget-content-full border-bottom">
                    <div class="row text-center">
                        <div class="col-xs-6 push-inner-top-bottom border-right">
                            <h3 class="widget-heading"><i class="fa fa-file-text text-danger push"></i> <br><small><strong>{{ $number_protocols }}</strong> Protocolos </small></h3>
                        </div>
                        <div class="col-xs-6 push-inner-top-bottom">
                            <h3 class="widget-heading"><i class="gi gi-folder_closed themed-color-social push"></i> <br><small><strong>{{ $number_exams }}</strong> Examenes</small></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-lg-8">
            <div class="block full">
                <!-- Block Tabs Title -->
                <div class="block-title">
                    <h2>Editar Perfil</h2>
                </div>
                <!-- END Block Tabs Title -->

                <!-- Tabs Content -->
                <div class="form-horizontal form-bordered">
                    <!-- Validation Wizard Content -->
				  	{{Form::model($user, $form_data)}}
				  	<!-- First Step -->
				      <!-- END Step Info -->
				      <!-- Dropzone Block -->
				      <div class="form-group">
				          <label class="col-md-4 control-label" for="url_photo">Foto de Perfil <span class="text-danger">*</span></label>
				          <div class="col-md-6">
				              <div class="input-group">
				                <input id="url_photo" name="url_photo" type="file" class="file"></input>
				              </div>
				          </div>
				      </div>
				      <div class="form-group">
				          <label class="col-md-4 control-label" for="username">Nombre de usuario <span class="text-danger">*</span></label>
				          <div class="col-md-6">
				              <div class="input-group">
				                  {{Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Nombre con el que iniciará sesión', 'required' => 'required'))}}
				                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
				              </div>
				          </div>
				      </div>
				      <div class="form-group">
				          <label class="col-md-4 control-label" for="password">Contraseña </label>
				          <div class="col-md-6">
				              <div class="input-group">
				                  {{Form::input('password', 'password', null, array('class' => 'form-control', 'placeholder' => 'Contraseña'))}}
				                  <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
				              </div>
				          </div>
				      </div>
				      <div class="form-group">
				          <label class="col-md-4 control-label" for="password_confirmation">Confirmar Contraseña </label>
				          <div class="col-md-6">
				              <div class="input-group">
				                  {{Form::input('password', 'password_confirmation', null, array('class' => 'form-control', 'placeholder' => 'Confirmar Contraseña'))}}
				                  <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
				              </div>
				          </div>
				      </div>
				      <div class="form-group">
				          <label class="col-md-4 control-label" for="name">Nombres y Apellidos <span class="text-danger">*</span></label>
				          <div class="col-md-6">
				              <div class="input-group">
				                  {{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nombres y Apellidos', 'required' => 'required'))}}
				                  <span class="input-group-addon"><i class="gi gi-user"></i></span>
				              </div>
				          </div>
				      </div>
				      <div class="form-group">
				          <label class="col-md-4 control-label" for="email">Correo electrónico <span class="text-danger">*</span></label>
				          <div class="col-md-6">
				              <div class="input-group">
				                  {{Form::input('email', 'email', null, array('class' => 'form-control', 'placeholder' => 'Correo electrónico'))}}
				                  <span class="input-group-addon"><i class="gi gi-imac"></i></span>
				              </div>
				          </div>
				      </div>
				      <div class="form-group">
				          <label class="col-md-4 control-label" for="tel">Teléfono</label>
				          <div class="col-md-6">
				              <div class="input-group">
				                  {{Form::text('tel', null, array('class' => 'form-control', 'placeholder' => 'Teléfono fijo o Celular'))}}
				                  <span class="input-group-addon"><i class="gi gi-iphone"></i></span>
				              </div>
				          </div>
				      </div>				      
				  <!-- END First Step -->

				    <!-- Form Buttons -->
				    <div class="form-group form-actions">
				        <div class="col-md-8 col-md-offset-4">
				            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar {{Auth::user()->editTypeUser()}}</button>
				        </div>
				    </div>
				    <!-- END Form Buttons -->
				  {{Form::close()}}
                </div>
                <!-- END Tabs Content -->
            </div>
        </div>
    </div>
    <!-- END User Profile Row -->
@stop

@section('js_aditional')
  <script type="text/javascript">
    $('.file').fileinput({
      initialPreview: "<img src='{{url($user->image)}}' class='file-preview-image' alt='Foto de Perfil' title='Foto de Perfil' >",
      showCaption: true, 
      showUpload: false, 
      showPreview: true, 
      maxFileCount: 1, 
    }); 
  </script>
@stop