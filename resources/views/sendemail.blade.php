@component('mail::message')
# Invoice Number {{ $data['number'] }}

Pelanggan {{ $data['name'] }} Yth,

Terima kasih telah menggunakan layanan kami. Berikut adalah rincian pembayaran Anda pada bulan ini:
    Invoice Number      : {{ $data['number'] }}<br>
    Jumlah Tagihan      : {{ $data['amount'] }}<br>
    Tanggal Jatuh Tempo : {{ date('d M Y', strtotime($data['due_date']))}}<br>
Mohon untuk melakukan pembayaran sebelum tanggal jatuh tempo, agar layanan Anda tetap berjalan. Terima kasih.


Hormat Kami,<br>
HH Net.
@endcomponent
