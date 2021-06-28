@extends('themes.default.master')

@section('master-js')
    <script>
        alert('Section-Master-JS!');
    </script>
    @yield('client-js')
@stop
