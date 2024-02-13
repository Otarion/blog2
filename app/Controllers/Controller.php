<?php

namespace App\Controllers;

use MVC\Request;
use MVC\Twig;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class Controller
{
    protected Request $request;
    protected Response $response;
    protected Twig $twig;
    protected Session $session;

    public function __construct(
        Request $request,
        Response $response,
        Twig $twig,
        Session $session
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->twig = $twig;
        $this->session = $session;
    }

    public function view(string $template, array $data = []): Response
    {
        return $this->response->setContent(
            $this->twig->render($template, $data)
        );
    }
}