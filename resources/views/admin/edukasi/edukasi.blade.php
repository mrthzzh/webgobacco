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
        height: 400px;
        object-fit: cover;
    }

    .image2-wrapper img {
        height: 2000px;
    }

    .image2-wrapper button {
        margin-bottom: 30px;
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
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tengah" style="z-index:998; margin-top: 110px;height:635px; width:1105px; background-color:#F5F5DC; border-radius: 50px 50px 0 0; display:flex; justify-content:center;">
                    <div id="edukasi" class="Edukasi">
                        <h2 style="font-family: 'Poppins', sans-serif;">Informasi Edukasi Gobacco</h2>
                        <div class="image2-container" style="margin-bottom: 1000px; height: max-content; ">
                            <div class="image2-wrapper">
                                <img src="../images/images4.jpg.png" alt="Gambar 1">
                                <h5 style="font-family: 'Poppins', sans-serif">Informasi penanaman</h5>
                                <a href="/admin/tanamtembakau"><button class="lihat-detail" style="font-family: 'Poppins', sans-serif;">Lihat Detail</button></a>
                            </div>
                            <div class="image2-wrapper">
                                <img src="../images/images5.jpg" alt="Gambar 2">
                                <h5 style="font-family: 'Poppins', sans-serif">Informasi Ekspor</h5>
                                <a href="/admin/eksportembakau"><button class="lihat-detail" style="font-family: 'Poppins', sans-serif;">Lihat Detail</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>

</html>