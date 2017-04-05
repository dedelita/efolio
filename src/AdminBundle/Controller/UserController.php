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

                    $formations = $this->forward('AppBundle:Folio:getFormations', array("idUser" => $user->getId()));
                    $session->set("formations", $formations);

                    $experiences = $this->forward('AppBundle:Folio:getExperiences', array("idUser" => $user->getId()));
                    $session->set("experiences", $experiences);

                    $competences = $this->forward('AppBundle:Folio:getCompetences', array("idUser" => $user->getId()));
                    $session->set("competences", $competences);

                    $projets = $this->forward('AppBundle:Folio:getProjets', array("idUser" => $user->getId()));
                    $session->set("projets", $projets);

                    $recommandations = $this->forward('AppBundle:Folio:getRecommandations', array("idUser" => $user->getId()));
                    $session->set("recommandations", $recommandations);

                    $publications = $this->forward('AppBundle:Folio:getPublications', array("idUser" => $user->getId()));
                    $session->set("publications", $publications);
                    

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