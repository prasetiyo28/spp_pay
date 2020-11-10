@component('mail::message')
# Halo Test1

Informasi Tagihan.

Tagihan pembayaran administrasi sekolah sudah diupdate.
Berikut kode pembayaran tagihan:

@component('mail::panel')
Kode Pembayaran: {{ $detail_tagihan->kode_tagihan }}
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
