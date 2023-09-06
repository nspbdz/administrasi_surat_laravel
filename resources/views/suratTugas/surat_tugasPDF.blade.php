<!DOCTYPE html>

<head>
    <title>Surat Tugas</title>
    <style>
        table tr .text2 {
            text-align: center;
        }

        table tr td {
            font-size: 15px;
        }

        table tr .text {
            text-align: center;
            font-size: 15px;
        }

        .test{
            padding: 10px;
            border: 1px solid black;        
        }

        .test-right{
            padding: 10px;
            border: 1px solid black;
            border-right: none; 
        }
    </style>
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
                            <font size="4"><b>{{$suratTugas->instansis->cabang_instansi}}</b></font><br>
                            <font size="2"><i>{{$suratTugas->instansis->alamat}}</i></font><br>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <hr>
        <table border="0" width="520">
            <tr>
                <td class="text" style="font-size: 18px;"><b>{{$suratTugas->jenis_surat}}</b></td>
            </tr>
            <hr style="width: 100px">
            <tr>
                <td class="text">Nomor : {{$suratTugas->no_surat}}</td>
            </tr>
        </table>
        <br>
        <table border="0" style="font-size: 16px;">
            <tr>
                <td width="200">Yang bertanggung jawab dibawah ini</td>
                <td width="315">:</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td width="315">: {{$suratTugas->instansis->nama_pj}}</td>
            </tr>
            <tr>
                <td>NIP</td>
                <td width="315">: {{$suratTugas->instansis->nip}}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td width="315">: {{$suratTugas->instansis->jabatan}}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td width="315">: {{$suratTugas->instansis->alamat}}</td>
            </tr>
        </table>
        <br>
        <table border="0" style="font-size: 16px;">
            <tr>
                <td width="200">Dengan ini memberikan tugas kepada</td>
                <td width="315">:</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td width="315">: {{$suratTugas->nama_pegawai}}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td width="315">: {{$suratTugas->jabatan}}</td>
            </tr><br>
        </table>
        <table border="0" width="520">
            <tr>
                <td>
                    <font size="2" style="font-size: 15px;">{!! $suratTugas->isi_surat !!}</font>
                </td>
            </tr>
        </table>
        <table border="0" style="font-size: 16px;">
            <tr>
                <td width="200">Hari/Tanggal</td>
                <td width="315">: {{ Carbon\Carbon::parse($suratTugas->tanggal_tugas)->isoFormat('dddd, D MMMM Y')}}
                </td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td width="315">: {{$suratTugas->tempat_tugas}}</td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td>Demikian surat tugas ini saya buat dengan sebenar-benarnya, untuk digunakan sebagaimana mestinya.</td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br>
        <table border="0" width="520" style="font-size: 16px;">
            <tr>
                <td width="300"></td>
                <td width="300">
                    <div style="position: relative;">
                        <div style="position: absolute; z-index: -1; top: 0; right: 0;">
                            <img src="{{ $cap_surat}}" alt="Front Image" width="200px" height="100px" style="position: absolute; top: 0; left: 0; margin-top: 10px;">
                            <img src="{{ $tanda_tangan}}" alt="Front Image" width="200px" height="100px" style="position: absolute; top: 0; left: 0;">
                        </div>
                    </div>
                    <div style="position: relative;">
                        <div style="position: absolute;  top: 0; right: 150px;">
                            <span style="position: absolute;top: 0; right: 0;" style="top: 0; right: 0;" class="text2">{{$suratTugas->tempat_surat}},
                                    {{ Carbon\Carbon::parse($suratTugas->tanggal_surat)->isoFormat('D MMMM Y')}}<br>{{$suratTugas->instansis->nama_instansi}}<br><br><br><br><br><b>{{$suratTugas->instansis->nama_pj}} </b>
                                    <hr style="width: 220px"> {{$suratTugas->instansis->jabatan}}</td>
                            </span>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <br><br><br><br><br><br><br>
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
                            <font size="4"><b>{{$suratTugas->instansis->cabang_instansi}}</b></font><br>
                            <font size="2"><i>{{$suratTugas->instansis->alamat}}</i></font><br>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <hr>
        <table border="0" width="520">
            <tr>
                <td style="font-size: 15px;"><b>Lampiran Surat Tugas No: {{$suratTugas->no_surat}}</b></td>
            </tr>
        </table>
        <br>
        <table style="width:100%">
            <tr class="test">
                <td class="test-right">Berangkat dari &nbsp;: <br> Ke &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <br> Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <br> Tanda Tangan &nbsp;&nbsp;: <br><br><br><br><br><br><br><br></td>
                <td class="test">Tiba di &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <br> Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <br> <br>  Tanda Tangan : <br><br><br><br><br><br><br><br></td>
            </tr>
    </table>
    </center>
</body>

</html>
