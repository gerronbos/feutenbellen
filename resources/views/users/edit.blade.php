@extends("templates.master")


@section("content")
    <h3>{{$user->name}} wijzigen</h3>
    @include("users.form")
@stop
