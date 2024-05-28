<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="../dist/output.css">
    <link rel="stylesheet" href="../dist/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>
    .Edukasi {
        margin-top: -50px;
        display: flex;
        border-radius: 50px;
        z-index: 999;
    }

    .image2-wrapper {
        width: 300px;
        height: 200px;
        margin-bottom: 30px;
    }

    .image2-wrapper img {
        width: 130px;
        height: 80px;
        border-radius: 0;
        margin-top: 20px;
    }

    .image2-wrapper button {
        display: flex;
        align-items: center;
        margin-top: 0px;
        width: auto;
        height: 40px;
        font-size: 12px;
    }

    .image2-wrapper h5 {
        margin-top: -5px;
        font-size: 16px;
        font-weight: 500;
    }

    .image2-container {
        display: flex;
        flex-direction: column;
        margin-top: -20px;
    }
    thead tr td{
        padding: 20px 20px;
    }
    tbody tr td {
        padding: 5px 20px;
    }
    tbody tr:nth-child(odd) {
        background-color: #004225;
    }
    tbody tr:nth-child(even) {
        background-color: #F5F5DC;
        color: black;
    }
    

    
</style>

<body>
    <section class="font-poppins">
        <div class="rightbox">
            <div class=" bg-light-secondary absolute top-0 w-full z-50">
                <img src="../images/Group 35.svg" alt="" class=" h-28 w-32 ml-4">
            </div>
            <div class="grid grid-cols-10 h-screen">
                <div class=" col-span-2 bg-light-secondary flex flex-col justify-between relative">
                    <div>
                        <div class="pb-32"></div>
                        <a href="/admin/dashboard" class="flex items-center px-4 py-2  text-light-primary hover:bg-light-button hover:rounded-full">
                            <div class="">
                                <img src="../images/Haruki Icons.svg" class="w-3/4">
                            </div>
                            Dashboard
                        </a>
                        <a href="/admin/user" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-light-button hover:rounded-full">
                            <div class="">
                                <img src="../images/Haruki Icons (4).svg" class="w-3/4">
                            </div>
                            User
                        </a>
                        <a href="/admin/edukasi" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-light-button hover:rounded-full">
                            <div class="">
                                <img src="../images/Haruki Icons (3).svg" class="w-3/4">
                            </div>
                            Edukasi
                        </a>
                    </div>
                    <div class="items-end justify-end py-2 box-border">

                        <form action="/logout" class="flex items-center justify-center p-2">
                            <button type="submit" class=" text-center font-bold bg-light-button text-light-putih py-2 px-14 rounded-full hover:opacity-80 focus:shadow-outline  ">
                                <span class=" text-xs">
                                    Logout
                                </span>
                            </button>
                        </form>

                        <div class="flex items-center py-2 px-4 mt-0 space-x-4 justify-self-end">
                            <img src="../images/profil.svg" alt="" class="w-12 h-12 rounded-lg dark:bg-gray-500">
                            <div>
                                <a href="/admin/akun">
                                <h2 class="text-base font-normal text-light-primary">Admin</h2>
                                <span class="flex items-center space-x-1 text-sm text-light-primary">
                                    <p>Gobacco</p>
                                </span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tengah" style="z-index:998; margin-top: 110px;height:635px; width:1105px; background-color:#F5F5DC; border-radius: 50px 50px 0 0; display:flex; justify-content:center;">
                    <div id="edukasi" class="Edukasi">
                        <h2 style="font-family: 'Poppins', sans-serif;">List Data Akun Petani</h2>
                        <div class="h-96 w-full bg-light-fill bg-opacity-50 rounded-xl mr-4">
                            <div class=" text-center mx-2 h-full" style="overflow-x: auto; width:1000px; height:370px; margin: 0 auto;">
                                <table>
                                    <thead>
                                        <tr>
                                            <td>ID PETANI</td>
                                            <td>NAMA</td>
                                            <td>USERNAME</td>
                                            <td>PASSWORD</td>
                                            <td>EMAIL</td>
                                            <td>ID JENIS KELAMIN</td>
                                            <td>ALAMAT PETANI</td>
                                            <td>ID_KECAMATAN</td>
                                            <td>NO HP</td>
                                            <td>NO KTP</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($petanis as $petani)
                                        <tr>
                                            <td>{{ $petani->id_petani }}</td>
                                            <td>{{ $petani->nama_petani }}</td>
                                            <td>{{ $petani->username_petani }}</td>
                                            <td>{{ $petani->pw_petani }}</td>
                                            <td>{{ $petani->email_petani }}</td>
                                            <td>{{ $petani->jenisKelamin->jenis_kelamin }}</td>
                                            <td>{{ $petani->alamat_petani }}</td>
                                            <td>{{ $petani->Kecamatan->kecamatan }}</td>
                                            <td>{{ $petani->telp_petani }}</td>
                                            <td>{{ $petani->noktp_petani }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>

</html>