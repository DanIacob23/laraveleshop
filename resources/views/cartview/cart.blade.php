@extends('cartview.cart_layout')

@section('main')
    <main>
        <?php foreach($productForCart as $product): ?>
        <form method="post" action= "{{url('cart')}}">
            @csrf
            <div class="product">
                <div>
                    <img class="img-product" src="./images/<?= $product['id'] ?><?= $product['fileType'] ?>"
                         alt="Product Image">
                </div>
                <div class="infos">
                    <h3>Title <?= $product['title'] ?></h3>
                    <p>Description <?= $product['description'] ?></p>
                    <p id="price">Price <?= $product['price'] ?> $</p>
                </div>
                <div>
                    <input type="submit" name="removeToCart" value="Remove">
                    <input type="hidden" id="id" name="id" value="<?= $product['id'] ?>">
                </div>
            </div>
        </form>
        <?php endforeach;?>
        <form method="POST" action= "{{url('cart')}}">
            @csrf
            <div class="checkout-details">
                <input type="text" id="name" name="name" placeholder="Name"
                       value="<?= $name ?>">
                <input type="text" id="contactDetails" name="contactDetails" size="50"
                       placeholder="Contact details"
                       value="<?= $contactDetails ?>">
                <input type="text" id="comments" name="comments" size="50" placeholder="Comments"
                       value="<?= $comments ?>">
            </div>
            <div class="checkout">
                <a href="index" id="index">Go to index</a>
                <input type="submit" name="checkout" value="Checkout">
            </div>
        </form>
    </main>
@endsection
