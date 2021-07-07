
@extends('layouts.app')

@php
     $title_page = $title ?? 'Products';
    if(Request::url() === route('products.my'))    
        $title_page = 'My Products';
@endphp


@section('title', $title_page)

@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-around">
        @isset($products)
            @if (count($products) == 0 )
                 @include('errors.alert')
            @else
                @foreach ($products as $product)
                    <div style="width:265px" class="m-3">
                        @include('components.product')
                    </div>    
                @endforeach  
            @endif         
        @endisset
    </div>
</div>
@endsection


@section('scripts')
    
@endsection
