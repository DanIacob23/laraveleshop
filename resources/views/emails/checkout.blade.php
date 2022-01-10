@component('mail::message')
# Order Shipped
Your order has been shipped!

@foreach ( $cartProducts['cartProducts'] as $product)
<pre>
<img src="{{asset('storage/images/'.$product['id'].$product['fileType'])}}" alt="img" width="50" height="60">
Title  {{$product['title']}}
Description  {{$product['description']}}
Price  {{$product['price']}}

</pre>
@endforeach
Client name {{$cartProducts['clientName']}}
Contact details {{$cartProducts['contactDetails']}}
@endcomponent
