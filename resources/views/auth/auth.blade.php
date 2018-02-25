<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('global.global')
    <title>{{ config('app.name') }}</title>
    @yield('links')
    <link rel="stylesheet" href="css/auth.css">
</head>

<body>
    @yield('header')
    <div class="sub-header">
        <div class="mode" id="auth-mode" data-mode="{{ $mode }}">{{ trans('auth.' . $mode) }}</div>
    </div>

    
    <div class="form-wrapper">
        <form action="" method="post" class="form">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="error">
                        <p class="error-code">{{ $error }}</p>
                    </div>
                @endforeach
            @endif

            @csrf
            @if($status == '403')
                <div class="error">
                    <p class="error-code">{{ trans('auth.errors.logged-in') }}</p>
                </div>
            @endif
            @if($status == '505')
                <div class="error">
                    <p class="error-code">{{ trans('auth.errors.failed') }}</p>
                </div>
            @endif
            <label for="mail" class="support">{{ trans('auth.input.mail') }}</label>
            <input type="text" class="input{{ $errors->has('mail') ? ' input-error' : '' }}" id="mail" name="mail" value="" placeholder="{{ trans('auth.input.mail') }}" value="{{ old('mail') }}">
            <small>{{ $errors->first('mail') }}</small>
            @if($mode == 'register')
            <label for="username" class="support">{{ trans('auth.input.name') }}</label>
            <input type="text" class="input" id="username" name="username" value="" placeholder="{{ trans('auth.input.name') }}">
            @endif
            <label for="password" class="support">{{ trans('auth.input.password') }}</label>
            <input type="password" class="input" id="password" name="password" value="" placeholder="{{ trans('auth.input.password') }}">
            @if($mode == 'register')
            <label for="password_repeat" class="support">{{ trans('auth.input.password-repeat') }}</label>
            <input type="password" class="input" id="password_repeat" name="password_repeat" value="" placeholder="{{ trans('auth.input.password-repeat') }}">
            @endif
            <input type="submit" class="submit" id="submit-auth" value="{{ trans('auth.' . $mode) }}">
        </form>
    </div>

    @if($mode == 'login')
    <div class="note">{{ trans('auth.note-login') }} <a href="/register">{{ trans('auth.note-login-a') }}</a></div>
    @else
    <div class="note">{{ trans('auth.note-register') }} <a href="/login">{{ trans('auth.note-register-a') }}</a></div>
    @endif

    <script src="js/jquery.min.js"></script>
    <script src="js/auth.js"></script>
</body>
</html>