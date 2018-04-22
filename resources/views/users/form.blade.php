{!! Form::open() !!}
    <div class="form-group @if($errors->has("name")) has-error @endif">
        {!! Form::label("name","Naam") !!}
        {!! Form::text("name",$user->name,["class" => "form-control"]) !!}
        @if($errors->has("name"))<span class="help-block">{{$errors->first("name")}}</span> @endif
    </div>
    <div class="form-group @if($errors->has("username")) has-error @endif">
        {!! Form::label("username","Inlognaam") !!}
        {!! Form::text("username",$user->username,["class" => "form-control"]) !!}
        @if($errors->has("username"))<span class="help-block">{{$errors->first("username")}}</span> @endif
    </div>
    <div class="form-group @if($errors->has("role")) has-error @endif">
        {!! Form::label("role","Rol") !!}
        <select class="form-control" name="role">
            <option value="user">Beller</option>
            <option value="admin" @if($user->role == "admin") selected @endif)>Administrator</option>
        </select>
        @if($errors->has("role"))<span class="help-block">{{$errors->first("role")}}</span> @endif
    </div>
    <div class="form-group @if($errors->has("password")) has-error @endif">
        {!! Form::label("password","Wachtwoord") !!}
        <input type="password" name="password" class="form-control">
        @if($user->id)
            <p class="help-block">Allen invullen als wachtwoord gewijzigd moet worden!</p>
        @endif

        @if($errors->has("password"))<span class="help-block">{{$errors->first("password")}}</span> @endif
    </div>

    <button class="btn btn-default">Opslaan</button>
{!! Form::close() !!}