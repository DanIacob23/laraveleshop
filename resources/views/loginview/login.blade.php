@extends('loginview.login_layout')

@section('main')
    <main>
        <form method="POST">
            @csrf
            <div class="login">
                <input type="text" id="fname" name="fname" placeholder="Username"><br><br>
                <input type="password" id="pass" name="pass" placeholder="Password"><br><br>
            </div>
            <input type="submit" id="submit" name="submit" value="Submit">
        </form>
    </main>

@endsection
