<?php

namespace AdminBundle\Controller;

use AppBundle\AppBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    public function doAction(Request $request)
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('nom', TextType::class, array('label' => "Nom : "))
            ->add('prenom', TextType::class, array('label' => "Prénom : "))
            ->add('age', IntegerType::class, array('label' => "Age : "))
            ->add('email', EmailType::class, array('label' => "Email : "))
            ->add('password', PasswordType::class, array('label' => "Mot de passe : "))
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(sha1($request->get("password")));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->login($request);
        }

        return $this->render('AdminBundle::connexion.html.twig', array('form' => $form->createView()));
        /*
         *
         {{ form_start(form) }}
         {{ form_widget(form) }}
         {{ form_end(form) }}

         * */

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
                    $session->set('user', serialize($user));

                    return $this->render('AdminBundle::efolio.html.twig', array("session" => $session));
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