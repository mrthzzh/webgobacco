<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../dist/output.css">
    <link rel="stylesheet" href="../dist/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>
    body {
        background-color: #F5F5DC;
    }

    button {
        width: 150px;
        height: 45px;
        background-color: #FFB000;
        border-radius: 30px;
        margin-top: 40px;
        outline: none;
        border: none;
        margin-left: 30px;
        margin-right: 30px;
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        color: #fff;
    }

    .page {
        font-family: 'Poppins', sans-serif;
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .page img {
        margin-top: 40px;
        margin-bottom: 40px;
        width: auto;
        height: 450px;
    }

    .page p {
        color: #00422580;
        width: 800px;
    }

    .buttons {
        display: flex;
        justify-content: space-between;
    }
</style>

<body>
    <section class="font-poppins">
        <div class="buttons">
            @if ($edukasi->id_topik == 1)
            <a href="/petani/tanamtembakau">
                @elseif ($edukasi->id_topik == 2)
                <a href="/petani/eksportembakau">
                    @endif
                    <div class="container">
                        <button>Kembali</button>
                    </div>
                </a>
        </div>
        <div class="page">
            <h2 style="font-family: 'Poppins', sans-serif; color: #004225; font-weight:600; font-size:26px;">{{$edukasi->judul_edukasi}}</h2>
            <div class="image-edu"><img src="../../storage/gambar_edu//{{ $edukasi->gambar_edukasi }}" alt="gambar"></div>
            <p>{{$edukasi->teks_edu}}</p>
        </div>
    </section>
</body>

</html>