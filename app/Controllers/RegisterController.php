<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function showRegisterForm(): Response
    {
        return $this->view('register.html');
    }
}
