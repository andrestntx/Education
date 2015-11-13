<div class="sidebar-section">
    <h2 class="text-light">Mi Perfil</h2>

    {!! Form::model(Auth::user(), [
        'route' => ['users.update', Auth::user()->id], 'method' => 'PUT', 'files' => true, 
        'class' => 'form-control-borderless', 'onsubmit' => 'return true;'
    ]) !!}

        
        
        {!! Field::file('url_photo', ['tpl' => 'themes.bootstrap.fields.simple']) !!}
        {!! Field::text('username', ['tpl' => 'themes.bootstrap.fields.simple']) !!}
        {!! Field::text('name', ['tpl' => 'themes.bootstrap.fields.simple']) !!}
        {!! Field::text('email', ['tpl' => 'themes.bootstrap.fields.simple']) !!}
        {!! Field::password('password', ['tpl' => 'themes.bootstrap.fields.simple']) !!}
        {!! Field::password('password-confirm', ['tpl' => 'themes.bootstrap.fields.simple']) !!}

        <div class="form-group remove-margin">
            <button type="submit" class="btn btn-effect-ripple btn-primary" onclick="App.sidebar('close-sidebar-alt');">Actualizar</button>
        </div>

    {!! Form::close() !!}

</div>