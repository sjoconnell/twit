<!DOCTYPE html>
<html>
    <head>
        <title>Twitter</title>

        <link rel="stylesheet" href="{{asset('css/welcome.css')}}">

    </head>
    <body>
        <div class="container">
            <div class="welcome-content">

                <form action="{{ url('twitter/login') }}" method="GET" class="login-button">
                    {!! csrf_field() !!}

                    <button type="submit" class="btn btn-default">Login</button>
                </form>

            </div>
        </div>
    </body>
</html>
