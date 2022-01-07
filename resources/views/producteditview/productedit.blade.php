@extends('producteditview.productedit_layout')

@section('main')

    <main>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="infos">
                <input type="text" id="title" name="title" placeholder="title"
                       value="{{old('title',$productForEdit[0]['title'])}}">
                <input type="text" id="description" placeholder="description" name="description"
                       value="{{old('description',$productForEdit[0]['description'])}}">
                <input type="text" id="price" name="price" placeholder="price"
                       value="{{old('price',$productForEdit[0]['price'])}}">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="upload">
                <label for="fileToUpload">{{__('eng.selectImg')}}</label>
                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/png, image/jpeg">
            </div>
            <div class="save">
                <a href="{{ route('products') }}">{{__('eng.products')}}</a>
                <input type="submit" name="save" value="{{__('eng.save')}}">
            </div>
        </form>
    </main>
@endsection
