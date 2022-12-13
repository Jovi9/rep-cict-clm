<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../../index.php');
    exit();
}

require  __DIR__ . '/../functions/DataConnection.php';

class Subject extends DataConnection
{
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        $this->con->close();
    }

    function subjectCodeExist($code)
    {
        $code = $this->escapeValue($code);

        $query = "select code from subjects where code=?;";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param("s", $code);
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

    function storeNewSubject($code, $desc, $program, $year_level, $filename)
    {
        $code = $this->escapeValue($code);
        $desc = $this->escapeValue($desc);
        $program = $this->escapeValue($program);
        $year_level = $this->escapeValue($year_level);
        $filename = $this->escapeValue($filename);

        $query = "insert into subjects (code, description, program, year_level, file_dir) values (?, ?, ?, ?, ?);";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param("sssis", $code, $desc, $program, $year_level, $filename);
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

    function getSubjects()
    {
        $result = array();

        $query = "select id, code, description, program, year_level, file_dir from subjects order by program, year_level, code;";
        $stmt = $this->con->stmt_init();
        if ($stmt->prepare($query)) {
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

    function getSubjectsByYearLevel($program, $year_level)
    {
        $program = $this->escapeValue($program);
        $year_level = $this->escapeValue($year_level);
        $result = array();

        $query = "select id, code, description, program, year_level, file_dir from subjects where program=? and year_level=? order by program, year_level, code;";
        $stmt = $this->con->stmt_init();
        if ($stmt->prepare($query)) {
            $stmt->bind_param("si", $program, $year_level);
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
}
