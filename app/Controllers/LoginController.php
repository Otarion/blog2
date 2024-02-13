<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    public function showLoginForm(): Response
    {
        return $this->view('login.html');
    }

    public function login(Request $request): void {

        // $this->request->request->all() est un tableau contenant les données de formulaires soumis avec une méthode POST
$validated = $this->request->validate($this->request->request->all(), [

    'email' => ['required', 'email'], // Champ requis au format e-mail
    'password' => ['required'], // Champ requis
], $this->session);

// On stocke toutes les valeurs du formulaire dans la variable de session flash "old"
$this->session->getFlashBag()->set('old', $this->request->request->all());

// On créé une erreur pour que mon utilisateur sache que ces identifiants sont erronés
$this->session->getFlashBag()->set('errors', [
    'email' => ['Identifiants erronés'], // L'erreur sera affichée sur le champ e-mail
]);
    }
}
