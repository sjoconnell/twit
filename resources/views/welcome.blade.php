<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">

                <form action="{{ url('twitter/login') }}" method="GET">
                    {!! csrf_field() !!}

<!--                     <label for="task-name" class="col-sm-3 control-label">Task</label>
                    <input type="text" name="name" id="task-name" class="form-control"> -->

                    <button type="submit" class="btn btn-default">Login</button>
                </form>

                <form action="{{ url('twitter/logout') }}" method="GET">
                    {!! csrf_field() !!}

<!--                     <label for="task-name" class="col-sm-3 control-label">Task</label>
                    <input type="text" name="name" id="task-name" class="form-control"> -->

                    <button type="submit" class="btn btn-default">Logout</button>
                </form>

            </div>
        </div>
    </body>
</html>
