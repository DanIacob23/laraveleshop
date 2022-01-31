<div>
    <img class="img-product" src="{{asset('storage/images/'.$id.$fileType)}}"
         alt="{{__('prodImg')}}">
</div>

<table>
    <div class="infos">
        <h3>{{__('title')}}: {{ $title }}</h3>
        <p>{{__('description')}}: {{ $description }}</p>
        <p id="price">{{__('price')}}: {{ $price }} $
    </div>
</table>
