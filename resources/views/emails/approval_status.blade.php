<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Peminjaman</title>
</head>

<body>
    <p>Halo, {{ $borrowerName }}<br>
        Status peminjaman Anda untuk ruang <strong>{{ $roomType }} - {{ $roomName }}</strong> telah
        diperbarui:<br>
        <strong>
            <blockquote>{{ $statusMessage }}</blockquote>
        </strong>
        <i>Catatan : {{ $notes }}</i><br>
        Terima kasih telah menggunakan layanan kami.<br>Jika ada pertanyaan, jangan ragu untuk menghubungi kami <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a>.
    </p>
    <p>Salam hangat, {{ $adminName }} - <a href="{{ config('app.url') }}">{{ config('app.name') }}</a></p>
</body>

</html>
