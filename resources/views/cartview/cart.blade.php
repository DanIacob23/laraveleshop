@extends('cartview.cart_layout')

@section('main')
    <main>
        <?php foreach($productForCart as $product): ?>
        <form method="post" action="{{url('cart')}}">
            @csrf
            <div class="product">
                <div>
                    <img class="img-product" src="./images/<?= $product['id'] ?><?= $product['fileType'] ?>"
                         alt="{{__('eng.prodImg')}}">
                </div>
                <div class="infos">
                    <h3>{{__('eng.title')}} <?= $product['title'] ?></h3>
                    <p>{{__('eng.description')}} <?= $product['description'] ?></p>
                    <p id="price">{{__('eng.price')}} <?= $product['price'] ?> $</p>
                </div>
                <div>
                    <input type="submit" name="removeToCart" value="{{__('eng.remove')}}">
                    <input type="hidden" id="id" name="id" value="<?= $product['id'] ?>">
                </div>
            </div>
        </form>
        <?php endforeach;?>
        <form method="POST">
            @csrf
            <div class="checkout-details">
                <input type="text" id="name" name="name" placeholder="{{__('eng.name')}}"
                       value="{{old(strval('name'))}}">
                <input type="text" id="contactDetails" name="contactDetails" size="50"
                       placeholder="{{__('eng.contact details')}}"
                       value="{{old(strval('contactDetails'))}}">
                <input type="text" id="comments" name="comments" size="50" placeholder="{{__('eng.comments')}}"
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
                <a href="{{ route('index') }}" id="index">{{__('eng.goIndex')}}</a>
                <input type="submit" name="checkout" value="{{__('eng.checkout')}}">
            </div>
        </form>
    </main>
@endsection
