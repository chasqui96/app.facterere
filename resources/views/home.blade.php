@extends('layouts.app')
@section('content')
@include('partial.succes') 
@include('partial.error')
<transition name="slideDown" mode="out-in">
    <router-view :pedido_compra="{{ Auth::user()}}"></router-view>
</transition>
@endsection
