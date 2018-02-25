@section('links')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,700" rel="stylesheet">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('header')
    <div class="header">
        <div class="brand">
            <a href="/" class="brand-name">{{ config('app.brand') }}</a>
        </div>

        <div class="nav">
            <ul class="nav-ul">
                <li><a href="/">{{ trans('common.nav.home') }}</a></li>
                <li>{{ trans('common.nav.houses') }}</li>
                <li>{{ trans('common.nav.families') }}</li>
                <div class="search">
                    <input type="text" id="search_query" name="search_query" placeholder="Suchen" value="{{ old('search_query') }}">
                    <i class="fa fa-search" id="search_trigger" aria-hidden="true"></i>
                </div>

                @if(Auth::check())
                <div class="account" id="account_dropdown">
                    <img src="/media/uploads/profile/{{ \App\System::getProfileImageByName(Auth::user()->username) }}" alt="Profile Image">
                </div>
                @else
                <a class="login" href="/login">{{ trans('auth.login') }}</a>
                @endif
            </ul>
        </div>

        @if(Auth::check())
        <div class="dropdown-account" id="dropdown-account-wrap">
            <div class="section head-s">
                <p class="username">{{ Auth::user()->username }}</p>
            </div>

            <div class="section">
                <a href="/{{ Auth::user()->username }}" class="item">
                    <i class="fa fa-user-o" aria-hidden="true"></i>
                    <p>Profil</p>
                </a>
            </div>

            <div class="section end-s">
                <a href="/{{ Auth::user()->username }}/settings" class="item">
                    <p>Einstellungen</p>
                </a>

                <a href="/logout" class="item">
                    <p>Abmelden</p>
                </a>
            </div>
        </div>
    </div>
    @endif
@stop

@section('footer')
    <script src="js/jquery.min.js"></script>
    <script src="js/app.js"></script>
@stop