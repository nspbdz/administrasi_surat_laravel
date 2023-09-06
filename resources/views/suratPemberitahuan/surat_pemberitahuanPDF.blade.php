<!DOCTYPE html>

<head>
    <title>Surat Pemberitahuan</title>
    <style>
        table tr .text2 {
            text-align: center;
        }

        table tr td {
            font-size: 15px;
        }

        table tr .text {
            text-align: right;
            font-size: 15px;
        }

        .site-footer-colors {
            background-color: #000000;
            float: left;
            width: 700px;
            height: 4px;
        }
    </style>
    <!-- <style>
        body {
            background: url('{{ $logo}}') no-repeat;
            background-size: cover;
            background-position: center;
            height: 10px;
            opacity: 0.5;

        }

        .transparent-image {
            opacity: 0.5;
            width: 100%;

        }
    </style> -->
</head>

<body>
    <center>
        <table align="center" border="0" style="width: 700px;">
            <tbody>
                <tr>
                    <td colspan="3">
                        <div align="left">
                            <img src="{{ $logo }}" alt="" height="115px" width="145px" id="logo">
                        </div>
                    </td>
                    <td>
                        <div align="center">
                            <font size="3"><b>DEWAN PENGURUS ANAK CABANG (DPAC)</b></font><br>
                            <font size="3"><b>FORUM KOMUNIKASI DINIYAH TAKMILIYAH (FKDT)</b></font><br>
                            <font size="4"><b>{{$suratPemberitahuan->instansis->cabang_instansi}}</b></font><br>
                            <font size="2"><i>{{$suratPemberitahuan->instansis->alamat}}</i></font><br>
                        </div>
                        <!-- <div class="site-footer-colors"></div> -->
                    </td>
                </tr>
                <!-- <tr>
                <td>
                <div class="site-footer-colors"></div>
                </td>
            </tr> -->
            </tbody>
        </table>
        <br>
        <hr>
        <table border="0" width="520">
            <tr>
                <td>Nomor</td>
                <td width="200">: {{$suratPemberitahuan->no_surat}}</td>
                <td class="text">{{$suratPemberitahuan->tempat_surat}}, {{ $tanggalSurat}}</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td width="200">: {{$suratPemberitahuan->perihal}}</td>
            </tr>
        </table>
        <br><br>
        <table border="0" width="520">
            <tr>
                <td>
                    <font size="2" style="font-size: 15px;">Kepada Yth,<br><b>{{$suratPemberitahuan->pnrm_surat}}</b><br>di<br>{{$suratPemberitahuan->alamat_surat}}</font>
                </td>
            </tr>
            <br>
        </table>
        <br><br>
        <table border="0" width="520">
            <tr>
                <td>
                    <font size="2" style="font-size: 15px;"><b><i>Assalamu'alaikum Warohmatullahi Wabarokatuh</i></b></font>
                </td>
            </tr>
        </table>
        <br>
        <table border="0" width="520">
            <tr>
                <td>
                    <font size="2" style="font-size: 15px;">{!! $suratPemberitahuan->isi_surat !!}</font>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <font size="2" style="font-size: 15px;"><b><i>Wassalamu'alaikum Warohmatullahi Wabarokatuh</i></b></font>
                </td>
            </tr>
        </table>
        <br><br><br><br><br><br><br>
        <table border="0" width="320">
            <tr>
                <td width="300"></td>
                <td width="300">
                    <div style="position: relative;">
                        <div style="position: absolute; z-index: -1; top: 0; right: 0;">
                            <img src="{{ $cap_surat}}" alt="Front Image" width="200px" height="100px" style="position: absolute; top: 0; left: 0;">
                            <img src="{{ $tanda_tangan}}" alt="Front Image" width="200px" height="100px" style="position: absolute; top: 0; left: 0;">
                        </div>
                    </div>
                    <div style="position: relative;">
                        <div style="position: absolute;  top: 0; right: 150px;">
                            <span style="position: absolute;top: 0; right: 0;" style="top: 0; right: 0;" class="text2">Hormat Kami,<br><br><br><br><br><br><b>{{$suratPemberitahuan->instansis->nama_pj}} </b>
                                <hr style="width: 220px"> {{$suratPemberitahuan->instansis->jabatan}}
                            </span>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <br>
    </center>
</body>

</html>
