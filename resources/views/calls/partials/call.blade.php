<li class="list-group-item">
    <h4 class="list-group-item-heading">{{$call->result}}</h4>
    <p class="list-group-item-text">
        <table>
            <tr>
                <td>Gebeld door</td>
                <td>: {{$call->user["name"]}}</td>
            </tr>
            <tr>
                <td>Tijd</td>
                <td>: {{date("Y-m-d H:i", strtotime($call->craeted_att))}}</td>
            </tr>
            <tr>
                <td>Notities</td>
                <td>: {{$call->description}}</td>
            </tr>
        </table>
    </p>
</li>