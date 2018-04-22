@extends("templates.master")
@section("head")
<meta name="csrf-token" content="{{csrf_token()}}">
<script>window.Laravel = { csrfToken: '{{csrf_token()}}' }</script>
@stop
@section("content")
<h3>Ingeschreven feuten <button class="btn btn-default" onclick="copy('singedup')"><span class="glyphicon glyphicon-duplicate"></span> Kopieër</button></h3>
<textarea class="form-control" id="singedup" rows="15">{{$singedup}}</textarea>

<h3>Niet ingeschreven feuten <button class="btn btn-default" onclick="copy('notsingedup')"><span class="glyphicon glyphicon-duplicate"></span> Kopieër</button></h3>
<textarea class="form-control" id="notsingedup" rows="15">{{$notsingedup}}</textarea>
@stop


@section("scripts")
<script>
    function copy(id) {
        var copyText = document.getElementById(id);
        copyText.select();
        document.execCommand("Copy");
    }
</script>
@stop