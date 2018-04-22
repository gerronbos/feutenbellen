<h3>Verdeling studies m.b.t. inschrijvingen</h3>
<table class="table table-bordered">
        <tr>
            <th>Gegevens</th>
            <th style="width:25%;">Waarde</th>
        </tr>
        @foreach($cities as $city)
        <tr>
            <td>{{$city["living_place"]}}</td>
            <td>{{$city["count"]}}</td>
        </tr>
    @endforeach
</table>