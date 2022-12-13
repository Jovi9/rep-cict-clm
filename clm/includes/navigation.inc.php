<nav class=" bg-white shadow">
    <div class=" px-6 lg:px-28 md:px-20">
        <div class="relative flex h-16 items-center justify-between">
            <a href="./app.php">
                <div class="relative flex h-16 items-center">
                    <img src="./images/cict-logo.png" alt="Logo" class="object-contain h-16 w-16 ">
                    <h1 class="font-bold text-gray-500">CICT Profiling</h1>
                </div>
            </a>
            <div class="hidden md:flex ">
                <?php
                if ($_SESSION['auth'][0]['role'] === 0) {
                ?>
                    <a href="./app.php?content=students" class="hover:bg-blue-100 border-b-4 border-blue-600 p-5 text-gray-500 text-sm font-medium">
                        Students
                    </a>
                <?php
                }
                ?>

                <button onclick="show()" class=" p-5 text-gray-500 text-sm font-medium"><?php echo $_SESSION['auth'][0]['name']; ?></button>
                <a id="item" href="./functions/Logout.php" class="hidden absolute right-0 ml-36 mt-12 px-5 py-1 rounded-md border-2  hover:text-red-500 border-gray-500 bg-white text-gray-500 text-sm font-medium">
                    Logout</a>
            </div>
            <button onclick="show_hide()" class="button md:hidden">
                <img src="./images/menu_ico.png" alt="Menu" class="object-contain h-8 w-8">
            </button>
        </div>
    </div>

    <div class="dropdown">
        <!-- dropdown list items will show when we click the drop button -->
        <div id="list-items" class="hidden">
            <div class="flex flex-col md:hidden pb-2 pt-2 ">
                <ul class="">
                    <?php
                    if ($_SESSION['auth'][0]['role'] === 0) {
                    ?>
                        <a href="./app.php?content=students" class="text-gray-500 hover:text-gray-900 font-medium ">
                            <li class="bg-blue-300 py-1 pl-7 border-l-4 border-blue-600">
                                Students
                            </li>
                        </a>
                    <?php
                    }
                    ?>

                    <li class=" py-1 pl-7">
                        <p class="text-gray-500 font-medium"><?php echo $_SESSION['auth'][0]['name']; ?></p>
                        <p class="text-gray-500 text-sm font-medium"><?php echo $_SESSION['auth'][0]['email']; ?></p>
                    </li>

                    <a href="./functions/Logout.php" class="text-gray-500 hover:text-red-500 font-medium">
                        <li class="hover:bg-red-100  py-1 pl-7">
                            Logout
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // navigation
        function show() {
            var click = document.getElementById("item");
            if (click.style.display === "block") {
                click.style.display = "none";
            } else {
                click.style.display = "block";
            }
        }

        function show_hide() {
            var click = document.getElementById("list-items");
            if (click.style.display === "block") {
                click.style.display = "none";
            } else {
                click.style.display = "block";
            }
        }
    </script>
</nav>