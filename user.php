<?php

include_once 'db-connect.php';

class User
{

    private $db;

    private $db_table = "users";


    public function __construct()
    {
        //$this->db = new DbConnect();
    }

    /*

        public function isEmailUsernameExist($username, $email)
        {

            $query = "select * from " . $this->db_table . " where username = '$username' AND email = '$email'";

            $result = mysqli_query($this->db->getDb(), $query);

            if (mysqli_num_rows($result) > 0) {

                mysqli_close($this->db->getDb());

                return true;

            }

            return false;

        }

        public function isValidEmail($email)
        {
            return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        }

        public function createNewRegisterUser($username, $password, $email)
        {

            $isExisting = $this->isEmailUsernameExist($username, $email);

            if ($isExisting) {

                $json['success'] = 0;
                $json['message'] = "Error in registering. Probably the username/email already exists";
            } else {

                $isValid = $this->isValidEmail($email);

                if ($isValid) {
                    $query = "insert into " . $this->db_table . " (username, password, email, created_at, updated_at) values ('$username', '$password', '$email', NOW(), NOW())";

                    $inserted = mysqli_query($this->db->getDb(), $query);

                    if ($inserted == 1) {

                        $json['success'] = 1;
                        $json['message'] = "Successfully registered the user";

                    } else {

                        $json['success'] = 0;
                        $json['message'] = "Error in registering. Probably the username/email already exists";

                    }

                    mysqli_close($this->db->getDb());
                } else {
                    $json['success'] = 0;
                    $json['message'] = "Error in registering. Email Address is not valid";
                }

            }

            return $json;

        }
    */
    public function login($email, $password)
    {
        $json = array();

        $emailExist = $this->emailExist($email);

        if ($emailExist) {

            $isPasswordCorrect = $this->isPasswordCorrect($email, $password);

            if ($isPasswordCorrect) {
                $json['success'] = 1;
                $json['message'] = LOGIN_SUCCESSFUL;
            } else {
                $json['success'] = 0;
                $json['message'] = INCORRECT_PASSWORD;
            }
        } else {
            $json['success'] = 0;
            $json['message'] = EMAIL_NOT_FOUND;
        }


        return $json;
    }

    public function register($name, $email, $contactNo, $password)
    {
        $json = array();

        $emailExist = $this->emailExist($email);
        if ($emailExist) {
            $json['success'] = 0;
            $json['message'] = EMAIL_ALREADY_EXIST;
            return $json;
        }

        $this->db = new DBConnect();

        $query = "insert into " . $this->db_table . " (name,email,contact_no,password) values ('" . $name . "','" . $email . "','" . $contactNo . "','" . $password . "')";

        $inserted = mysqli_query($this->db->getDb(), $query);

        mysqli_close($this->db->getDb());

        if ($inserted == 1) {
            $json['success'] = 1;
            $json['message'] = REGISTRATION_SUCCESS;
            return $json;
        } else {
            $json['success'] = 0;
            $json['message'] = REGISTRATION_ERROR;
            return $json;
        }
    }

    private function emailExist($email)
    {
        $this->db = new DBConnect();

        $query = "select * from " . $this->db_table . " where email = '" . $email . "' Limit 1";

        $result = mysqli_query($this->db->getDb(), $query);

        if (mysqli_num_rows($result) > 0) {

            mysqli_close($this->db->getDb());

            return true;

        }

        mysqli_close($this->db->getDb());

        return false;
    }

    public function isPasswordCorrect($email, $password)
    {
        $this->db = new DBConnect();

        $query = "select * from " . $this->db_table . " where email = '" . $email . "' AND password = '" . $password . "' Limit 1";

        $result = mysqli_query($this->db->getDb(), $query);

        if (mysqli_num_rows($result) > 0) {

            mysqli_close($this->db->getDb());

            return true;

        }

        mysqli_close($this->db->getDb());

        return false;

    }


}

?>