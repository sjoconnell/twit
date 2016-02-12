<!DOCTYPE html>
<html>
    <head>
        <title>Twitter</title>

        <link rel="stylesheet" href="{{asset('css/home.css')}}">

    </head>
    <body>
        <div class="container">
            <div class="home-content">

                <h1>Test to see if Login Works!</h1>

                <form action="{{ url('twitter/logout') }}" method="GET" class="logout-button">
                    {!! csrf_field() !!}

                    <button type="submit" class="btn btn-default">Logout</button>
                </form>

            </div>
        </div>
    </body>
</html>
