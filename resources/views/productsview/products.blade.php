@extends('productsview.products_layout')

@section('main')
    <main>
        <?php foreach($allProductsInfo as $product): ?>

            <div class="product">
                <div>
                    <img class="img-product" src="{{asset('storage/images/'.$product['id'].$product['fileType'])}}"
                         alt="{{__('eng.prodImg')}}">
                </div>

                <table>
                    <div class="infos">
                        <h3>{{__('eng.title')}}: <?= $product['title'] ?></h3>
                        <p>{{__('eng.description')}}: <?= $product['description'] ?></p>
                        <p id="price">{{__('eng.price')}}: <?= $product['price'] ?> $
                    </div>
                </table>


                <div>
                    <a href="{{ url('product?editId=' . $product['id']) }}" >{{__('eng.edit')}}</a>
                </div>


                <form method="post" action= "{{url('products')}}">
                    @csrf
                    <div>
                        <input type="submit" name="deleteProduct" value="{{__('eng.delete')}}">
                        <input type="hidden" id="deleteId" name="deleteId" value="<?= $product['id'] ?>">
                    </div>
                </form>
            </div>
            <?php endforeach; ?>

            <div class="optionsAdmin">
                <a href="{{ route('product') }}" >{{__('eng.add')}}</a>
                <form method="POST">
                    @csrf
                    <input type="submit" name="adminLogout" value="{{__('eng.logout')}}">
                </form>
            </div>
    </main>
@endsection
