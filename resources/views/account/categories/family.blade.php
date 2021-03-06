<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('global.global')
    <title>{{ config('app.name') }}</title>
    @yield('links')
    <link rel="stylesheet" href="/css/auth.css">
    <link rel="stylesheet" href="/css/account.css">
</head>

<body>
@yield('header')

<div class="profile-banner" style="background-image: url('media/uploads/profiles/programmieren_lernen-640x200.jpg')">
    <div class="profile-image">
        <img src="/media/uploads/profiles/code_logo.png" alt="Image">
    </div>
</div>
<div class="stats-bar">
    <div class="username">{{ $username }}</div>
    @if(Auth::check() && $username == Auth::user()->username)
        <a href="/{{ Auth::user()->username }}/settings" class="change-profile">{{ trans('account.edit-profile') }}</a>
    @endif
</div>

<div class="wrapper">
    <div class="navbar-left">
        <p class="name">{{ $username }}</p>
        <p class="joined"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $data['created_at'] }}</p>
        @if(\App\System\System::hasStatsSet($username, 'birthday'))
            <p class="birthday"><i class="fa fa-birthday-cake" aria-hidden="true"></i> {{ \App\System\System::getUserStats($username, 'birthday')->birthday }}</p>
        @endif
        @if(\App\System\System::hasStatsSet($username, 'website_anchor'))
            <p class="website"><i class="fa fa-link" aria-hidden="true"></i> <a href="{{ \App\System\System::getUserStats($username, 'website_anchor')->website_anchor }}" target="_blank">{{ \App\System\System::getUserStats($username, 'website_anchor')->website_anchor }}</a></p>
        @endif

        <ul class="tab-nav">
            <li class="active"><a href="/{{ $username }}/families">{{ trans('common.nav.families') }}</a></li>
            <li><a href="/{{ $username }}/buildings">{{ trans('common.nav.houses') }}</a></li>
        </ul>
    </div>

    <div class="activities">
        <div class="head">
            <p class="section-heading">{{ trans('account.tabs.families') }}</p>
        </div>

        <div class="content">
            @foreach($families as $post)
                <div class="post">
                    <div class="account">
                        <div class="profile-image">
                            <img src="media/uploads/profiles/code_logo.png" alt="Image">
                        </div>
                        <div class="user-info">
                            <div class="username">{{ \App\System\System::getUserById($post->author)->username }}</div>
                            <div class="date">{{ \App\System\System::toDateFormatWithFormatted($post->created_at, true) }}</div>
                        </div>

                        <div class="comment-wrap">
                            <div class="comment">{{ substr(trim($post->comment), 0, 70) }}</div>
                        </div>
                    </div>
                    <div class="img-holder">
                        <img src="media/uploads/12d345f245d/14.02.18_17-23-46.png" alt="">
                    </div>
                </div>
            @endforeach

            @if(!count($families))
                <div class="no-posts">
                    <div class="center">
                        <i class="fa fa-battery-quarter" aria-hidden="true"></i>
                        <p class="no-posts-message">Ganz schön leer hier ...</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@yield('footer')
<script src="js/auth.js"></script>
</body>
</html>