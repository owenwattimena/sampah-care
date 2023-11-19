<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - {{ env('APP_NAME') }}</title>
    <style>
        #table table {
            padding: 15px;
            border-collapse: collapse;
        }

        #table table, th, td {
            border: 0.5px solid #ccc;
        }

        #table th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" width="100%" border="0" cellpadding="0" cellspacing="0">
        <!-- Your email content here -->
        <tr>
            <td style="padding: 20px;">
                <h1 style="color: #333; font-size: 24px; margin-bottom: 20px;">Notifikasi - {{ env('APP_NAME') }}</h1>
                <p style="color: #555; font-size: 16px; line-height: 1.6;">Hello, {{ $nama }}</p>
                <p style="color: #555; font-size: 16px; line-height: 1.6;">Ada {{ $totalPending }} pengaduan yang belum di proses.</p>
                <p style="color: #555; font-size: 16px; line-height: 1.6;">Harap untuk segera memproses laporan pengaduan.</p>
            </td>
        </tr>
    </table>
    <table id="table">
        <thead>
            <tr>
                <th>Pengadu</th>
                <th>Hari/Tanggal</th>
                <th>Isi Pengaduan</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $item)
            <tr>
                <td>{{ $item->user->nama }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->isi }}</td>
                <td> <a href="{{ route('pengaduan.show', $item->id) }}">Lihat</a> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
