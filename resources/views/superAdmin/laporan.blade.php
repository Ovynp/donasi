<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan</title>
    <style>
        body {
            margin: 0px 10px 10px 10px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <table width="100%" cellspacing="0">
        <tr>
            <td width="10%">
                <img src="{{asset('images/default.png')}}" class="img-circle" alt="Avatar">
            </td>
            <td style="line-height: 1.2">
                <p align="center"><b style="font-size:20px">APLIKASI SANGGODIRAJO BERBAGI<br>5 DESA KEDEPATIAN SEMERAP<br> <span style="font-size:10px;">alamat : Simpang 4 Kedepatian Semerap <br> website : www.sanggodirajoberbagi.com, Email : {{$user->email}}</span></p>
            </td>
            <td width="7%"></td>
        </tr>
    </table>
    <hr>
    <div align="center" style="font-size: 14px;">
        <p><b style="font-size: 18px;"><u>LAPORAN KEGIATAN PENGUMPULAN DONASI <br>PADA APLIKASI SANGGODIRAJO BERBAGI</u></b> <br> Tanggal : {{\Carbon\Carbon::now()->format('d F Y')}} </p>
    </div>
    
    <div align="justify" style="font-size: 14px;">
        <ol type="a">
            <table border="1" cellspacing="0" cellpadding="5" style="text-align:center; font-size:12px; margin: 10px auto 10px " width="90%">
                <tr>
                    <th>No.</th>
                    <th>Nama Kegiatan</th>
                    <th>Jumlah Donasi Terkumpul</th>
                    <th>Target Donasi</th>
                    <th>Batas Donasi</th>
                </tr>
                @php $no=1 @endphp
                @foreach($kegiatan as $kegiatan)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$kegiatan->nama}}</td>
                    <td>{{currency_IDR($kegiatan->totalDonasi())}}</td>
                    <td>{{currency_IDR($kegiatan->target_donasi)}}</td>
                    <td>{{$kegiatan->batas_donasi->format('d M Y')}}</td>
                </tr>
                @endforeach
            </table>
        </ol>
    </div>

    <table cellspacing="0" cellpadding="5" width="100%" style="font-size: 14px;">
        <tr style="text-align:center">
            <td width="50%"></td>
            <td width="50%">
                <p>Kedepatian Semerap, {{\Carbon\Carbon::now()->format('d M Y')}} <br> <b>Penanggung Jawab</b> <br><br><br><br><br><br> <b><u>{{$user->name}}</u></b></p>
            </td>
        </tr>
    </table>
    
    <script>window.print();</script>
</body>
</html>