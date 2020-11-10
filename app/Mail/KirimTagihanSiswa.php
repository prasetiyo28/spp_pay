<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KirimTagihanSiswa extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail_tagihan,$siswa)
    {
        $this->data['detail_tagihan'] = $detail_tagihan;
        $this->data['siswa'] = $siswa;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown( 'emails.sendTagihanSiswa' )
            ->subject( '[' . config('app.name') . '] Tagihan Administrasi' )
            ->with( $this->data );
    }
}
