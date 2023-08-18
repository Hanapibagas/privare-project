<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KirimEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $nama_lenkap;

    public function __construct(string $status, string $nama_lenkap)
    {
        $this->status = $status;
        $this->nama_lenkap = $nama_lenkap;
    }

    public function build()
    {
        $status = $this->status;
        $nama = $this->nama_lenkap;
        return $this->subject('Coupon anda', $status)->markdown('components.admin.cupon.send-coupon', compact('status', 'nama'));
    }
}
