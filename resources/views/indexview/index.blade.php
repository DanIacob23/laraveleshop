@extends('./index_layout')

@section('title')
    <title>{{__('index')}}</title>
@endsection

@section('main')
    <main>
        @foreach ($productForIndex as $product)
            <div class="product">
                <!-- For General info -->
                @component('components.productrender')
                    @slot('id')
                        {{$product['id']}}
                    @endslot
                    @slot('fileType')
                        {{$product['fileType']}}
                    @endslot
                    @slot('title')
                        {{$product['title']}}
                    @endslot
                    @slot('description')
                        {{$product['description']}}
                    @endslot
                    @slot('price')
                        {{$product['price']}}
                    @endslot
                @endcomponent
                <form method="post" action="{{route('index')}}">
                    @csrf
                    <div>
                        <input type="submit" name="addCart" value="{{__('add')}}">
                        <input type="hidden" id="id" name="id" value="{{$product['id']}}">
                    </div>
                </form>
            </div>
        @endforeach
    </main>
    <a href="{{route('cart')}}" id="cart">{{__('goCart')}}</a>
@endsection
