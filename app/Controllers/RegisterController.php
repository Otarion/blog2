<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use MVC\Request;
use MVC\Twig;

class RegisterController extends Controller
{
    public function __construct(
        Request $request,
        Response $response,
        Twig $twig,
        Session $session,
    ) {
        parent::__construct($request, $response, $twig, $session);
    }
    public function showRegisterForm(): Response
    {
        return $this->view('register.html');
    }

    public function register(Request $request): Response
{
    // Récupérer toutes les requêtes de données
    $data = $request->request->all();

    // Définir les règles de validation
    $rules = [
        'email' => ['required', 'email'],
        'password' => ['required', 'min:8'], // Min. 8 caractères selon les recommandations de l'ANSSI
    ];

    // Valider la requête de données
    $validator = $this->request->validate($data, $rules);

    // Sila validation échoue, redirige vers le formulaire d'enregistrement
    if (!$validator->passes()) {
        return $this->redirectToRoute('register_form');
    }

    // Hache le mot de passe
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

    // Créer un  nouveau user avec le hachage de mot de passe
    // Le replace avec l'ascuel model de logique de création de l'user
    $newUser = new User([
        'email' => $data['email'],
        'password' => $hashedPassword,
    ]);

    //Enregistre le nouvel utilisateur dans la bdd
    $newUser->save();

    // Connecter le nouvel user
    $this->session->set('user_id', $newUser->getId());

    // Rediriger l'utilisateur vers la page de compte
    return $this->redirectToRoute('account_page');
}
}