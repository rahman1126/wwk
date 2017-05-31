<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Receipt;
use App\Coupon;

class SendCode extends Mailable
{
    use Queueable, SerializesModels;

    public $coupon;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $coupons = Coupon::where('receipt_id', $this->receipt->id)->get();
        $coupon = $this->coupon;
        return $this->from('no-reply@letscolourindonesia.com')
            ->from('noreply.dulux@gmail.com', 'Lets Colour Indonesia')
            ->subject('Nomor Undian Warna Warni Kemenanganmu')
            ->view('emails.send-code')
            ->with('coupon', $coupon);
    }
}
