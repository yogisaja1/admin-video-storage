<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function addData()
    {
        $photo_profile = $this->request->getFile('profile');
        if ($photo_profile->isValid() && !$photo_profile->hasMoved()) {
            // rubah nama video video menjadi random pada codeigniter
            $newName = $photo_profile->getRandomName();
            // pindahkan video video ke folder video
            $photo_profile->move('img', $newName);
            $path_profile = base_url('img') . '/' . $newName;
        } else {
            $path_profile = '';
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email'),
            'path_image' => $path_profile,
        ];

        $this->userModel->insert($data);
        return redirect()->to(base_url('user/user'));
    }

    public function delete($id)
    {

        // buat alert apakah yakin data di hapus jika iya maka akan di hapus jika tidak maka tidak akan di hapus
        if (session()->get('id_user') == $id) {
            session()->setFlashdata('pesan', 'Tidak bisa menghapus akun sendiri');
            return redirect()->to(base_url('user/user'));
        }

        // ambil path image
        // jika user tidak memiliki foto maka akan mengembalikan nilai null
        if ($this->userModel->getPathImage($id)->path_image == null) {
            $this->userModel->deleteUser($id);
            return redirect()->to(base_url('user/user'));
        }

        $locate = $this->userModel->getPathImage($id);
        $pos = strpos($locate->path_image, "img/");
        $path_image = substr($locate->path_image, $pos + 4);
        unlink('img/' . $path_image);
        $result = $this->userModel->deleteUser($id);
        if ($result) {
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('pesan', 'Data gagal dihapus');
        }
        return redirect()->to(base_url('user/user'));
    }

    public function update()
    {
        $id = $this->request->getVar('id_user');
        $photo_profile = $this->request->getFile('profile');
        if ($photo_profile->isValid() && !$photo_profile->hasMoved()) {
            // hapus photo lama
            $path_profile = $this->userModel->getPathImage($id);
            $pos = strpos($path_profile->path_image, "img/");
            $path_image = substr($path_profile->path_image, $pos + 4);
            unlink('img/' . $path_image);

            $newName = $photo_profile->getRandomName();
            $photo_profile->move('img', $newName);
            $path_profile = base_url('img') . '/' . $newName;
        } else {
            $path_profile = $this->userModel->getPathImage($id);
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email'),
            'path_image' => $path_profile,
        ];
        $this->userModel->update($id, $data);
        return redirect()->to(base_url('user/user'));
    }
}
