@extends('orderview.order_layout')

@section('main')

    <main>
        <div class="order">
            <ul>
                <li>{{__('eng.name')}}: {{$orderProducts['userName']}}</li>
                <li>{{__('eng.contact details')}}: {{$orderProducts['contactDetails']}}</li>
                <li>{{__('eng.comments')}}: {{$orderProducts['comments']}}</li>
            </ul>
            <h3>Cart: </h3>
            <div class="cart">
                @foreach ($orderProducts['products'] as $item)
                <div class="product">
                    <div>
                        <img class="img-product"
                             src="{{asset('storage/images/'.$item['id'].$item['fileType'])}}"
                             alt="{{__('eng.prodImg')}}">
                    </div>
                    <div class="infos">
                        <h3>{{__('eng.title')}}:  {{$item['title']}}</h3>
                        <p>{{__('eng.description')}}: {{$item['description']}}</p>
                        <p id="price">{{__('eng.price')}}:  {{$item['price']}} $</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
