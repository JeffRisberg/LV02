<nav class="navbar navbar-default navbar-static-top">
    <div class="container"><!--  div class="container navbar-fixed-top"  -->
        <div><!--  header lead section  -->
        <div style="float: right;">
                        @if (Auth::guest())
                    &nbsp;
                        @else
                    <span style="color: white;">Yo
                                    {{ Auth::user()->name }}!&nbsp;</span>
                    <!--  2016-12 Rick, @Josh, why can't ->getImageAttribute be called here?  -->
                    <a href="{{ url('/profile') }}"><img
                    src=/storage/userimages/{{ Auth::user()->handle }}_avatar.jpg style="width: 4em;"></a>
                        @endif
        </div>

            <!-- Branding Image, 2016-12 Rick, new location  -->
            <a class="navbar-brand" style="line-height: 90%; color: white;" href="{{ url('/') }}">
                <span style="font-size: larger;">WHOLOSOPHY</span><sup style="font-size: small;">&copy;</sup>
                <br><span style="font-size: smaller;">The way you Live</span>
                <!--  {{ config('app.name', 'Wholosophy') }}  -->
            </a>
        <!--  div style="clear: both;"></div  -->
        </div><!--  header lead section [end]  -->

        <div class="navbar-header" style="clear: both;"><!--  216-12 Rick, make this a 'second row'  -->

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <!--  a class="navbar-brand" href="{{ url('/') }}">
                <span style="color: white;"><span style="font-size: larger;">WHOLOSOPHY<span>
                <br><span style="font-size: small;">The way you Live<sup>TM</sup></span></span>
            </a  -->
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/home') }}">Home</a></li>
                            <!--  goal: dashboard menu is inactive unless one is logged in
                                  2016-10 Rick, anyone have a better idea?  -->
                            <li><span style="margin: 1em 2em; display: block;">Dash</span></li>
                            <li><a href="{{ url('/pivot') }}">Pivots</a></li>
                            <li><a href="{{ url('/home') }}">Practitioners</a></li>
                            <li><a href="{{ url('/search') }}">Search</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Account <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/login') }}">Login</a></li>
                                    <li><a href="{{ url('/register') }}">Register</a></li>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ url('/home') }}">Home</a></li>
                            <li><a href="{{ url('/dash') }}">Dash</a></li>
                            <li><a href="{{ url('/pivot') }}">Pivots</a></li>
                            <li><a href="{{ url('/home') }}">Practitioners</a></li>
                            <li><a href="{{ url('/search') }}">Search</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/profile') }}">Profile</a></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                    &nbsp;
            </ul>
        </div>
    </div>
</nav>

@if (session()->has('error'))
    <div class="alert alert-info">
        <ul>
            <li>{!! session('error') !!}</li>
        </ul>
    </div>
@endif
