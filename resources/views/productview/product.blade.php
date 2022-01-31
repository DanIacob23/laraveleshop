@extends('./index_layout')

@section('title')
    <title>{{__('product')}}</title>
@endsection

@section('main')

    <main>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="infos">
                <input type="text" id="title" name="title" placeholder="{{__('title')}}"
                       value="{{old('title',$productForEdit['title'])}}">
                <input type="text" id="description" placeholder="{{__('description')}}" name="description"
                       value="{{old('description',$productForEdit['description'])}}">
                <input type="text" id="price" name="price" placeholder="{{__('price')}}"
                       value="{{old('price',$productForEdit['price'])}}">
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
                <label for="fileToUpload">{{__('selectImg')}}</label>
                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/png, image/jpeg">
            </div>
            <div class="save">
                <a href="{{route('products')}}">{{__('products')}}</a>
                <input type="submit" name="save" value="{{__('save')}}">
            </div>
        </form>
    </main>
@endsection
