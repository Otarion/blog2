<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function showLoginForm(): Response
    {
        return $this->view('login.html');
    }
}
