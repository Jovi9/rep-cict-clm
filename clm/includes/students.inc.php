<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    // header('HTTP/1.0 403 Forbidden', TRUE, 403);
    // die("<h2>Access Denied!</h2> This file is protected and not available to public.");
    header('location: ../../index.php');
    exit();
}

if ($_SESSION['auth'][0]['role'] === 0) {
?>
    <h2 class="mb-3 text-left text-3xl font-bold tracking-tight text-gray-900">
        Student Lists
    </h2>
    <table class="min-w-full border-collapse block md:table">
        <thead class="block md:table-header-group">
            <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative ">
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Student ID </th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Name</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Program</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Year Level</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Actions</th>
            </tr>
        </thead>
        <tbody class="block md:table-row-group">

            <?php
            require './model/User.php';

            $users = new User;
            $result = $users->getStudents();

            if (!$result == null) {
                foreach ($result as $user) {
            ?>
                    <tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">
                                Student ID
                            </span>
                            <?php echo $user['student_id']; ?>
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">
                                Name
                            </span>
                            <?php echo $user['name']; ?>
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">
                                Program
                            </span>
                            <?php echo $user['program']; ?>
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">
                                Year Level
                            </span>
                            <?php echo $user['year_level']; ?>
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold mb-2">Actions</span>
                            <form action="./functions/ManageStudent.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

                                <?php
                                if ($user['status'] == 'approved') {
                                ?>
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded" type="submit" name="decline">Revoke</button>
                                <?php
                                } elseif ($user['status'] == 'declined') {
                                ?>
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded" type="submit" name="approve">Re-Approve</button>
                                <?php
                                } else {
                                ?>
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded" type="submit" name="approve">Approve</button>
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded" type="submit" name="decline">Decline</button>
                                <?php
                                }
                                ?>
                            </form>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>

        </tbody>
    </table>
<?php
} else {
    header('location: ../app.php');
}
?>