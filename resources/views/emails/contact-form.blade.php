<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>

<body>
    <p>Pesan dari: {{ $name }} ({{ $nim }})
        <br> Email/Hp: {{ $email }}/{{ $hp }}
        <br>Isi Pesan:
    </p>
    <p><strong>"{{ $note }}"</strong></p>
    <p>Mohon tolong segera merespon pesan ini.</p>
</body>

</html>
