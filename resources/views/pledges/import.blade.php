@extends("templates.master")


@section("content")

    {!! Form::open(["files"=> 1]) !!}
        <div class="form-group">
            {!! Form::label("fields","Velden") !!} <button type="button" class="btn btn-default" id="new_field">Veld toevoegen</button>
            <div class="row" id="fields">
                <div class="col-md-1" style="text-align:center">
                    <select class="form-control" name="fields[]"> @foreach($fields as $key=>$field) <option value="{{$key}}">{{$field}}</option>  @endforeach </select>
                    <button type="button" class="btn btn-danger btn-xs delete_field">Verwijder</button>
                </div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label("own_value","Eigen waardes invullen") !!} <button type="button" class="btn btn-default" id="new_own_field">Veld toevoegen</button>
            <p class="help-block">Geld voor elke feut die geimporteerd word.</p>   
            <div id="own_fields">
                
            </div>
        </div>

        <div class="form-group">
            {!! Form::label("file","CSV") !!}
            <p class="help-block">Zorg ervoor dat het een csv bestand is.</p>
            <input type="file" name="file">
        </div>
        <button class="btn btn-primary">Importeer</button>
    {!! Form::close() !!}

@stop


@section("scripts")
    <script>
        var fields = JSON.parse('{!! json_encode($fields) !!}');

        $("#new_field").click(function(){
            var btn = document.createElement("button");
            btn.type = "button";
            btn.className = "btn btn-danger btn-xs delete_field";
            btn.innerText = "Verwijder";


            var field = document.createElement("div");
            field.className = "col-md-1";
            field.style = "text-align:center";

            var select = document.createElement("select");
            select.className = "form-control";
            select.name = "fields[]";

            $.each(fields, function(key,value){
                var option = document.createElement("option");
                option.value = key;
                option.innerText = value;

                select.appendChild(option);
            });
            field.appendChild(select);
            field.appendChild(btn);

            var head_fields = document.getElementById("fields");

            head_fields.appendChild(field);

            $(".delete_field").click(function(){
                $(this).parent().remove();
            });
        });
        $(".delete_field").click(function(){
            $(this).parent().remove();
        });

        $("#new_own_field").click(function(){
            var row = document.createElement("div");
            row.className = "row";
            row.style = "margin-bottom:10px;";

            var col2 = document.createElement("div")
            col2.className = "col-md-2";
            
            var select = document.createElement("select");
            select.className = "form-control";
            select.name = "own_fields[]";

            $.each(fields, function(key,value){
                var option = document.createElement("option");
                option.value = key;
                option.innerText = value;

                select.appendChild(option);
            });

            col2.appendChild(select);
            row.appendChild(col2);


            var col10 = document.createElement("div");
            col10.className = "col-md-10 input-group";

            var input = document.createElement("input");
            input.name = "own_fields_input[]";
            input.className = "form-control";
            
            col10.appendChild(input);

            var span = document.createElement("span");
            span.className = "input-group-btn";

            var button = document.createElement("button");
            button.className = "btn btn-danger btn_own_field";
            button.innerText = "Verwijder";
            button.type = "button";

            span.appendChild(button);

            col10.appendChild(span);
            row.appendChild(col10);

            var head_fields = document.getElementById("own_fields");
            head_fields.appendChild(row);

            $(".btn_own_field").click(function(){
                $(this).parent().parent().parent().remove();
            });
        });
    </script>
@stop