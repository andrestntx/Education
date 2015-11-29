@extends('dashboard.pages.layout')

@section('title_page') 
    <i class="fa fa-check-square-o fa-fw"></i> {{ $format->name }}: Listas de chequeo
    <a href="{{ route('myformats.checklists.create', $format) }}" class="btn btn-primary @if(! $format->isAviable()) disabled @endif " title="Apicar lista de chequeo">
        <i class="fa fa-plus"></i> 
    </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('myformats.checklists', $format) !!} @stop

@section('content_body_page')

    
    
@stop