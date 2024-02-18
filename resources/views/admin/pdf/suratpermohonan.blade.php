<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Permohonan Prakerin</title>
    <style type="text/css">
        @media print {
            @page {
                size: a4 portrait;
                margin: 0;
                padding: 0;
            }
        }

        /* .p {
            margin-bottom: 1.5em; /* Atur jarak antar paragraf menjadi 1.5 */
        }

        */
        /* .body {
            margin-left: 4em;
            margin-right: 3em;
        } */
    </style>
</head>
{{-- onload="window.print()" --}}

<body onload="window.print()">
    <section class="page1">
        <div class="kepala">
            <table align="center">
                <tr>
                    <td colspan="2" height="15"></td>
                </tr>
                <tr>
                    <td><img src="{{ asset('assets/img/logoJateng.png') }}" width="80" height="80" /></td>
                    <td>
                        <center>
                            <font size="3"><b>PEMERINTAH PROVINSI JAWA TENGAH</b></font><br>
                            <font size="3"><b>DINAS PENDIDIKAN DAN KEBUDAYAAN</b></font><br>
                            <font size="4"><b>SEKOLAH MENENGAH KEJURUAN NEGERI 1 ADIWERNA</b></font><br>
                            <font size="1">JL. Raya II Po Box 24, Telp : (0283) 443768, Fax: (0283) 445494
                                Adiwerna
                                52194
                                Kab. Tegal</font><br>
                            <font size="1">website: smkn1adw.sch.id, e-mail: mail@smkn1adw.sch.id</font>
                        </center>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr style=" border: 2px solid #000000;">
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <table align="center">

            <tr>
                <td width="15">Nomor</td>
                <td width="10"> :</td>
                <td width="203"> ...... /...... / ...... </td>
                <td rowspan="5" width="30"></td>
                <td>Adiwerna, <?php echo date('d') . ' ' . App\Helpers\MyHelpers::getIndonesianMonth(date('F')) . date(' Y'); ?></td>
                <td rowspan="5" width="20"></td>
            </tr>
            <tr>
                <td width="15">Lamp.</td>
                <td width="10"> :</td>
                <td width="203">1 eks.</td>
            </tr>
            <tr>
                <td width="15">Hal</td>
                <td width="10"> :</td>
                <td colspan="2" width="203"><b><i><u>Permohonan Praktik Kerja Industri (Prakerin)
                    </b></i></u></td>
            </tr>

            <tr>
                <td height="30" colspan="6"></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td width="250" align="justify">Kepada Yth. Pimpinan
                    <br>
                    <b>{{ $dataPermohonan->tempat_prakerin }}</b>
                    <br>{{ $dataPermohonan->alamat_tempat_prakerin }}<br>
                    di _
                    <br>
                    <center>Tempat</center>
                </td>
            </tr>
            <tr>
                <td height="20" colspan="6"></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="4" align="justify" width="300" style="margin-bottom: 0px">Dengan hormat,
                    <div class="isi">
                        <p style="text-indent: 30px; text-align: justify; margin-top: 5px; margin-bottom:0px">Bersama
                            ini kami sampaikan bahwa dalam rangka meningkatkan
                            ketrampilan siswa serta kesinambungan Praktik Kerja Industri (Prakerin)
                            yang tertuang dalam Kurikulum Merdeka, maka kami mengajukan
                            permohonan kepada Pimpinan Instansi/Industri/Perusahaan
                            <b>{{ $dataPermohonan->tempat_prakerin }}</b> untuk menerima siswa kami
                            Program Keahlian
                            {{ isset($dataPermohonan->siswa->jurusan) ? $jurusanMapping[$dataPermohonan->siswa->jurusan] : '' }}
                            ({{ $dataPermohonan->siswa->jurusan }})
                            melaksanakan Prakerin untuk tahun pelajaran 2023/2024 dan kami
                            jadwalkan pelaksanaannya mulai tanggal
                            <b>
                                {{ isset($dataPermohonan->tanggal_mulai) ? App\Helpers\MyHelpers::getIndonesianDate($dataPermohonan->tanggal_mulai) : '' }}
                            </b>
                            s.d
                            <b>
                                {{ isset($dataPermohonan->tanggal_selesai) ? App\Helpers\MyHelpers::getIndonesianDate($dataPermohonan->tanggal_selesai) : '' }}
                            </b>
                            atau selama ± {{ $dataPermohonan->durasi }} bulan.
                        </p>
                        <p style="text-indent: 30px; margin-top: 5px; margin-bottom: 0px">Sebagai bahan pertimbangan,
                            bersama ini saya lampirkan dokumen pengajuan
                            Prakerin antara lain:
                        </p>
                        <ul
                            style="list-style-type: none; padding: 0; text-indent: 20px; margin-top:5px; margin-bottom:0px;">
                            <li>1. Lampiran daftar calon peserta Prakerin;</li>
                            <li>2. CV calon peserta Prakerin;</li>
                        </ul>
                        <p style="text-indent: 30px; margin-top: 5px; margin-bottom: 0px">Perlu diketahui bahwa proses
                            seleksi, jumlah siswa yang diterima, dan waktu
                            pelaksanaan program sepenuhnya menyesuaikan kebijakan Instansi/Industri/
                            Perusahaan. Dan sebagai informasi lainnya, siswa yang kami ajukan dalam program
                            ini telah kami fasilitasi asuransi oleh Pihak Sekolah.</p>
                        <p style="text-indent: 30px; margin-top: 5px; margin-bottom: 0px">Sebagai tambahan, berikut ini
                            adalah Kontak PIC (Person in Charge) dari pihak
                            Sekolah yang dapat dihubungi di nomor WhatsApp 0878-8646-0895 a.n Muh. Nana
                            Aviciena selaku Pokja Prakerin TKJ SMKN 1 Adiwerna, atau dapat menghubungi
                            melalui surel <a href="mailto:tkj@smkn1adw.sch.id">tkj@smkn1adw.sch.id.</a></p>
                    </div>
                    <div class="penutup">
                        <p style="text-indent: 30px; margin-top: 5px; margin-bottom: 0px">Demikian untuk menjadi
                            periksa, atas perhatian dan kerjasamanya disampaikan
                            terimakasih.</p>
                    </div>
                </td>
            </tr>
            <tr colspan="4">
                <td colspan="4"></td>
                <td colspan="2">
                    <div class="ttd">
                        <br>
                        <ul style="list-style-type: none; text-indent:20px;">
                            <li>Kepala Sekolah</li>
                            <br>
                            <br>
                            <br>
                            <br>
                            <b>
                                <li style="text-decoration:underline;">Imron Effendi,S.P. M.Pd</li>
                            </b>
                            <li>NIP. 19640316 198803 1 013</li>
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
    </section>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <section class="page2">

        <table align="center">
            <tr>
                <td colspan="3" width="520">Lampiran 1. Permohonan Praktik Kerja Industri (Prakerin)</td>
            </tr>
            <tr>
                <td width="20">Nomor</td>
                <td width="10"> :</td>
                <td width="520">423.4 /..... / 2023</td>
            </tr>
            <tr>
                <td width="20">Tanggal</td>
                <td width="10"> :</td>
                <td width="520">Adiwerna, <?php echo date('d') . ' ' . App\Helpers\MyHelpers::getIndonesianMonth(date('F')) . date(' Y'); ?></td>
            </tr>
            <tr>
                <td height="40" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <center>
                        <font size="3"><b>DAFTAR USULAN PESERTA PROGRAM PRAKTIK KERJA INDUSTRI DI</b></font><br>
                        <font size="3"><b>{{ $dataPermohonan->tempat_prakerin }}</b></font><br>
                        <font size="3"><b>PROGRAM KEAHLIAN
                                {{ isset($dataPermohonan->siswa->jurusan) ? $jurusanMapping[$dataPermohonan->siswa->jurusan] : '' }}</b>
                        </font><br>
                        <font size="3"><b>({{ $dataPermohonan->siswa->jurusan }}) SMKN 1 ADIWERNA</b></font><br>
                        <font size="3"><b>Periode
                                {{ isset($dataPermohonan->tanggal_mulai) ? App\Helpers\MyHelpers::getIndonesianDate($dataPermohonan->tanggal_mulai) : '' }}
                                s.d
                                {{ isset($dataPermohonan->tanggal_mulai) ? App\Helpers\MyHelpers::getIndonesianDate($dataPermohonan->tanggal_selesai) : '' }}</b>
                        </font><br>
                    </center>
                </td>
            </tr>
            <tr>
                <td height="20" colspan="3"></td>
            </tr>

        </table>

        <table border="1" align="center">
            <br>
            <br>
            <thead style="background-color: rgb(233, 230, 230); ">
                <tr style="border: 1px solid #000000">
                    <th width="40">NO.</th>
                    <th width="90">NIS</th>
                    <th width="210">Nama</th>
                    <th width="90">Kelas</th>
                    <th width="140">No. HP/WA</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td width="40" style="text-align: center;">1</td>
                    <td width="90" style="text-align: center;">{{ $dataPermohonan->NIS }}</td>
                    <td width="210" style="text-align: center;">{{ $dataPermohonan->siswa->name }}</td>
                    <td width="90" style="text-align: center;">{{ $dataPermohonan->siswa->kelas }}</td>
                    <td width="140" style="text-align: center;">{{ $dataPermohonan->siswa->telp }}</td>
            </tbody>
        </table>
        <br>
        <table align="center">
            <tr>
                <td height="20" colspan="5" width="595"></td>
            </tr>
            <tr>
                <td colspan="3" width="260"></td>
                <td colspan="2">
                    <div class="ttd">
                        <br>
                        <ul style="list-style-type: none;">
                            <li>Kepala Sekolah</li>
                            <br>
                            <br>
                            <br>
                            <br>
                            <b>
                                <li style="text-decoration:underline;">Imron Effendi,S.P. M.Pd</li>
                            </b>
                            <li>NIP. 19640316 198803 1 013</li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td height="380" colspan="5"></td>
            </tr>
        </table>
    </section>

    <section class="page3">
        <br><br><br><br><br><br><br><br><br><br><br>
        <table align="center">
            <tr>
                <td width="590" colspan="3">
                    <center>
                        <font size="4"><b>KONFIRMASI</b></font><br>
                        <font size="4"><b>PENGAJUAN KEGIATAN PRAKTEK KERJA INDUSTRI (PRAKERIN)</b></font><br>
                    </center>

                </td>
            </tr>
            <tr>
                <td colspan="3" height="40"></td>
            </tr>
            <tr>
                <td width="190"></td>
                <td width="190"></td>
                <td>Kepada Yth.
                    <br>
                    <b>Kepala SMKN 1 Adiwerna</b>
                    <br>
                    di _
                    <br>
                    <center>Tempat</center>
                </td>
            </tr>
            <tr>
                <td colspan="3" height="40"></td>
            </tr>
            <tr>
                <td colspan="3" width="200">
                    <p style="text-indent: 30px; text-align: justify; margin:0px; line-height: 1.5;">
                        Berdasarkan dengan surat permohonan Prakerin dari SMKN 1 Adiwerna sesuai dengan
                        nomor ajuan 423.4 /....../ 2022 tanggal <?php echo date('d') . ' ' . App\Helpers\MyHelpers::getIndonesianMonth(date('F')) . date(' Y'); ?>. Maka dengan ini kami
                        <b>MENERIMA / MENOLAK * </b>untuk melaksanakan kegiatan tersebut sesuai dengan syarat dan
                        ketentuan yang berlaku di Perusahaan/Instansi <b>{{ $dataPermohonan->tempat_prakerin }}</b>
                        yang beralamat
                        di {{ $dataPermohonan->alamat_tempat_prakerin }}, selama …… bulan dan terhitung mulai
                        ........................ sampai ........................
                    </p>
                    <p style="text-indent: 30px; text-align: justify; margin:0px; line-height: 1.5">
                        Adapun peserta yang kami terima dalam kegiatan Prakerin di Instansi/Perusahan kami adalah:
                    </p>
                </td>
            </tr>
        </table>
        <table border="1" align="center">
            <br>
            <thead style="background-color: rgb(233, 230, 230); ">
                <tr style="border: 1px solid #000000">
                    <th width="40">NO.</th>
                    <th width="90">NIS</th>
                    <th width="275">Nama</th>
                    <th width="170">Status</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td width="40" style="text-align: center;">1</td>
                    <td width="90" style="text-align: center;">{{ $dataPermohonan->NIS }}</td>
                    <td width="275" style="text-align: center;">{{ $dataPermohonan->siswa->name }}</td>
                    <td width="170" style="text-align: center;">Diterima / Ditolak *</td>
            </tbody>

        </table>
        <table align="center">
            <br>
            <tr>
                <td colspan="3" width="595">
                    <p style="text-align: justify; margin:0px; line-height: 1.5;">
                        Dengan bidang keilmuan / materi selama kegiatan Prakerin adalah di bidang <b>Jaringan
                            Komputer</b> / <b>Fiber Optik</b>/ <b>Cloud Computing</b> / <b>Administrasi Server</b> /
                        <b>Programming</b> /
                        <b>Lainnya ..................................... *</b>
                    </p>
                    <p style="text-indent: 30px; text-align: justify; margin:0px; line-height: 1.5;">
                        Demikian surat keterangan ini kami buat atas perhatian dan kerjasamanya kami ucapakan
                        terimakasih.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="260"></td>
                <td>
                    <div class="ttd">
                        <br>
                        <ul style="list-style-type: none; margin: 0;">
                            <li>................., ........................... 20......</li>
                            <li>an. <b>{{ $dataPermohonan->tempat_prakerin }}</b></li>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <b>
                                <li>
                                    <hr style="border: 0.1px solid #000000;">
                                </li>
                            </b>
                            <li>Jabatan: </li>
                        </ul>
                    </div>
                </td>
                <td width="55"></td>
            </tr>
            <tr>
                <td colspan="3" height="70"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <ul style="list-style-type: none; margin: 0; padding:0">
                        <i>
                            <li>
                                <font size="2">*) Coret yang tidak perlu</font>
                            </li>
                            <li>
                                <font size="2">**) Jumlah siswa yang di terima menyesuaikan kebijakan
                                    Instansi/Perusahaan </font>
                            </li>
                        </i>
                    </ul>
                </td>
            </tr>
        </table>
    </section>

</body>

</html>
