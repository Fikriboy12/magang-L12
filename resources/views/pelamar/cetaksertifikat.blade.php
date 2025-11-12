
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Sertifikat</title>
    <style>
        html,body{
            height: 100%;
            margin: 0px;
        }

        .background{
            background-image: url('sertifikat/cetak.png');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .top-title{
            margin-top: 20px;
        }

      
        /* 
        .top-body{
           
            padding-left: {{$detail->padding_left}}px;
            padding-right: {{$detail->padding_right}}px;
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
        }

        .top-title-ttd{
            padding-top : {{$detail->top_title_ttd}}px;
            
        }

        .top-nama-ttd{
            padding-top : 100px;
        } */
    </style>
</head>
<body> 
    <div class="background">
        <center>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="top-title">
                <h1>{{$detail->nama_sertifikat}}</h1>
            </div>
          
        </center>

        
    </div>
</body>
</html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

{{-- <script>
    window.print()
</script> --}}