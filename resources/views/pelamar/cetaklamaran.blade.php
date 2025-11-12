<html>
<head>
    <title> Surat Magang </title>
    <style type= "text/css">
            body {
                font-family: arial; 
                /* background-color : #ccc  */
            }
            .rangkasurat {
                /* width : 980px;
                margin:0 auto;
                background-color : #fff;
                height: 500px;
                padding: 20px; */
            }
            table {
                border-bottom : 5px solid # 000; 
                padding: 2px
            }
            .tengah {
                text-align : center;
                line-height: 5px;
            }


            #judul{
                text-align:center;
            }

            #halaman{
                width: auto; 
                height: auto; 
                position: absolute; 
                /* border: 1px solid;  */
                padding-top: 30px; 
                padding-left: 30px; 
                padding-right: 30px; 
                padding-bottom: 80px;
            }
     </style >
</head>
<body>
<div class = "rangkasurat">
     <table width = "100%">
           <tr>
                 {{-- <td width = "200px"><img src="{{ asset('') }}assets_admin/img/logonew.png" width="100%"></td> --}}
                 <td class="tengah">
                       <h2>PT. Biro Klasifikasi Indonesia (Persero)</h2>
                     
                       <h4> Jl. Yos Sudarso No.38-40, RT.4/RW.10, Kb. Bawang, </h4>
                       <h4>Kec. Tj. Priok, Jkt Utara, Daerah Khusus Ibukota Jakarta 14320</h4>
                 </td>
            </tr>
            <hr>
     </table >
  
     <div id=halaman>
         <h3 id=judul>SURAT PERNYATAAN</h3>
     
         <p>Saya yang bertanda tangan di bawah ini :</p>
     
         <table>
             <tr>
                 <td style="width: 30%;">Nama</td>
                 <td style="width: 5%;">:</td>
                 <td style="width: 65%;">HRD PT. Biro Klasifikasi Indonesia</td>
             </tr>
             <tr>
                <td style="width: 30%;">No telp</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">(021) 4301017</td>
            </tr>
             <tr>
                 <td style="width: 30%; vertical-align: top;">Alamat</td>
                 <td style="width: 5%; vertical-align: top;">:</td>
                 <td style="width: 65%;">Jl. Yos Sudarso No.38-40, RT.4/RW.10, Kb. Bawang, Kec. Tj. Priok, Jkt Utara, Daerah Khusus Ibukota Jakarta 14320</td>
             </tr>
            
         </table>
         <p>Dengan ini menyatakan bahwa: :</p>
         <table>
            <tr>
                <td style="width: 30%;">Nama</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">{{$detail_pendaftaran->nama_lengkap}}</td>
            </tr>
            <tr>
                <td style="width: 30%;">Tempat, tanggal lahir</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">{{$detail_pendaftaran->tempat_lahir}}, {{$detail_pendaftaran->tanggal_lahir}}</td>
            </tr>
            <tr>
                <td style="width: 30%; vertical-align: top;">Alamat</td>
                <td style="width: 5%; vertical-align: top;">:</td>
                <td style="width: 65%;">{{$detail_pendaftaran->alamat_lengkap}}</td>
            </tr>
         
        </table>
         <p align = "justify">Mahasiswa yang bersangkutan telah diterima magang kerja di PT. Biro Klasifikasi Indonesia (Persero) Yang bersangkutan dapat melaksanakan magang kerja selama 6 bulan, 
            Selama magang di PT. Nama Perusahaan, yang bersangkutan wajib menaati peraturan yang ada di perusahaan kami.</p>
     
         {{-- <div style="width: 50%; text-align: left; float: right;">Jakarta, {{date('d-m-Y')}}</div><br> --}}
         <div style="width: 50%; text-align: left; float: right;">Yang bertanda tangan,</div><br><br><br><br><br>
         <div style="width: 50%; text-align: left; float: right;">HRD  PT. Biro Klasifikasi Indonesia</div>
     
     </div>
</div>

</body>
</html>