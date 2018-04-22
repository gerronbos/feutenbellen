@extends("templates.master")

@section("content")
<a href="{{route("users.new")}}" class="btn btn-primary" style="margin:1%;">Nieuwe gebruiker aanmaken</a>
<table class="table table-bordered">
    <tr>
        <th>Naam</th>
        <th>Username</th>
        <th>Role</th>
        <th>Laatste inlog moment</th>
        <th>Opties</th>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->role}}</td>
            <td>{{date("Y-m-d G:i",strtotime($user->last_login))}}</td>
            <td>
                <a href="{{route("users.edit",[$user->id])}}" class="btn btn-default">Wijzig</a>
                <a href="#" class="btn btn-danger">Verwijder</a>
            </td>
        </tr>
    @endforeach
</table>

@stop