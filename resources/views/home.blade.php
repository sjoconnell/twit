<!DOCTYPE html>
<html>
    <head>
        <title>Twitter</title>

        <link rel="stylesheet" href="{{asset('css/home.css')}}">

    </head>
    <body>
        <div class="container">
            <div class="home-content">
            
                <form action="{{ url('twitter/logout') }}" method="GET" class="logout-button">
                    {!! csrf_field() !!}

                    <button type="submit" class="btn btn-default">Logout</button>
                </form>
                <br>

                <form action="{{ url('/tweet') }}" method="GET" class="tweet-button">
                    {!! csrf_field() !!}
                    <input type="text" name="tweet_text">

                    <button type="submit" class="btn btn-default">Tweet</button>
                </form>

                <br>
                <ul>
                    @foreach ($my_tweets as $tweet)
                    <li>{{ $tweet['text'] }}</li>
                    @endforeach
                </ul>

            </div>
        </div>
    </body>
</html>
