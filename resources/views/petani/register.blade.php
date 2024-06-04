<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="../dist/output.css">
</head>
<style>
    .tab {
        display: none;
    }

    .step.active>div {
        background-color: #9EB384;
    }

    .dropbtn {
        cursor: pointer;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 100%;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .show {
        display: block;
    }

    #kirimBtn {
        display: none;
    }

    input#gmb_tembakau.absolute {
        left: 20%;
        top: 72%;
    }
</style>

<body class="bg-light-primary">
    @if($errors->any())
    <div id="modelConfirm" class="fixed z-50 inset-0 bg-gray-900 bg-opacity-40 overflow-y-auto h-full w-full px-4 ">
        <div class="relative top-40 mx-auto shadow-xl rounded-xl bg-light-modal max-w-md">

            <div class="flex justify-end p-2">
                <button onclick="closeModal('modelConfirm')" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 pt-0 text-center">
                <div class="mx-auto flex items-center justify-center h-32 w-32 rounded-full">
                    <img src="../images/image 34.svg" class="">
                </div>

                <h3 class="text-xl font-bold text-light-secondary mt-5 ">PERHATIAN!!</h3>
                <h3 class="text-sm font-normal text-light-secondary mt-2 mb-6"> {{ $errors->all()[0] }}</h3>
                <button type="button" onclick="closeModal('modelConfirm')" class="text-white bg-light-button hover:opacity-80 focus:ring-2 focus:ring-white font-medium rounded-full text-base inline-flex items-center px-8 py-2 text-center mr-2">
                    Oke
                </button>
            </div>
        </div>
    </div>
    @endif
    <section id="regis" class="font-poppins bg-light-primary">
        <div class="bg-light-primary m-10">
            <div class="flex items-center justify-center p-5">
                <h3 class="text-4xl font-bold text-light-secondary text-center">
                    SELAMAT DATANG DI GOBACCO!!
                    <p class="text-sm font-normal text-light-secondary opacity-70 text-center">
                        Daftarkan diri anda dan mulai gunakan fitur kami segera
                    </p>
                </h3>

            </div>

            <form action="register" method="POST">
                @csrf
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="nama" class="text-sm font-medium text-light-secondary opacity-70 block mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_petani" id="nama" class="shadow-sm bg-light-fill opacity-50 text-light-hitam rounded-lg block w-full p-2.5 placeholder:text-light-hitam placeholder:text-xs" placeholder="Masukkan dan isi dengan sesuai">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="no-hp" class="text-sm font-medium text-light-secondary opacity-70 block mb-2">No. Handphone</label>
                            <input type="text" name="telp_petani" id="no-hp" class="shadow-sm bg-light-fill opacity-50 text-light-hitam rounded-lg block w-full p-2.5">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="username" class="text-sm font-medium text-light-secondary opacity-70 block mb-2">Username</label>
                            <input type="text" name="username_petani" id="username" class="shadow-sm bg-light-fill opacity-50 text-light-hitam rounded-lg block w-full p-2.5 placeholder:text-light-hitam placeholder:text-xs" placeholder="Masukkan dan isi dengan sesuai">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="ktp" class="text-sm font-medium text-light-secondary opacity-70 block mb-2">No.KTP</label>
                            <input type="text" name="noktp_petani" id="ktp" class="shadow-sm bg-light-fill opacity-50 text-light-hitam rounded-lg block w-full p-2.5">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="password" class="text-sm font-medium text-light-secondary opacity-70 block mb-2">Password</label>
                            <input type="password" name="pw_petani" id="password" class="shadow-sm bg-light-fill opacity-50 text-light-hitam rounded-lg block w-full p-2.5">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="alamat" class="text-sm font-medium text-light-secondary opacity-70 block mb-2">Alamat</label>
                            <input type="text" name="alamat_petani" id="alamat" class="shadow-sm bg-light-fill opacity-50 text-light-hitam rounded-lg block w-full p-2.5">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="email" class="text-sm font-medium text-light-secondary opacity-70 block mb-2">Email</label>
                            <input type="email" name="email_petani" id="email" class="shadow-sm bg-light-fill opacity-50 text-light-hitam rounded-lg block w-full p-2.5">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="kecamatan" class="text-sm font-medium text-light-secondary opacity-70 block mb-2">Kecamatan</label>
                            <input type="hidden" name="id_kecamatan" id="kecamatan" >
                            <div class="dropdown w-full">
                                <div onclick="myFunction()" style="padding-left:10px" id="drop1" class="dropbtn shadow-sm py-[1.4rem] bg-light-fill w-full  opacity-50 text-light-black rounded-lg block focus:outline-slate-400 "></div>
                                <div id="myDropdown" class="dropdown-content cursor-pointer">
                                    @foreach ($kecamatan as $kecamatan)
                                    <p data-id="{{ $kecamatan-> id_kecamatan }}" class="Kecamatan">{{ $kecamatan->kecamatan }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
<<<<<<< HEAD
                            <label for="jeniskelamin" class="text-sm font-medium text-light-secondary opacity-70 block mb-2">Jenis Kelamin</label>
                            <input type="hidden" name="id_jenis_kelamin" id="jenis-kelamin">
                            <div class="dropdown w-full">
                                <div onclick="myFunction2()" style="padding-left:10px" id="drop2" class="dropbtn shadow-sm py-[1.4rem] bg-light-fill w-full  opacity-50 text-light-black rounded-lg block focus:outline-slate-400"></div>
                                <div id="myDropdown2" class="dropdown-content cursor-pointer">
                                    @foreach ($jenis_kelamin as $jenis_kelamin)
                                    <p data-id="{{ $jenis_kelamin-> id_jenis_kelamin }}" class="jenisKelamin">{{ $jenis_kelamin->jenis_kelamin }} </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
=======
                            <label for="jenis-kelamin" class="text-sm font-medium text-light-secondary opacity-70 block mb-2">Jenis Kelamin</label>
                            <input  name="jenis_kelamin" id="nama">
                                    <div class="dropdown w-full">
                                        <div onclick="myFunction2()" id="drop2" class="dropbtn shadow-sm py-[1.4rem] bg-light-fill w-full  bg-opacity-50 text-light-secondary rounded-lg block focus:outline-slate-400"></div>
                                        <div id="myDropdown2" class="dropdown-content cursor-pointer">
                                            @foreach ($jenis_kelamin as $jenis_kelamin)
                                                <p data-id="{{ $jenis_kelamin->jenis_kelamin }}" class="jenisPengujian">{{ $jenis_kelamin->jenis_kelamin }}</p>
                                            @endforeach
                                          </div>
                                    </div>
                        </div>                        
>>>>>>> 8707987e2becf56ea640137165a11ec5d9a365db
                    </div>
                </div>

                <div class="text-center mt-6">
                    <button class="cursor-pointer rounded-lg bg-light-button px-8 py-4 text-sm font-bold text-white hover:opacity-80">REGISTER</button>
                </div>
            </form>
        </div>
    </section>
    @if (session('success'))
    <div id="modelSuccess" class="fixed z-50 inset-0 bg-gray-900 bg-opacity-40 overflow-y-auto h-full w-full px-4 ">
        <div class="relative top-40 mx-auto shadow-xl rounded-xl bg-light-modal max-w-md">

            <div class="flex justify-end p-2">
                <button onclick="closeModal('modelSuccess')" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>


                    </svg>
                </button>
            </div>

            <div class="p-6 pt-0 text-center">
                <div class="mx-auto flex items-center justify-center h-32 w-32 rounded-full">
                    <img src="../images/image 14.svg" class="">
                </div>

                <h3 class="text-xl font-bold text-light-secondary mt-5 ">BERHASIL!!</h3>
                <h3 class="text-sm font-normal text-light-secondary mt-2 mb-6">{{ session('success') }}</h3>
                <button type="button" onclick="closeModal('modelSuccess')" class="text-white bg-light-button hover:opacity-80 focus:ring-2 focus:ring-white font-medium rounded-full text-base inline-flex items-center px-8 py-2 text-center mr-2">
                    Oke
                </button>
            </div>
        </div>
    </div>
    @endif

    <script>
<<<<<<< HEAD
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        window.closeModal = function(modalId) {
            document.getElementById(modalId).style.display = 'none'
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
        }
        window.openModal = function(modalId) {
            document.getElementById(modalId).style.display = 'block'
            document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
        }

        window.closeModal = function(modalId) {
            document.getElementById(modalId).style.display = 'none'
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
        }

        document.onkeydown = function(event) {
            event = event || window.event;
            if (event.keyCode === 27) {
                document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
                let modals = document.getElementsByClassName('modal');
                Array.prototype.slice.call(modals).forEach(i => {
                    i.style.display = 'none'
                })
            }
        };

        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        function myFunction2() {
            document.getElementById("myDropdown2").classList.toggle("show");
        }

        function fixStepIndicator(n) {
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            x[n].className += " active";
        }
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('Kecamatan')) {
                document.querySelector('#kecamatan').value = e.target.dataset.id;
                document.querySelector('#drop1').innerText = e.target.innerText;
                document.querySelector('#drop1').style.paddingTop = '0.7rem';
                document.querySelector('#drop1').style.paddingBottom = '0.7rem';
                document.querySelector('#drop1').style.paddingBottom = 'text-align: right;';
            }

            if (e.target.classList.contains('jenisKelamin')) {
                document.querySelector('#jenis-kelamin').value = e.target.dataset.id;
                document.querySelector('#drop2').innerText = e.target.innerText;
                document.querySelector('#drop2').style.paddingTop = '0.7rem';
                document.querySelector('#drop2').style.paddingBottom = '0.7rem';
                document.querySelector('#drop2').style.paddingBottom = 'text-align: right;';
            }
        });
        
=======
function myFunction2() {
        document.getElementById("myDropdown2").classList.toggle("show");
    }
>>>>>>> 8707987e2becf56ea640137165a11ec5d9a365db
    </script>
</body>

</html>