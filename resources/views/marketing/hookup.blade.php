<html>
<head>
    @include('global.global')
    <title>{{ config('app.brand') }}. The Sims Community</title>
    @yield('links')
    <link href="https://fonts.googleapis.com/css?family=Asap:500" rel="stylesheet">
    <link rel="stylesheet" href="/css/homepage.css">
</head>

<body>
    <div class="fullscreen">
        <div class="left-screen">
            <ul class="ul-hookup">
                <li><i class="fa fa-address-book-o" aria-hidden="true"></i> Finde gleichdenkende</li>
                <li><i class="fa fa-comment-o" aria-hidden="true"></i> Direktes Feedback</li>
                <li><i class="fa fa-rocket" aria-hidden="true"></i> Entdecke neue Ideen für deine Sims</li>
            </ul>
        </div>

        <div class="right-screen">
            <div class="top-line-login">
                <form action="/login" method="post" class="form-login-vs">
                    @csrf
                    <input type="text" id="mail" name="mail" placeholder="{{ trans('auth.input.mail') }}">
                    <input type="password" id="password" name="password" placeholder="{{ trans('auth.input.password') }}">
                    <input type="submit" class="submit" value="{{ trans('auth.login') }}">
                </form>
            </div>

            <div class="center">
                <p class="else">oder</p>
                <div class="register-note">Jetzt <small>{{ config('app.brand') }}</small> beitreten</div>
                <form action="/register" method="post" class="form-register-l">
                    @csrf

                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="error">
                                <p class="error-code">{{ $error }}</p>
                            </div>
                        @endforeach
                    @endif

                    <label for="mail" class="support">{{ trans('auth.input.mail') }}</label>
                    <input type="text" class="input{{ $errors->has('mail') ? ' input-error' : '' }}" id="mail" name="mail" value="" placeholder="{{ trans('auth.input.mail') }}" value="{{ old('mail') }}">

                    <label for="username" class="support">{{ trans('auth.input.name') }}</label>
                    <input type="text" class="input" id="username" name="username" value="" placeholder="{{ trans('auth.input.name') }}">

                    <label for="password" class="support">{{ trans('auth.input.password') }}</label>
                    <input type="password" class="input" id="password" name="password" value="" placeholder="{{ trans('auth.input.password') }}">

                    <label for="password_repeat" class="support">{{ trans('auth.input.password-repeat') }}</label>
                    <input type="password" class="input" id="password_repeat" name="password_repeat" value="" placeholder="{{ trans('auth.input.password-repeat') }}">

                    <input type="submit" class="submit" id="submit-auth" value="{{ trans('auth.register') }}">
                </form>
            </div>
        </div>
    </div>
</body>
</html>