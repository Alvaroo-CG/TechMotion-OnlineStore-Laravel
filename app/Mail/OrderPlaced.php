<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
 
class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;
 
    public $order;
 
    /**
     * Crear una nueva instancia de mensaje.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
 
    /**
     * Construir el mensaje.
     *
     * @return \Illuminate\Contracts\Mail\Mailable
     */
    public function build()
    {
        return $this->subject('Your Order Confirmation')
                    ->view('emails.order_placed');
    }
}