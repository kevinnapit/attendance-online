<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    { // Check if the current URL is 'admin2045/login'
        $currentURL = $request->uri->getPath();
        // print_r($currentURL);die();
        if (!session()->get('admin_username') && ($currentURL !== '/admin2011/login' && $currentURL !== '/admin2011/lupapassword' && $currentURL !== '/admin2045/resetpassword')) {
            return redirect()->to('admin2011/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
