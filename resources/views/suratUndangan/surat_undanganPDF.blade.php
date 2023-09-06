<!DOCTYPE html>

<head>
    <title>Surat Undangan</title>
    <style>
        .inline-container p {
            display: inline;
            text-align: justify;
        }

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
            /* background-size: cover; */
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

<body class="transparent-image">
    <center>
        <!-- <img src="{{ $logo }}" alt="Image" class="transparent-image"> -->
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
                            <font size="4"><b>{{$suratUndangan->instansis->cabang_instansi}}</b></font><br>
                            <font size="2"><i>{{$suratUndangan->instansis->alamat}}</i></font><br>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <hr>
        <table border="0" width="520">
            <tr>
                <td>Nomor</td>
                <td width="200">: {{$suratUndangan->no_surat}}</td>
                <td class="text">{{$suratUndangan->tempat_surat}}, {{ $tanggalSurat}}</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td width="200">: {{$suratUndangan->perihal}}</td>
            </tr>
        </table>
        <br>
        <table border="0" width="520">
            <tr>
                <td>
                    <font size="2" style="font-size: 15px;">Kepada Yth,<br><b>{{$suratUndangan->pnrm_surat}}</b><br>di<br>{{$suratUndangan->alamat_surat}}</font>
                </td>
            </tr>
            <br>
        </table>
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
                    <font size="2" style="font-size: 15px;">{!! $suratUndangan->isi_surat !!}</font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="2" style="font-size: 15px;">Adapun waktunya Insya Allah akan dilaksanakan, pada:</font>
                </td>
            </tr>
        </table>
        <table border="0" style="font-size: 12px;">
            <tr>
                <td width="200">Hari/Tanggal</td>
                <td width="315">:<b> {{ Carbon\Carbon::parse($suratUndangan->tanggal_keg)->isoFormat('dddd, D MMMM Y')}}</b></td>
            </tr>
            <tr>
                <td>Waktu Kegiatan</td>
                <td width="315">: {{$suratUndangan->waktu_keg}}</td>
            </tr>
            <tr>
                <td>Tempat Kegiatan</td>
                <td width="315">: {{$suratUndangan->tempat_keg}}</td>
            </tr>
            <tr>
                <td>Acara</td>
                <td rowspan="4" width="315">

                    {!! ':' . $suratUndangan->acara !!}


                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <font size="2" style="font-size: 15px;">Demikian Undangan ini kami sampaikan, besar harapan kami saudara/i untuk dapat menghadiri Rapat ini supaya tidak ada kesalahpahaman. Atas perhatiannya dan kehadirannya kami sampaikan terima kasih.</font>
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
        <br><br>
        <table border="0" width="320">
            <tr>
                <td width="300"></td>
                <td width="300">
                    <div style="position: relative;">
                        <div style="position: absolute; z-index: -1; top: 0; right: 0;">
                            <!-- <img src="{{ $logo}}" alt="Front Image" width="200px" height="100px" style="position: absolute; top: 0; left: 0;"> -->
                            <!-- <img src="https://img2.pngdownload.id/20180401/liw/kisspng-file-signature-signature-5ac0f08a8ab6a1.7417798515225939305682.jpg" width="150px" height="70px" alt="Back Image" style="position: absolute; top: 25px; left: 0; opacity: 0.7;"> -->
                            <img src="{{ $cap_surat}}" alt="Front Image" width="200px" height="100px" style="position: absolute; top: 0; left: 0;">
                            <img src="{{ $tanda_tangan}}" alt="Front Image" width="200px" height="100px" style="position: absolute; top: 0; left: 0;">
                        </div>
                        <div style="position: relative; ">
                            <div style="position: absolute;  top: 0; right: 150px;">

                                <span style="position: absolute;top: 0; right: 0;" style="top: 0; right: 0;" class="text2">Hormat Kami,<br><br><br><br><br><br><b>{{$suratUndangan->instansis->nama_pj}} </b>
                                    <hr style="width: 220px"> {{$suratUndangan->instansis->jabatan}}
                                </span>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <br>
    </center>
</body>

</html>
