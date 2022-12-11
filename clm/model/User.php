<?php
require '../functions/DataConnection.php';

class User extends DataConnection
{
    public $id;
    public $student_id;
    public $name;
    public $program;
    public $year_level;
    public $email;
    public $password;
    public $status;
    public $role;

    function __construct()
    {
        parent::__construct();
    }

    function authenticateLogin($email, $password)
    {
        $this->email = $this->escapeValue($email);
        $this->password = $this->escapeValue($password);

        $result = array();

        $query = "select name, program, year_level, email, status, role from users where email=? and password=sha2(?, 512);";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param("ss", $this->email, $this->password);
            $stmt->execute();
            $que_result = $stmt->get_result();
            if ($que_result->num_rows === 1) {
                $result = $que_result->fetch_all(MYSQLI_ASSOC);
                // while ($row = $que_result->fetch_assoc()) {
                //     $result = [
                //         'name' => $row['name'],
                //         'program' => $row['program']
                //     ];
                // }
            } else {
                $result = null;
            }
        } else {
            $result = ['error' => 'Failed to process request.'];
        }
        $stmt->close();
        $this->con->close();
        return $result;
    }
}
