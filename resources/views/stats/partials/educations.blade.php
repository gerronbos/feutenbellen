<h3>Verdeling studies m.b.t. inschrijvingen</h3>
<table class="table table-bordered">
    <tr>
        <th>Gegevens</th>
        <th style="width:25%;">Waarde</th>
    </tr>
    @foreach($educations as $education)
        <tr>
            <td>{{$education["education"]}}</td>
            <td>{{$education["count"]}}</td>
        </tr>
    @endforeach
    
</table>