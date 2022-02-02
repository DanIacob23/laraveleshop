@extends('./index_layout')

@section('title')
    <title>{{__('order')}}</title>
@endsection

@section('main')

    <main>
        <div class="order">
            <ul>
                <li>{{__('name')}}: {{$orderProducts['userName']}}</li>
                <li>{{__('contact details')}}: {{$orderProducts['contactDetails']}}</li>
                <li>{{__('comments')}}: {{$orderProducts['comments']}}</li>
            </ul>
            <h3>Cart: </h3>
            <div class="cart">
                @foreach ($orderProducts['products'] as $product)
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
                                {{$product['pivot']['cart_price']}}
                            @endslot
                        @endcomponent
                </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
