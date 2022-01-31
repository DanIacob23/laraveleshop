@extends('./index_layout')

@section('title')
    <title>{{__('products')}}</title>
@endsection
@section('main')
    <main>
            @foreach ($allProductsInfo as $product)
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

                <br/>


                <div>
                    <a href="{{route('product', [ 'id' => $product['id'] ])}}" >{{__('edit')}}</a>
                </div>


                <form method="post" action="{{route('products.delete', [ 'id' => $product['id'] ])}}">
                    @csrf
                    <div>
                        <input type="submit" name="deleteProduct" value="{{__('delete')}}">
                        <input type="hidden" id="method" name="_method" value="delete">
                    </div>
                </form>
            </div>
            @endforeach
            <div class="optionsAdmin">
                <a href="{{route('product', [ 'id' => 'add' ])}}" >{{__('add')}}</a>
                <form method="POST">
                    @csrf
                    <input type="submit" name="adminLogout" value="{{__('logout')}}">
                </form>
            </div>
    </main>
@endsection
