@extends('layouts.app')

@section('content')

<header>
    <div class="welcome-header">
        <h1 class="animated flip">TWIT</h1>
    </div>
</header>

<div class="welcome-body">
    <form action="{{ url('twitter/login') }}" method="GET" class="login-button">
        {!! csrf_field() !!}
        <button type="submit" class="btn btn-default">Login</button>
    </form>
</div>

@endsection
