@extends('layouts.dash')

@section('card-header')
    {{ __('Login') }}
@endsection

@section('card-body')
    @include('forms.user.login')
@endsection
