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
                <br>

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
                <h1 class="tweets-left">My Tweets</h1>
                <h1 class="timeline-right grey-color">Timeline</h1>
            </div>
            <div class="your-tweet-box">
                <ul>
                    @foreach ($linkified_tweets as $tweet)
                    <li><?= $tweet ?></li>
                     @endforeach
                </ul>
            </div>

            <div class="your-timeline-box invisible">
                <ul>
                    @foreach ($timeline_tweets as $time)
                    <li><?= $time ?></li>
                     @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>         


@endsection