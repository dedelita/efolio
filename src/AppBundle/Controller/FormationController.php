<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormationController extends Controller
{
    public function addFormation(Request $request) {
        $name = $request->get('name');
        $years = $request->get('years');
        $institute = $request->get('institute');


        $em = $this->getDoctrine()->getManager();

        $formation = new Formation($name, $years, $institute);
        $em->persist($formation);
        $em->flush();

        return new Response(true);
    }


    public function getFormationsAction() {
        $formationRepo = $this->getDoctrine()->getRepository('AppBundle:Formation');
        $formations = $formationRepo->findAll();
        
        return $this->render('AppBundle::formations.html.twig', array('formations' => $formations));
    }
}