<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    // header('HTTP/1.0 403 Forbidden', TRUE, 403);
    // die("<h2>Access Denied!</h2> This file is protected and not available to public.");
    header('location: ../../index.php');
    exit();
}

require  __DIR__ . '/../functions/DataConnection.php';


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

    function __destruct()
    {
        $this->con->close();
    }

    function studentIDExists($id)
    {
        $this->student_id = $this->escapeValue($id);

        $query = "select student_id from users where student_id=?;";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param("s", $this->student_id);
            $stmt->execute();
            $que_result = $stmt->get_result();
            if ($que_result->num_rows > 0) {
                $stmt->close();

                return true;
            } else {
                $stmt->close();

                return false;
            }
        } else {
            $stmt->close();

            $_SESSION['request_failed'] = "Failed to process request. Please try again.";
            header('location: ../../register.php');
            exit();
        }
    }

    function emailExist($email)
    {
        $this->email = $this->escapeValue($email);

        $query = "select email from users where email=?;";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param("s", $this->email);
            $stmt->execute();
            $que_result = $stmt->get_result();
            if ($que_result->num_rows > 0) {
                $stmt->close();

                return true;
            } else {
                $stmt->close();

                return false;
            }
        } else {
            $stmt->close();

            $_SESSION['request_failed'] = "Failed to process request. Please try again.";
            header('location: ../../register.php');
            exit();
        }
    }

    function registerUser($student_id, $name, $program, $year_level, $email, $password)
    {
        $this->student_id = $this->escapeValue($student_id);
        $this->name = $this->escapeValue($name);
        $this->program = $this->escapeValue($program);
        $this->year_level = $this->escapeValue($year_level);
        $this->email = $this->escapeValue($email);
        $this->password = $this->escapeValue($password);

        $query = "insert into users (student_id, name, program, year_level, email, password) values (?, ?, ?, ?, ?, sha2(?, 512))";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param("sssiss", $this->student_id, $this->name, $this->program, $this->year_level, $this->email, $this->password);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();

                return true;
            } else {
                $stmt->close();

                return false;
            }
        } else {
            $stmt->close();

            $_SESSION['request_failed'] = "Failed to process request. Please try again.";
            header('location: ../../register.php');
            exit();
        }
    }

    function authenticateLogin($email, $password)
    {
        $this->email = $this->escapeValue($email);
        $this->password = $this->escapeValue($password);

        $result = array();

        $query = "select id, student_id, name, program, year_level, email, status, role from users where email=? and password=sha2(?, 512);";
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

        return $result;
    }

    function getStudents()
    {
        $result = array();

        $query = "select id, student_id, name, program, year_level, email, status, role from users where not status=? order by status desc, program, year_level, name;";
        $stmt = $this->con->stmt_init();
        $role = 'administration';
        if ($stmt->prepare($query)) {
            $stmt->bind_param("s", $role);
            $stmt->execute();
            $que_result = $stmt->get_result();
            if ($que_result->num_rows > 0) {
                $result = $que_result->fetch_all(MYSQLI_ASSOC);
            } else {
                $result = null;
            }
        } else {
            $stmt->close();
            $_SESSION['request_failed'] = "Failed to process request. Please try again.";
            header('location: ./app.php');
            exit();
        }
        $stmt->close();
        return $result;
    }

    function approveStudentByID($id)
    {
        $id = $this->escapeValue($id);
        $status = 'approved';

        $query = "update users set status=? where id=?;";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param("si", $status, $id);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            $stmt->close();
            $_SESSION['request_failed'] = "Failed to process request. Please try again.";
            header('location: ../../register.php');
            exit();
        }
    }

    function declineStudentByID($id)
    {
        $id = $this->escapeValue($id);
        $status = 'declined';

        $query = "update users set status=? where id=?;";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param("si", $status, $id);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            $stmt->close();
            $_SESSION['request_failed'] = "Failed to process request. Please try again.";
            header('location: ../../register.php');
            exit();
        }
    }
}
