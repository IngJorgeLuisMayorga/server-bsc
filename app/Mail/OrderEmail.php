<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use App\Models\Payment;
use App\Models\Cupon;
use App\Models\Product;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $payment;
    public $products;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, User $user, Payment $payment, $products, string $status )
    {
        $this->order = $order;
        $this->user = $user;
        $this->payment = $payment;
        $this->products = $products;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('soporte@funsoliun.com')
        ->view('emails.order-email')
        ->with([
            'invoice' => $this->order, 
            'user' => $this->user,
            'payment' => $this->payment,
            'products' => $this->products,
            'status' => $this->status
        ]);
    }
}
