@extends("templates.master")
@section("head")
<meta name="csrf-token" content="{{csrf_token()}}">
<script>window.Laravel = { csrfToken: '{{csrf_token()}}' }</script>
@stop
@section("content")
    @include("singup.singup")
@stop

@section("scripts")
<script src="{{asset('js/app.js')}}"></script>
@stop