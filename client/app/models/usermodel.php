
<?php

class usermodel extends DModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insertUser($email, $password, $create_at, $time)
    {
        $sql = "INSERT INTO users SET email=?,password=?,create_at=?,time=?";
        return $this->db->pdo_execute($sql, $email, $password, $create_at, $time);
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email=? AND password=? ";
        return $this->db->pdo_query_one($sql, $email, $password);
    }

    public function getUserBySession($email)
    {
        $sql = "SELECT * FROM users WHERE email=?";
        return $this->db->pdo_query_one($sql, $email);
    }

    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE username=?";
        return $this->db->pdo_query_one($sql, $username);
    }

    public function updateProfile($username, $fullname, $phone, $sex, $date_of_birth, $token)
    {
        if ($username) {
            $sql = "UPDATE users SET username=?, fullname=?, phone=?, sex=?, date_of_birth=? WHERE email=?";
            return $this->db->pdo_execute($sql, $username, $fullname, $phone, $sex, $date_of_birth, $token);
        } else {
            $sql = "UPDATE users SET fullname=?, phone=?, sex=?, date_of_birth=? WHERE email=?";
            return $this->db->pdo_execute($sql, $fullname, $phone, $sex, $date_of_birth, $token);
        }
    }

    public function editPassword($token, $new_password)
    {
        $sql = "UPDATE users SET password=? WHERE email=?";
        return $this->db->pdo_execute($sql, $new_password, $token);
    }

    public function selectAddress($id_user)
    {
        $sql = "SELECT * FROM address WHERE id_user=?";
        return $this->db->pdo_query($sql, $id_user);
    }

    public function selectAddressById($id_address)
    {
        $sql = "SELECT * FROM address WHERE id_address=?";
        return $this->db->pdo_query_one($sql, $id_address);
    }

    public function addressDefault($id_user)
    {
        $sql = "SELECT * FROM address WHERE id_user=? AND address_default =1";
        return $this->db->pdo_query_one($sql, $id_user);
    }

    public function addAddress($fullname, $phone, $city, $district, $ward, $detail, $address_default = 0, $id_user, $create_at, $time)
    {
        $sql = "INSERT INTO address SET fullname=?,phone=?,city=?,district=?,ward=?,detail=?,address_default=?,id_user=?,create_at=?,time=?";
        return $this->db->pdo_execute($sql, $fullname, $phone, $city, $district, $ward, $detail, $address_default, $id_user, $create_at, $time);
    }

    public function updateAddress($fullname, $phone, $city, $district, $ward, $detail, $address_default, $id_address, $id_user)
    {
        if ($address_default == 1) {
            $sql = "UPDATE address SET address_default=? WHERE id_user=?";
            $this->db->pdo_execute($sql, 0, $id_user);
        }
        $sql = "UPDATE address SET fullname=?,phone=?,city=?,district=?,ward=?,detail=?,address_default=? WHERE id_address=? AND id_user=?";
        return $this->db->pdo_execute($sql, $fullname, $phone, $city, $district, $ward, $detail, $address_default, $id_address, $id_user);
    }

    public function deleteAddress($id_address, $id_user)
    {
        $sql = "DELETE FROM address WHERE id_address=? AND id_user=?";
        $this->db->pdo_execute($sql, $id_address, $id_user);
    }
}



?>

