<?php

namespace App\Models;

use CodeIgniter\Model;


class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $allowedFields = ['username', 'password', 'last_login', 'email', 'name', 'role', 'path_image'];

    // Pengecekan Login
    public function cek_login($table, $data)
    {
        $db = db_connect();
        $query = $db->table($table)->getWhere($data);
        return $query;
    }

    public function getPassword($id)
    {
        $db = db_connect();
        $data = $db->query("SELECT password FROM users WHERE id_user = '" . $id . "'");
        return $data;
    }

    public function getPathImage($id)
    {
        $db = db_connect();
        $data = $db->query("SELECT path_image FROM users WHERE id_user = '" . $id . "'");
        return $data->getRow();
    }

    public function deleteUser($id)
    {
        $db = db_connect();
        $data = $db->query("DELETE FROM users WHERE id_user = '" . $id . "'");
        return $data;
    }

    public function getAdmin()
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM users WHERE role = 'admin'");
        return $data->getResultArray();
    }

    public function cekUsername($id, $username)
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM users WHERE id_user != '" . $id . "' AND username = '" . $username . "'");
        return $data->getRow();
    }

    // cek email
    public function cekEmail($id, $email)
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM users WHERE id_user != '" . $id . "' AND email = '" . $email . "'");
        return $data->getRow();
    }

    // get user by id
    public function getUserById($id)
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM users WHERE id_user = '" . $id . "'");
        return $data->getRow();
    }
}
