@extends('./index_layout')

@section('title')
    <title>{{__('orders')}}</title>
@endsection

@section('main')

    <main>
        @foreach  ($ordersProducts as $product)
            @if($product['id'] > 0)
                <div class="orders">
                    <p id="datetime">{{__('orderDate')}}: {{$product['date_time']}}</p>
                    <p>{{__('name')}}: {{$product['user_name']}}</p>
                    <p>{{__('contact details')}}: {{$product['contact_details']}}</p>
                    <p>{{__('comments')}}: {{$product['comments']}}</p>
                    <p>{{__('totalPrice')}}: {{$product['total']}} $</p>
                    <a href="{{route('order' , [ 'orderId' => $product['id'] ])}}">{{__('viewOrder')}}</a>
                </div>

            @endif
        @endforeach
    </main>
@endsection

