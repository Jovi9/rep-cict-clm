<?php
session_start();
if (isset($_SESSION['auth'])) {
    header('location: ./clm/app.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CICT Learning Materials</title>
    <link rel="stylesheet" href="./css/build/style.css">
</head>

<body>
    <div class="md:mt-16 mt-10">
        <div>
            <div class="flex justify-center ">
                <div>
                    <img src="/src/CSU_logo.png" alt="" class="md:flex  object-contain m-3 p-1 md:h-20 md:w-20 h-16 w-16">
                </div>
                <div class="self-center ">
                    <h1 class="flex justify-center text-sm font-bold  md:text-xl">Catanduanes State University</h1>
                    <div class="md:flex">
                        <h1 class="flex justify-center text-md font-bold md:text-lg lg:text-2xl">COLLEGE OF INFORMATION
                            AND </h1>
                        <h1 class="flex justify-center text-md font-bold md:text-lg lg:text-2xl pl-1"> COMMUNICATIONS
                            TECHNOLOGY</h1>
                    </div>
                    <h1 class="flex justify-center text-sm font-bold md:text-xl">Virac, Catanduanes</h1>
                </div>
                <div>
                    <img src="/src/cict-logo.png" alt="" class="md:flex  object-contain m-3 p-1 md:h-20 md:w-20 h-16 w-16">
                </div>
            </div>
            <div class="my-10 px-3 flex justify-center p-5 ">
                <h1 class="md:text-5xl text-3xl font-sans font-bold">CICT Learning Materials</h1>
            </div>
            <div class="flex justify-center mt-20">
                <a href="./clm/app.php">
                    <button class="shadow-lg w-28 px-5 mx-5 my-5 py-2  text-white font-bold rounded-lg
                    items-center bg-gray-800
                    border border-transparent  text-xs
                     uppercase tracking-widest hover:bg-white hover:text-black hover:border-gray-500
                    active:bg-gray-900 focus:outline-none focus:border-gray-900
                    focus:ring ring-gray-300 disabled:opacity-25 transition
                    ease-in-out duration-150">
                        Login
                    </button>
                </a>
                <a href="#">
                    <button class="shadow-lg w-28 px-5 mx-5 my-5 py-2  text-black font-bold rounded-lg
                        items-center border-gray-500
                        border border-transparent  text-xs
                         uppercase tracking-widest hover:bg-gray-800 hover:text-white
                        active:bg-gray-900 focus:outline-none focus:border-gray-900
                        focus:ring ring-gray-300 disabled:opacity-25 transition
                        ease-in-out duration-150">
                        Register
                    </button>
                </a>
            </div>
        </div>
    </div>

</body>

</html>