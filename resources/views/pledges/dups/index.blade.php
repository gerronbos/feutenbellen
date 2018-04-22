@extends("templates.master")


@section("content")

<table class="table table-borderd">
    <tr>
        <th>Feut_id</th>
        <th>Duplicate van</th>
        <th>Naam</th>
        <th>Email</th>
        <th>Nummer</th>
        <th>Opties</th>
    </tr>

    @foreach($dups as $dup)
        <tr>
            <td><a href="{{route("call.show",[$dup->id])}}" target="_blank">{{$dup->id}}</a></td>
            <td><a href="{{route("call.show",[$dup->dup_id])}}" target="_blank">{{$dup->dup_id}}</a></td>
            <td>{{$dup->fullname}}</td>
            <td>{{$dup->email}}</td>
            <td>{{$dup->mobile}}</td>
            <td><button type="butotn" data-id="{{$dup->id}}" data-dup_id="{{$dup->dup_id}}" class="btn btn-default see_dup">Vergelijken</button><a href="{{route("pledges.dups.set.status",[$dup->id,1])}}" class="btn btn-danger">Is duplicaat</a><a href="{{route("pledges.dups.set.status",[$dup->id,0])}}" class="btn btn-success">Is geen duplicaat</a></td>
        </tr>
    @endforeach
</table>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Vergelijken</h4>
        </div>
        <div class="modal-body">
            <table class="table table-borderd">
                <tr>
                    <th>Waarde</th>
                    <th>Feut</th>
                    <th>Duplicaat van</th>
                </tr>
                <tr>
                    <td>ID:</td>
                    <td id="id_pledge"></td>
                    <td id="id_dup"></td>
                </tr>
                <tr>
                    <td>Naam:</td>
                    <td id="name_pledge"></td>
                    <td id="name_dup"></td>
                </tr>
                <tr>
                    <td>Adress:</td>
                    <td id="addres_pledge"></td>
                    <td id="addres_dup"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td id="mail_pledge"></td>
                    <td id="mail_dup"></td>
                </tr>
                <tr>
                    <td>Mobiel nummer:</td>
                    <td id="mobile_pledge"></td>
                    <td id="mobile_dup"></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
@stop


@section("scripts")
<script>   
var url = '{{route("api.pledge.get",[":id"])}}';
console.log(url);

$(".see_dup").click(function(){
    $.get(url.replace(":id",$(this).attr("data-id")),function(data){
        $("#id_pledge").text(data.data.id);
        $("#name_pledge").text(data.data.name);
        $("#addres_pledge").text(data.data.addres);
        $("#mail_pledge").text(data.data.email);
        $("#mobile_pledge").text(data.data.phone);
    });
    $.get(url.replace(":id",$(this).attr("data-dup_id")),function(data){
        $("#id_dup").text(data.data.id);
        $("#name_dup").text(data.data.name);
        $("#addres_dup").text(data.data.addres);
        $("#mail_dup").text(data.data.email);
        $("#mobile_dup").text(data.data.phone);
    });

    $("#modal").modal();
});

</script>
@stop
