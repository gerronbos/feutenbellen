<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stichting introductie almere | feutenbellen</title>

    <link rel="shortcut icon" href="/gfx/intrologo.png" type="image/png">

    <!-- Bootstrap Core CSS -->
    {{ Html::style("css/bootstrap.css") }}
    <style>
        body {
            background: url('/gfx/intrologo_1.png') no-repeat;
            background-position: top 55px right;
            background-size: 200px;
            background-attachment: fixed;

        }
    </style>

    

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield("head")

</head>

<body>

    <!-- Navigation -->
    @include("templates.partials.nav")

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @yield("content")
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    {{Html::script("js/jquery.js")}}

    <!-- Bootstrap Core JavaScript -->
    {{Html::script("js/bootstrap.min.js")}}

    {{ Html::script("js/bootstrap-notify.js")}}
    <script>
        @if(Session::has("msg"))
            $.notify({
                // options
                message: '<strong>{{Session::get("msg")}}</strong>'
            },{
                // settings
                element: ".navbar",
                type: '{{Session::get("msg_type")}}',
                placement: {
                    fromt: "top",
                    align: "right"
                },
                offset: {
                    x:1,
                },
                position:"fixed",
                timer:1000
            });
        @endif

    </script>


    @yield("scripts")

</body>

</html>
