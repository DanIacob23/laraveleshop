@extends('indexview.index_layout')

@section('main')
    <main>
        <?php foreach($productForIndex as $product): ?>
            <form method="post" action= "{{url('index')}}">
                @csrf
                <div class="product">
                    <div>
                        <img class="img-product" src="./images/<?= $product['id'] ?><?= $product['fileType'] ?>"
                             alt="Product Image">
                    </div>
                    <div class="infos">
                        <h3>Title  <?= $product['title'] ?></h3>
                        <p>Description <?= $product['description'] ?></p>
                        <p id="price">Price <?= $product['price'] ?> $</p>
                    </div>
                    <div>
                        <input type="submit" name="addCart" value="Add">
                        <input type="hidden" id="id" name="id" value="<?= $product['id'] ?>">
                    </div>
                </div>
            </form>
        <?php endforeach;?>
    </main>
    <a href="cart" id="cart">Go to cart</a>
@endsection
