@extends('layouts.app')

@section('content')

<header>
    <div class="welcome-header">
        <h1 class="animated flip">TWIT</h1>
    </div>
</header>
            
<div class="home-body clearfix">
    <div class="wrapper">
        <div class="left-box">
            <div class="profile-box">
                <img src="{{$twit_image}}" class="twitter-image">

                <h1>{{$twit_name}}</h1>

                <p>@ {{$twit_screen_name}}</p>

                <form action="{{ url('twitter/logout') }}" method="GET" class="logout-button">
                    {!! csrf_field() !!}

                    <button type="submit" class="btn btn-default">Logout</button>
                </form>

            </div>

            <div class="tweet-box">
                <form action="{{ url('/tweet') }}" method="POST" class="tweet-button">
                    {!! csrf_field() !!}
                    <textarea type="text" name="tweet_text" maxlength="140" required="required" ></textarea>

                    <button type="submit" class="btn btn-default">Tweet</button>
                </form>
            </div>
        </div>

        <div class="right-box">
            <div class="header-box clearfix">
                <h1 class="tweets-left grey-color">My Tweets</h1>
                <h1 class="timeline-right">Timeline</h1>
            </div>
            <div class="your-tweet-box invisible">
                <ul>
                    @foreach ($linkified_tweets as $tweet)
                    <li><?= $tweet ?></li>
                    @endforeach
                </ul>
            </div>

            <div class="your-timeline-box">
                <ul>
                    @for ($i = 0; $i < $ti; $i++)
                    <li class="clearfix">
                        <div class="tweet-image">
                            <img src="<?= $timeline_data[$i]['profile_image_url'] ?>">
                        </div>
                        <div class="tweet-content">
                            <p><?= $timeline_data[$i]['name'] ?></p>
                            <p>@<?= $timeline_data[$i]['screen_name'] ?></p>
                            <br>
                            <?= $timeline_tweets[$i] ?>
                        </div>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
</div>         


@endsection