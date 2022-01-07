@component('mail::message')
    # Order Shipped
    Your order has been shipped!
    @foreach ( $cartProducts['cartProducts'] as $product)
    ![Alt text](./images/{{$product['id']}}{{$product['fileType']}})
    ![Alt text](/path/to/img.jpg)
    Title  {{$product['title']}}
    Description  {{$product['description']}}
    Price  {{$product['price']}}
    @endforeach
    Client name {{$cartProducts['clientName']}}
    Contact details {{$cartProducts['contactDetails']}}
@endcomponent
