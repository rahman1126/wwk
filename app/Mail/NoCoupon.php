<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Receipt;
use App\Coupon;

class FormSubmited extends Mailable
{
    use Queueable, SerializesModels;

    public $receipt;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Receipt $receipt)
    {
        $this->receipt = $receipt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $coupons = Coupon::where('receipt_id', $this->receipt->id)->get();
        return $this->from('no-reply@letscolourindonesia.com')
            ->from('noreply.dulux@gmail.com', 'Lets Colour Indonesia')
            ->subject('Nomor Undian Warna Warni Kemenanganmu')
            ->view('emails.form-submited-nocoupon')
            ->with('coupons', $coupons);
    }
}
