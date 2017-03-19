<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    public function subscribe(Request $request) {
        $email = $request->get("email");
        $password = $request->get("password");
        $conf_password = $request->get("conf_password");
        $firstname = $request->get("firstname");
        $lastname = $request->get("lastname");
        $age = $request->get("age");

        //vérification pas déjà enregistré (etc)
        if($password == $conf_password) {
            new User($email, $password, $firstname, $lastname, $age);

            $session = new Session();
            $session->start();
            $session->set('firstname', $firstname);
            $session->set('lastname', $lastname);

            return $this->render('AdminBundle::efolio.html.twig', array("session" => $session));
        }
        return false;
    }

    public function login(Request $request) {
        $email = $request->get("email");
        $password = $request->get("password");

        $userRepo = $this->getDoctrine()->getRepository('AppBundle:User');
        $user = $userRepo->findByEmail($email);

        if(!$user) {
            return false;
        } else {
            if ($user->getPassword() == sha1($password)) {
                $session = new Session();
                $session->start();
                $session->set('firstname', $user->getFirstname());
                $session->set('lastname', $user->getLastname());
                return $this->render('AdminBundle::efolio.html.twig', array("session" => $session));
            }
        }
        return false;
    }
}