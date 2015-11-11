@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  <i class="fa fa-building-o"></i> {{ $company->name }}: 
  @if($user->exists) Usuario {{ $user->name }} @else Nuevo Usuario @endif 
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('companies.company.users.user', $company, $user) !!} @stop
@section('title_form') Datos del Usuario @stop

@section('form')

  {!! Form::model($user, $form_data) !!}
    @include('dashboard.pages.companies.users.inputs')

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

    <div class="form-group form-actions">
      <div class="col-md-8 col-md-offset-4">
          <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
      </div>
    </div>

  {!! Form::close() !!}

@stop
