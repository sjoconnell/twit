@extends('layouts.app')

@section('content')

<header>
    <div class="welcome-header">
        <h1>TWIT</h1>
    </div>
</header>
            
<div class="welcome-body">

        <form action="{{ url('twitter/logout') }}" method="GET" class="logout-button">
            {!! csrf_field() !!}

            <button type="submit" class="btn btn-default">Logout</button>
        </form>
        <br>

        <form action="{{ url('/tweet') }}" method="POST" class="tweet-button">
            {!! csrf_field() !!}
            <textarea type="text" name="tweet_text" maxlength="140" ></textarea>

            <button type="submit" class="btn btn-default">Tweet</button>
        </form>

        <br>
        <ul>
            @foreach ($my_tweets as $tweet)
            <li>{{ $tweet['text'] }}</li>
             @endforeach
         </ul>
</div>         


@endsection