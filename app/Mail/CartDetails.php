<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\ CartController;
class CartDetails extends Mailable
{
    public $clientName;
    public $contactDetails;
    public $data;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $clientName, $contactDetails)
    {
        $this->data = $data;
        $this->clientName = $clientName;
        $this->contactDetails = $contactDetails;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.checkout',['cartProducts' => ['cartProducts' => $this->data, 'clientName' => $this->clientName, 'contactDetails' => $this->contactDetails]]);
    }
}
