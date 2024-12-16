@extends('adminlte::page')

@section('js')
    <script>
        $('.main-sidebar').css({'position':'fixed'});
    </script>
    @yield('master-js')
@stop
