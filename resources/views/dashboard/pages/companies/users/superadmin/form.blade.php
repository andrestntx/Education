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

    <div class="form-group form-actions">
      <div class="col-md-8 col-md-offset-4">
          <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
      </div>
    </div>
  {!! Form::close() !!}

@stop
