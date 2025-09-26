<!DOCTYPE html>
<html>
<head>
    <title>Data Pegawai</title>
</head>
<body>
    <h1>Data Pegawai</h1>

    <p><strong>Nama:</strong> {{ $name }}</p>
    <p><strong>Umur:</strong> {{ $my_age }} tahun</p>

    <h3>Hobi:</h3>
    @if(count($hobbies) === 1)
        <p>Saya punya satu hobi: {{ $hobbies[0] }}</p>
    @elseif(count($hobbies) > 1)
        <ul>
            @foreach ($hobbies as $hobby)
                <li>{{ $hobby }}</li>
            @endforeach
        </ul>
    @else
        <p>Tidak punya hobi</p>
    @endif

    <p><strong>Tanggal Harus Wisuda:</strong> {{ $tgl_harus_wisuda }}</p>
    <p><strong>Sisa Waktu Belajar (hari):</strong> {{ $time_to_study_left }}</p>
    <p><strong>Semester Saat Ini:</strong> {{ $current_semester }}</p>

    <p><strong>Info Semester:</strong> {{ $info }}</p>

    <p><strong>Cita-cita:</strong> {{ $future_goal }}</p>
</body>
</html>
