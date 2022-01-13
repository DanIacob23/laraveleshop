@extends('loginview.login_layout')

@section('main')
    <main>
        <form method="POST">
            @csrf
            <div class="login">
                <input type="text" id="uname" name="userName" placeholder="{{__('eng.username')}}" value="{{old('userName')}}"><br><br>
                <input type="password" id="pass" name="password" placeholder="{{__('eng.password')}}"><br><br>
                <p>{{$loginerr}}</p>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="submit" id="submit" name="submit" value="{{__('eng.submit')}}">
        </form>
    </main>

@endsection
