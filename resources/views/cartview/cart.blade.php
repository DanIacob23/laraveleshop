@extends('./index_layout')

@section('title')
    <title>{{__('cart')}}</title>
@endsection

@section('main')
    <main>
        @foreach ($productForCart as $product)
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
                <form method="post" action="{{route('cart.delete', [ 'id' => $product['id'] ])}}">
                    @csrf
                    <div>
                        <input type="submit" name="removeToCart" value="{{__('remove')}}">
                        <input type="hidden" id="method" name="_method" value="delete">
                    </div>
                </form>
            </div>
        </form>
        @endforeach
        <form method="POST">
            @csrf
            <div class="checkout-details">
                <input type="text" id="name" name="name" placeholder="{{__('name')}}"
                       value="{{old(strval('name'))}}">
                <input type="text" id="contactDetails" name="contactDetails" size="50"
                       placeholder="{{__('contact details')}}"
                       value="{{old(strval('contactDetails'))}}">
                <input type="text" id="comments" name="comments" size="50" placeholder="{{__('comments')}}"
                       value="{{old(strval('comments'))}}">
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
            <div class="checkout">
                <a href="{{route('index')}}" id="index">{{__('goIndex')}}</a>
                <input type="submit" name="checkout" value="{{__('checkout')}}">
            </div>
        </form>
    </main>
@endsection
