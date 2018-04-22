<h3>Aantal feuten per gebruiker</h3>
<table class="table table-bordered">
    <tr>
        <th style="width:5%;">Plaats</th>
        <th>Gebruiker</th>
        <th style="width:25%;">Aantal feuten</th>
    </tr>
    @foreach($users_get_pledges as $key=>$user)
        @if($user->user)
            <tr @if($key == 0) style="color:gold;" @elseif($key == 1) style="color:#A6A6A6;" @elseif($key == 2) style="color:#CD7F32;" @endif>
                <td>@if($key == 0) <img src="gfx/nummer1.png" style="width:50px;"> @elseif($key == 1) <img src="gfx/nummer2.png" style="width:50px;"> @elseif($key == 2) <img src="gfx/nummer3.png" style="width:50px;"> @else {{$key + 1}}@endif</td>
                <td>{{$user->user["name"]}}</td>
                <td>{{$user->count}}</td>
            </tr>
        @else
            <tr>
                <td>@if($key == 0) <img src="gfx/nummer1.png" style="width:50px;"> @elseif($key == 1) <img src="gfx/nummer2.png" style="width:50px;"> @elseif($key == 2) <img src="gfx/nummer3.png" style="width:50px;"> @else {{$key + 1}}@endif</td>
                <td>Zelf ingeschreven</td>
                <td>{{$user->count}}</td>
        @endif
        
    @endforeach

</table>