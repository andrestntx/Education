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