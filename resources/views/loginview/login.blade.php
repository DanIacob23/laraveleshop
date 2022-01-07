@extends('loginview.login_layout')

@section('main')
    <main>
        <form method="POST">
            @csrf
            <div class="login">
                <input type="text" id="uname" name="uname" placeholder="{{__('eng.username')}}"><br><br>
                <input type="password" id="pass" name="pass" placeholder="{{__('eng.password')}}"><br><br>
            </div>
            <input type="submit" id="submit" name="submit" value="{{__('eng.submit')}}">
        </form>
    </main>

@endsection
