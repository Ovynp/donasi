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
                <img src="{{$kegiatan->getFoto()}}" class="img-circle" alt="Avatar">
            </td>
            <td style="line-height: 1.2">
                <p align="center"><b style="font-size:20px">{{$kegiatan->nama}}<br>APLIKASI SANGGODIRAJO BERBAGI<br> <span style="font-size:10px;">alamat :{{ $kegiatan->alamat}} <br> website : www.sanggodirajoberbagi.com, Email : {{$user->email}}, No.Hp : {{$kegiatan->no_hp}}</span></p>
            </td>
            <td width="7%"></td>
        </tr>
    </table>
    <hr>
    <div align="center" style="font-size: 14px;">
        <p><b style="font-size: 18px;"><u>LAPORAN HASIL DONASI</u></b> <br> Tanggal : {{date('d M Y', strtotime($request->dari))}} s/d {{date('d M Y', strtotime($request->sampai))}} </p>
    </div>
    
    <div align="justify" style="font-size: 14px;">
        <ol type="a">
            <table border="1" cellspacing="0" cellpadding="5" style="text-align:center; font-size:12px; margin: 10px auto 10px " width="90%">
                <tr>
                    <th>No.</th>
                    <th>Nama Donatur</th>
                    <th>Jumlah Donasi</th>
                    <th>Tanggal Donasi</th>
                </tr>
                @php $no=1 @endphp
                @foreach($donaturs as $donatur)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$donatur->nama}}</td>
                    <td>{{currency_IDR($donatur->jumlah_donasi)}}</td>
                    <td>{{$donatur->created_at->format('d M Y')}}</td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td><strong>TOTAL DONASI</strong></td>
                    <td><strong>{{currency_IDR($jumlah)}}</strong></td>
                    <td></td>
                </tr>
            </table>
        </ol>
    </div>

    <table cellspacing="0" cellpadding="5" width="100%" style="font-size: 14px;">
        <tr style="text-align:center">
            <td width="50%"></td>
            <td width="50%">
                <p>Kedepatian Semerap, {{\Carbon\Carbon::now()->format('d M Y')}} <br> <b>Panitia Penanggung Jawab Kegiatan</b> <br><br><br><br><br><br> <b><u>{{$panitia->nama}}</u></b></p>
            </td>
        </tr>
    </table>
    
    <script>window.print();</script>
</body>
</html>