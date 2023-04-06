<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UsersLoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //    jika yang login bukan admin atau super admin maka akan diarahkan ke halaman login
        if (session('logged_in') != 'admin' && session('logged_in') != 'super_admin') {
            return redirect()->to('/');
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
