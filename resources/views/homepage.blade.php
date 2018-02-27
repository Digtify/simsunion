<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('global.global')
    <title>{{ config('app.name') }}</title>
    @yield('links')
    <link rel="stylesheet" href="css/homepage.css">
</head>

<body>
    @yield('header')

    <div class="wrapper">
        <div class="left-wrap">
            <div class="account">
                <div class="panel">
                    <img src="/media/uploads/profile/{{ \App\System\System::fixProfileImage($user_data['image']) }}" alt="Profile Image">
                </div>

                <div class="stats">
                    <p class="name">{{ $user_data['username'] }}</p>

                    <div class="stats-wrap">
                        <div class="item">
                            <a href="/{{ Auth::user()->username }}" class="statistic-name">Posts</a>
                            <div class="value">{{ count(\App\System\System::getPosts(Auth::user()->id, true)) }}</div>
                        </div>
                        <div class="item">
                            <a class="statistic-name">Follower</a>
                            <div class="value">N/A</div>
                        </div>
                        <div class="item">
                            <a class="statistic-name">Follows</a>
                            <div class="value">N/A</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="google-ad-m" style="background-image: url('/media/static/google-ad.png')"></div>
        </div>

        <div class="center-wrap">
            @foreach($posts as $post)
            <div class="post post-resizable" data-route="{{ $post->type }}/{{ $post->route }}">
                <div class="account">
                    <div class="profile-image">
                        <img src="/media/uploads/profile/{{ \App\System\System::getProfileImageByName(\App\System\System::getUserById($post->author)->username) }}" alt="Image">
                    </div>
                    <div class="user-info">
                        <a href="/{{ \App\System\System::getUserById($post->author)->username }}" class="username">{{ \App\System\System::getUserById($post->author)->username }}</a>
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
        </div>

        <div class="right-wrap">
            <div class="title">Freunde finden</div>

            <div class="suggested-users">
                @foreach($users_suggested as $user)
                @if($user->username != Auth::user()->username)
                <div class="user-profile">
                    <a href="/{{ $user->username }}"><img src="/media/uploads/profile/{{ \App\System\System::fixProfileImage($user->image) }}" alt="Profile Image"></a>
                    <div class="user-data">
                        <a href="/{{ $user->username }}" class="name">{{ $user->username }}</a>
                        <div class="follow-btn">Follow</div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    @yield('footer')
</body>
</html>
