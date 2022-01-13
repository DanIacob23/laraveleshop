@extends('ordersview.orders_layout')

@section('main')

    <main>
        @foreach  ($ordersProducts as $product)
            @if($product['id'] > 0)
                <div class="orders">
                    <p id="datetime">{{__('eng.orderDate')}}: {{$product['datetime']}}</p>
                    <p>{{__('eng.name')}}: {{$product['userName']}}</p>
                    <p>{{__('eng.contact details')}}: {{$product['contactDetails']}}</p>
                    <p>{{__('eng.comments')}}: {{$product['comments']}}</p>
                    <p>{{__('eng.totalPrice')}}: {{$product['total']}} $</p>
                    <a href="{{ url('order?lastOrderId=' . $product['id']) }}">{{__('eng.viewOrder')}}</a>
                </div>

            @endif
        @endforeach
    </main>
@endsection

