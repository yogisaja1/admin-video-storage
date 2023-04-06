<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\VideoModel;
use App\Models\CategoryModel;

class User extends BaseController
{

    // buat constructor
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->videoModel = new VideoModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        // jika session logged_in bernilai adalah admin maka akan diarahkan ke halaman admin
        if (session('logged_in') == 'admin' || session('logged_in') == 'super_admin') {
            return redirect()->to(base_url('user/dashboard'));
        }
        return view('admin/login_view');
    }

    public function dashboard()
    {
        // jika tidak ada sesi login maka di forward ke login
        if (!session('logged_in')) {
            return redirect()->to('index');
        }

        $data['video'] = $this->videoModel->countAll();
        $data['kategory'] = $this->categoryModel->countAll();

        // //  dapatkan session username
        $data['username'] = session()->get('username');

        $data['status'] = 'dashboard';
        $data['page'] =  view('admin/dashboard_view', $data);

        return view('admin/homepage_view', $data);
    }

    public function category()
    {
        $data['status'] = 'category';

        //  dapatkan session username
        $data['username'] = session()->get('username');

        $data['categorys'] = $this->categoryModel->getCategory();

        $data['page'] =  view('admin/category_view', $data);
        return view('admin/homepage_view', $data);
    }

    public function video()
    {
        $data['status'] = 'video';
        //  dapatkan session username
        $data['username'] = session()->get('username');

        $data['videos'] = $this->videoModel->findAll();
        $data['category'] = $this->videoModel->getCategory();

        $data['page'] =  view('admin/video_view', $data);
        return view('admin/homepage_view', $data);
    }

    public function profile()
    {
        $data['status'] = 'profile';
        //  dapatkan session username
        $data['username'] = session()->get('username');

        $data['profile'] = $this->userModel->getUserById(session()->get('id_user'));

        $data['page'] =  view('admin/profile_view', $data);
        return view('admin/homepage_view', $data);
    }

    public function user()
    {
        if (session('logged_in') != 'super_admin') {
            // error 404 file not found
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $data['status'] = 'user';
            $data['users'] = $this->userModel->getAdmin();
            $data['username'] = session()->get('username');
            $data['page'] = view('admin/user_view', $data);
            return view('admin/homepage_view', $data);
        }
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = [
            'username' => $username,
        ];

        $cek = $this->userModel->cek_login('users', $data);

        $logged_in = $cek->getFirstRow();

        // jika tidak ada username
        if ($logged_in == null) {
            session()->setFlashdata('salah', 'Username atau Password Salah');
            return redirect()->to(base_url('/'));
        }

        if (!password_verify($password, $logged_in->password)) {
            if ($logged_in != null) {
                if ($logged_in->role == "admin") {
                    session()->set('logged_in', 'admin');
                    session()->set('username', $username);
                    session()->set('path_image', $logged_in->path_image);
                    session()->set('id_user', $logged_in->id_user);
                    $this->userModel->update($logged_in->id_user, ['last_login' => date('Y-m-d H:i:s')]);
                    return redirect()->to('dashboard');
                } else {
                    session()->set('logged_in', 'super_admin');
                    session()->set('username', $username);
                    session()->set('id_user', $logged_in->id_user);
                    session()->set('path_image', $logged_in->path_image);
                    $this->userModel->update($logged_in->id_user, ['last_login' => date('Y-m-d H:i:s')]);
                    return redirect()->to('dashboard');
                }
            }
        } else {
            session()->setFlashdata('salah', 'Username atau Password Salah');
            return redirect()->to(base_url('/'));
        }
    }

    public function updateProfile()
    {
        $id_user = session()->get('id_user');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $password2 = $this->request->getPost('passwordconfirmation');
        $email = $this->request->getPost('email');
        $name = $this->request->getPost('fullname');
        $photo = $this->request->getFile('photo');

        // jika username telah di gunakan maka munculkan flashdata username telah di gunakan
        if ($this->userModel->cekUsername($username, $id_user)) {
            session()->setFlashdata('username', 'Username telah di gunakan');
            return redirect()->to('user/profile');
        }

        // jika email telah di gunakan maka munculkan flashdata email telah di gunakan
        if ($this->userModel->cekEmail($email, $id_user)) {
            session()->setFlashdata('email', 'Email telah di gunakan');
            return redirect()->to('user/profile');
        }

        // jika password tidak sama maka munculkan flashdata password tidak sama
        if ($password != $password2) {
            session()->setFlashdata('password', 'Password tidak sama');
            return redirect()->to('user/profile');
        }

        // jika photo tidak kosong maka upload photo
        if ($photo->isValid() && !$photo->hasMoved()) {
            $path_profile = $this->userModel->getPathImage($id_user);
            $pos = strpos($path_profile->path_image, "img/");
            $path_image = substr($path_profile->path_image, $pos + 4);
            unlink('img/' . $path_image);

            $newName = $photo->getRandomName();
            $photo->move('img', $newName);
            $path_profile = base_url('img') . '/' . $newName;
        } else {
            $path_profile = session()->get('path_image');
        }

        // update data user
        $this->userModel->update($id_user, [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'email' => $email,
            'name' => $name,
            'path_image' => $path_profile,
        ]);

        // update session
        session()->set('username', $username);
        session()->set('path_image', $path_profile);

        // pindah ke halaman profile
        return redirect()->to('profile');
    }

    public function logout()
    {
        // hapus semua session
        session()->destroy();
        // pindahkan ke halaman login
        return redirect()->to('index');
    }
}
