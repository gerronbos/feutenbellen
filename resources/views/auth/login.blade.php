<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
{{ Html::style("css/login.css")}}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="wrap">
                <p class="form-title">
                    Inloggen</p>
                {!! Form::open(["class"=>"login"]) !!}
                <div class="has-error" style="color:white;">
                    @foreach($errors->all() as $error)
                        <b>{{$error}}</b><br>
                    @endforeach
                </div>
                <input type="text" name="username" placeholder="Username" />
                <input type="password" name="password" placeholder="Password" />
                <input type="submit" value="Inloggen" class="btn btn-success btn-sm" />
                <div class="remember-forgot">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" />
                                    Blijf ingelogd.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}}
            </div>
        </div>
    </div>
</div>
