<h3>Shirt maten (ingeschreven feuten)</h3>
<table class="table table-bordered">
    <tr>
        <th>Gegevens</th>
        <th style="width:25%;">Waarde</th>
    </tr>
    @foreach($shirt_sizes as $size=>$amount)
        <tr>
            <td>{{$size}}</td>
            <td>{{$amount}}</td>
    @endforeach
    
</table>