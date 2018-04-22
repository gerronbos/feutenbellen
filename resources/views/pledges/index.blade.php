@extends("templates.master")
@section("head")
<meta name="csrf-token" content="{{csrf_token()}}">
<script>window.Laravel = { csrfToken: '{{csrf_token()}}' }</script>
@stop
@section("content")

<a href="{{route("pledges.import")}}" class="btn btn-primary" style="margin:1%;">Feuten importeren</a>
<a href="{{Route("pledges.dups")}}" class="btn btn-default"style="margin:1%;">Mogelijke duplicaten <span class="badge">{{$could_dups}}</span></a>
<div id="app">
    <pledges></pledges>
</div>

@stop

@section("scripts")
<script src="{{asset('js/app.js')}}"></script>
@stop