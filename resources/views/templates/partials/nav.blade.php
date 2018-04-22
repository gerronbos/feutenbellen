<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route("dashboard")}}">Dashboard</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{route("calls")}}">Bellen</a>
                </li>
                @if(Auth::user()->role == "admin")
                    <li>
                        <a href="{{route("pledges")}}">Feuten</a>
                    </li>
                @endif
                @if(Auth::user()->role == "admin")
                    <li>
                        <a href="{{route("mailinglist")}}">Mailinglijsten</a>
                    </li>
                @endif
                <li>
                    <a href="{{route("stats")}}">Statistieken</a>
                </li>
                @if(Auth::user()->role == "admin")
                    <li>
                        <a href="{{route("users")}}">Gebruikers</a>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{route("logout")}}">Logout</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>