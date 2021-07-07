
@extends('layouts.dash')

@section('title', 'Users Table')

@section('card-header')
    {{ _('Users') }}
@endsection

@section('card-body')
    @can('users.*') 
        @include('tables.users')
    @else
        <p>Sorry, You don't have the permission for this page</p>    
    @endcan

@endsection
