@component('mail::message')
    # Order Shipped
    Your order has been shipped!
    @foreach ( $cartProducts['cartProducts'] as $product)
    ![Alt text](./images/{{$product['id']}}{{$product['fileType']}})
    ![image info](./images/1.jpg)
    ![alt text for screen readers](./images/1.jpg "Text to show on mouseover")
    Title  {{$product['title']}}
    Description  {{$product['description']}}
    Price  {{$product['price']}}
    @endforeach
    Client name {{$cartProducts['clientName']}}
    Contact details {{$cartProducts['contactDetails']}}
@endcomponent
