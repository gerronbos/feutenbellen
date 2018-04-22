<h3>Standaard gegevens</h3>
<table class="table table-bordered">
    <tr>
        <th>Gegevens</th>
        <th style="width:25%;">Waarde</th>
    </tr>
    <tr>
        <td>Ingelogd als</td>
        <td>{{Auth::user()->name}}</td>
    </tr>
    <tr>
        <td>Totaal aantal feuten in het systeem</td>
        <td>{{$total_pledges}}</td>
    </tr>
    <tr>
        <td>Feuten met een telefoon nummer</td>
        <td>{{$total_pledges_with_phone}}</td>
    </tr>
    <tr>
        <td>Feuten zonder telefoon nummer</td>
        <td>{{$total_pledges - $total_pledges_with_phone}}</td>
    </tr>
</table>