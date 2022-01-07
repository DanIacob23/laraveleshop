@extends('indexview.index_layout')

@section('main')
    <main>
        <?php foreach($productForIndex as $product): ?>
        <form method="post" action="{{url('index')}}">
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
                    <input type="submit" name="addCart" value="{{__('eng.add')}}">
                    <input type="hidden" id="id" name="id" value="<?= $product['id'] ?>">
                </div>
            </div>
        </form>
        <?php endforeach;?>
    </main>
    <a href="cart" id="cart">{{__('eng.goCart')}}</a>
@endsection
