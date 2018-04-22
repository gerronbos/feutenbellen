{!! Form::open() !!}

    <div class="form-group @if($errors->has("initials")) has-error @endif">
        {!! Form::label("initials","Voorletters") !!}
        {!! Form::text("initials",$pledge->initials,["class"=>"form-control"]) !!}
        @if($errors->has("initials")) <span class="help-block">{{$errors->first("initials")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("firstname")) has-error @endif">
        {!! Form::label("firstname","Voornaam") !!}
        {!! Form::text("firstname",$pledge->firstname,["class"=>"form-control"]) !!}
        @if($errors->has("firstname")) <span class="help-block">{{$errors->first("firstname")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("middlename")) has-error @endif">
        {!! Form::label("middlename","Tussenvoegsel") !!}
        {!! Form::text("middlename",$pledge->middlename,["class"=>"form-control"]) !!}
        @if($errors->has("middlename")) <span class="help-block">{{$errors->first("middlename")}} </span> @endif
    </div>   
    <div class="form-group @if($errors->has("lastname")) has-error @endif">
        {!! Form::label("lastname","Achternaam") !!}
        {!! Form::text("lastname",$pledge->lastname,["class"=>"form-control"]) !!}
        @if($errors->has("lastname")) <span class="help-block">{{$errors->first("lastname")}} </span> @endif
    </div> 
    <div class="form-group @if($errors->has("dateofbirth")) has-error @endif">
        {!! Form::label("dateofbirth","Geboortedatum") !!}
        {!! Form::text("dateofbirth",$pledge->dateofbirth,["class"=>"form-control"]) !!}
        <p class="help-block">yyyy-mm-dd</p>
        @if($errors->has("dateofbirth")) <span class="help-block">{{$errors->first("dateofbirth")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("sex")) has-error @endif">
        {!! Form::label("sex","Geslacht") !!}
        <select class="form-control" name="sex">
            <option value="o" @if($pledge->sex == "o") selected @endif>Onbekend</option>
            <option value="m" @if($pledge->sex == "m") selected @endif>Man</option>
            <option value="v" @if($pledge->sex == "v") selected @endif>Vrouw</option>
        </select>
        @if($errors->has("sex")) <span class="help-block">{{$errors->first("sex")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("living_place")) has-error @endif">
        {!! Form::label("living_place","Woonplaats") !!}
        {!! Form::text("living_place",$pledge->living_place,["class"=>"form-control"]) !!}
        @if($errors->has("living_place")) <span class="help-block">{{$errors->first("living_place")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("living_street")) has-error @endif">
        {!! Form::label("living_street","Straat") !!}
        {!! Form::text("living_street",$pledge->living_street,["class"=>"form-control"]) !!}
        @if($errors->has("living_street")) <span class="help-block">{{$errors->first("living_street")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("living_nr")) has-error @endif">
        {!! Form::label("living_nr","Huisnummer") !!}
        {!! Form::text("living_nr",$pledge->living_nr,["class"=>"form-control"]) !!}
        @if($errors->has("living_nr")) <span class="help-block">{{$errors->first("living_nr")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("living_extra")) has-error @endif">
        {!! Form::label("living_extra","Huisnummer toevoeging") !!}
        {!! Form::text("living_extra",$pledge->living_extra,["class"=>"form-control"]) !!}
        @if($errors->has("living_extra")) <span class="help-block">{{$errors->first("living_extra")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("living_postcode")) has-error @endif">
        {!! Form::label("living_postcode","Postcode") !!}
        {!! Form::text("living_postcode",$pledge->living_postcode,["class"=>"form-control"]) !!}
        @if($errors->has("living_postcode")) <span class="help-block">{{$errors->first("living_postcode")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("mobile")) has-error @endif">
        {!! Form::label("mobile","Telefoon mobiel") !!}
        {!! Form::text("mobile",$pledge->mobile,["class"=>"form-control"]) !!}
        @if($errors->has("mobile")) <span class="help-block">{{$errors->first("mobile")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("emergency_phone")) has-error @endif">
        {!! Form::label("emergency_phone","Telefoon nood") !!}
        {!! Form::text("emergency_phone",$pledge->emergency_phone,["class"=>"form-control"]) !!}
        @if($errors->has("emergency_phone")) <span class="help-block">{{$errors->first("emergency_phone")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("email")) has-error @endif">
        {!! Form::label("email","Email") !!}
        {!! Form::text("email",$pledge->email,["class"=>"form-control"]) !!}
        @if($errors->has("email")) <span class="help-block">{{$errors->first("email")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("education")) has-error @endif">
        {!! Form::label("education","Opleiding") !!}
        <select class="form-control" name="education">
            <option>Onbekend</option>
            @foreach($studies as $study)
                <option value="{{$study}}" @if($pledge->education == $study) selected @endif>{{$study}}</option>
            @endforeach
        </select>
        @if($errors->has("education")) <span class="help-block">{{$errors->first("education")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("education_type")) has-error @endif">
        {!! Form::label("education_type","Voltijd/Deeltijd") !!}
        <select class="form-control" name="education_type">
            <option>Onbekend</option>
            @foreach($education_types as $key=>$type)
                <option value="{{$key}}" @if($pledge->education_type == $key) selected @endif>{{$type}}</option>
            @endforeach
        </select>
        @if($errors->has("education_type")) <span class="help-block">{{$errors->first("education_type")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("shirt_size")) has-error @endif">
        {!! Form::label("shirt_size","Shirt maat") !!}
        <select class="form-control" name="shirt_size">
            <option>Onbekend</option>
            @foreach($shirt_sizes as $key=>$size)
                <option value="{{$key}}" @if($pledge->shirt_size == $key) selected @endif>{{$size}}</option>
            @endforeach
        </select>
        @if($errors->has("shirt_size")) <span class="help-block">{{$errors->first("shirt_size")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("diet")) has-error @endif">
        {!! Form::label("diet","Dieet / allergieën") !!}
        <textarea name="diet" class="form-control" rows="5">{{$pledge->diet}}</textarea>
        @if($errors->has("diet")) <span class="help-block">{{$errors->first("diet")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("rabo_bicycle")) has-error @endif">
        <input type="checkbox" name="rabo_bicycle" value="1" @if($pledge->rabo_bicycle) checked @endif>
        {!! Form::label("rabo_bicycle", "Ik wil een Rabofiets") !!}
        <p class="help-block">Gratis bij Raborekening. Deze staat maandag klaar. ZELF een slot meenemen.</p>
        @if($errors->has("rabo_bicycle")) <span class="help-block">{{$errors->first("rabo_bicycle")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("vegetarian")) has-error @endif">
        <input type="checkbox" name="vegetarian" value="1" @if($pledge->vegetarian) checked @endif>
        {!! Form::label("vegetarian", "Ik ben vegetariër") !!}
        @if($errors->has("vegetarian")) <span class="help-block">{{$errors->first("vegetarian")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("pay_forward")) has-error @endif">
        <input type="checkbox" name="pay_forward" value="1" @if($pledge->pay_forward) checked @endif>
        {!! Form::label("pay_forward", "Ik betaal vooruit") !!}
        <p class="help-block">Je inschrijving betalen voor 31 juli kost 75 euro, daarna 100 euro.</p>
        @if($errors->has("pay_forward")) <span class="help-block">{{$errors->first("pay_forward")}} </span> @endif
    </div>
    <div class="form-group @if($errors->has("description")) has-error @endif">
        {!! Form::label("description", "Heb je nog iets toe te voegen?") !!}
        <textarea name="description" class="form-control" rows="5">{{$pledge->description}}</textarea>
        @if($errors->has("description")) <span class="help-block">{{$errors->first("description")}} </span> @endif
    </div>
    @if(isset($statusChangeEnabled))
    <div class="form-group @if($errors->has("status")) has-error @endif">
        {!! Form::label("status", "Status") !!}
        <select name="status" class="form-control" id="status">
            @foreach($status as $key=>$stat)
                <option value="{{$key}}" @if($key == $pledge->status) selected @endif>{{$stat}}</option>
            @endforeach
        </select>
        @if($errors->has("description")) <span class="help-block">{{$errors->first("description")}} </span> @endif
    </div>

    @endif


    <div class="form-group @if($errors->has("conditions")) has-error @endif">
        <input type="checkbox" name="conditions" value="1">
        {!! Form::label("conditions", "Ik ga akkoord met voorwaarden") !!}
        @if($errors->has("conditions")) <span class="help-block">{{$errors->first("conditions")}} </span> @endif
        <p class="help-block">In het kort:
                <ul class="help-block">
                <li>Je hebt een eigen (reis)verzekering</li>
                <li>Meegenomen drank & drugs is verboden</li>
                <li>Je inschrijving betalen voor 31 juli kost 75 euro, daarna 100 euro</li>
                <li>Je doet afstand van je portretrecht</li>
                </ul>
        </p>
    </div>

    <button class="btn btn-success" style="margin-bottom:50px;">Inschrijven</button>




{!! Form::close() !!}