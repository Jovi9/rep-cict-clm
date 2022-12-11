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
    <title>Register</title>
    <link rel="stylesheet" href="./css/build/style.css">
</head>

<body>

    <div class=" flex min-h-full items-center justify-center py-12 px-4  sm:px-6 xl:px-8 ">
        <div class="w-full max-w-sm justify-center ">
            <div class=" p-5 mt-10 rounded-lg shadow-lg bg-white">

                <form action="#" method="POST">
                    <h2 class="mb-3 text-left text-3xl font-bold tracking-tight text-gray-900">
                        Register
                    </h2>

                    <!--student id-->
                    <div class="flex flex-col py-2 text-gray-400">
                        <label for="" class="block font-medium text-sm text-gray-700">Student ID No.</label>
                        <input class="text-gray-700  bg-slate-100 mt-2 p-2
                            rounded-md focus:outline-blue-200
                            shadow-sm border-gray-300 focus:border-indigo-300
                            focus:ring focus:ring-indigo-200
                            focus:ring-opacity-50" type="text" name="student_id" placeholder="Student ID">
                    </div>

                    <!-- name -->
                    <div class="flex flex-col py-2 text-gray-400">
                        <label for="" class="block font-medium text-sm text-gray-700">Name</label>
                        <input class="text-gray-700  bg-slate-100 mt-2 p-2
                            rounded-md focus:outline-blue-200
                            shadow-sm border-gray-300 focus:border-indigo-300
                            focus:ring focus:ring-indigo-200
                            focus:ring-opacity-50" type="text" name="name" placeholder="Name">
                    </div>

                    <!-- program -->
                    <div class="flex flex-col py-2 text-gray-400">
                        <label for="" class="block font-medium text-sm text-gray-700">Program</label>
                        <select aria-placeholder="" name="program" id="" class="text-gray-700 bg-slate-100
                                mt-2 p-2 rounded-md focus:outline-blue-200
                                shadow-sm border-gray-300 focus:border-indigo-300
                                focus:ring focus:ring-indigo-200
                                focus:ring-opacity-50" hover:bg-gray-500">
                            <option value="BSIT">BS In Information Technology</option>
                            <option value="BSIS">BS In Information System</option>
                            <option value="BSCS">BS In Computer Science</option>
                        </select>
                    </div>

                    <!-- yer level -->
                    <div class="flex flex-col py-2 text-gray-400">
                        <label for="" class="block font-medium text-sm text-gray-700">Year Level</label>
                        <select aria-placeholder="" name="year_level" id="" class="text-gray-700 bg-slate-100
                                mt-2 p-2 rounded-md focus:outline-blue-200
                                shadow-sm border-gray-300 focus:border-indigo-300
                                focus:ring focus:ring-indigo-200
                                focus:ring-opacity-50" hover:bg-gray-500">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>

                    <!--email-->
                    <div class="flex flex-col py-2 text-gray-400">
                        <label for="" class="block font-medium text-sm text-gray-700">Email</label>
                        <input class="text-gray-700  bg-slate-100 mt-2 p-2
                            rounded-md focus:outline-blue-200
                            shadow-sm border-gray-300 focus:border-indigo-300
                            focus:ring focus:ring-indigo-200
                            focus:ring-opacity-50" type="email" name="email" placeholder="Email">
                    </div>
                    <!--password-->
                    <div class="flex flex-col py-2 text-gray-400">
                        <label for="" class="block font-medium text-sm text-gray-700">Password</label>
                        <input class="text-gray-700 bg-slate-100 mt-2 p-2 rounded-md focus:outline-blue-200
                        shadow-sm border-gray-300 focus:border-indigo-300
                        focus:ring focus:ring-indigo-200
                         focus:ring-opacity-50" type="password" name="password" placeholder="Password">
                    </div>

                    <div class="mt-3">
                        <button class="w-full  items-center px-4 py-2 bg-gray-800
                        border border-transparent rounded-md font-semibold text-xs
                        text-white uppercase tracking-widest hover:bg-gray-700
                        active:bg-gray-900 focus:outline-none focus:border-gray-900
                        focus:ring ring-gray-300 disabled:opacity-25 transition
                        ease-in-out duration-150">
                            Register
                        </button>
                    </div>
                </form>
                <div class="block mt-2">
                    <a class="underline text-sm text-gray-500 hover:text-gray-900" href="./login.php">Already Registered?</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>