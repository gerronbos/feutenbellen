@extends("templates.master")
@section("head")
<meta name="csrf-token" content="{{csrf_token()}}">
<script>window.Laravel = { csrfToken: '{{csrf_token()}}' }</script>
@stop
@section("content")
{!! Form::open() !!}
@if(!Request::input("call_id") && in_array($pledge->status,[0,1,5]))
    <button class="btn btn-success" style="margin-left: 1%; margin-bottom:1%;">Bellen</button>
@elseif($pledge->status == 2)
    <a href="{{route("resendmail",[$pledge->id])}}" class="btn btn-default" style="margin-left: 1%; margin-bottom:1%;">Opnieuw mail sturen</a>    
@endif
<a href="{{route("pledges.edit",[$pledge->id])}}" class="btn btn-default" style="margin-bottom:1%;">Wijzigen</a>
@if(Request::input("call_id"))
    <h3 style="color:red;">Wordt gebeld door: <b>{{$current_call->user["name"]}}</b></h3>
@endif

{!! Form::close() !!}
<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <th>Naam</th>
                <td>{{$pledge->fullName}}</td>
            </tr>
            <tr>
                <th>Leeftijd</th>
                <td>{{$pledge->age}}</td>
            </tr>
            <tr>
                <th>Geslacht</th>
                <td>{{$pledge->sexLabel}}</td>
            </tr>
            <tr>
                <th>Woonplaats</th>
                <td>{{$pledge->address}}</td>
            </tr>
            <tr>
                <th>Telefoon nummer</th>
                <td><table>
                    <tr><td>Thuistelefoon</td><td>: {{$pledge->home_phone}}</td></tr>
                    <tr><td>Mobiel</td><td>: {{$pledge->mobile}}</td></tr>
                    <tr><td>Extra nummer</td><td>: {{$pledge->phone_extra}}</td></tr>
                    <tr><td>Nood nummer</td><td>: {{$pledge->emergency_phone}}</td></tr>
                    </table></td>
            </tr>
        </table>
        @if($pledge->status == 2)
            <h3 class="text-success">{{$pledge->statuslabel}}!!</h3>
        @elseif($pledge->status == 1)
            <h3 class="text-warning">{{$pledge->statuslabel}}!!</h3>
        @elseif($pledge->status == 6)            
            <h3 class="text-info">{{$pledge->statuslabel}}!!</h3>
        @endif
    </div>
    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <th>Opleiding</th>
                <td>{{$pledge->education}} ({{$pledge->educationTypeLabel}})</td>
            </tr>
            <tr>
                <th>Shirt maat</th>
                <td>{{$pledge->shirtSizeLabel}}</td>
            </tr>
            <tr>
                <th>Rabo fiets</th>
                <td>@if($pledge->rabo_bicycle) <span class="label label-success">Ja</span> @else <span class="label label-danger">Nee</span> @endif</td>
            </tr>
            <tr>
                <th>Dieet</th>
                <td>@if($pledge->diet) <span class="label label-success">Ja</span> @else <span class="label label-danger">Nee</span> @endif</td>
            </tr>
            <tr>
                <th>Vegetarisch</th>
                <td>@if($pledge->vegetarian) <span class="label label-success">Ja</span> @else <span class="label label-danger">Nee</span> @endif</td>
            </tr>
            <tr>
                <th>Vooruit betalen</th>
                <td>@if($pledge->pay_forward) <span class="label label-success">Ja</span> @else <span class="label label-danger">Nee</span> @endif</td>
            </tr>
        </table>
    </div>  
</div>
<div class="row">
    <div class="col-md-12 well">
        <b>Opmerkingen</b><br>
        <p>{{$pledge->descrpition}}</p>
    </div>
</div>
@if(Request::input("call_id"))
    {!! Form::open(["style" => "border:red solid 3px; padding:1%;", "url" => route("call.save",[$pledge->id,"call_id" => Request::input("call_id")])]) !!}
        <div class="form-group">
            {!! Form::label("description","Opmerkingen") !!}
            <textarea class="form-control" name="description" rows="6" id="description"></textarea>
        </div>
        <div class="form-group">
            {!! Form::label("result","Resultaat") !!}
            <select class="form-control" name="result" id="result">
                @foreach($call_options as $option)
                    <option value="{{$option}}">{{$option}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-default" name="save" value="save">Opslaan</button>
        <button class="btn btn-success" name="save" value="singup">Inschrijven</button>
        <button class="btn btn-danger" name="save" value="delete">Annuleren</button>
    {!! Form::close() !!}
@endif


<div class="row">
    <h3>Geschiedenis</h3>
    <div class="list-group">
        @each("calls.partials.call",$calls,"call")
    </div> 
</div>
@stop

@section("scripts")
<script src="{{asset('js/app.js')}}"></script>
@stop