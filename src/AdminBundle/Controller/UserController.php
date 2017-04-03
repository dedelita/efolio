<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();

        return $this->render("AdminBundle::informationsPersonnelles.html.twig", array("user" => $session));
    }

    public function connexionAction(Request $request)
    {
        $erreur = null;

        if ($request->get("email")) {
            $email = $request->get("email");
            $password = $request->get("password");

            $userRepo = $this->getDoctrine()->getRepository('AppBundle:User');
            $user = $userRepo->findOneByEmail($email);

            if ($user) {
                if ($user->getPassword() == sha1($password)) {
                    $session = new Session();

                    if ($session->isStarted())
                        $session->start();
                    
                    $session->set("id", $user->getId());
                    $session->set("nom", $user->getNom());
                    $session->set("prenom", $user->getPrenom());
                    $session->set("dateNaissance", $user->getDateNaissance());
                    $session->set("permis", $user->getPermis());
                    $session->set("email", $user->getEmail());

                   return $this->redirect($this->generateUrl('admin_formations'));
                } else
                    $erreur = "Mauvais mot de passe !";
            } else
                $erreur = "Pas d'utilisateur trouvé !";
        }

        return $this->render("AdminBundle::connexion.html.twig", array("erreur" => $erreur));
    }

    public function deconnexionAction(Request $request)
    {
        $session = $request->getSession();
        $session->invalidate();

        return $this->redirect($this->generateUrl('efolio'));
    }
}