<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

///**
// * @Route("/admin")
// */
class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        return $this->render(':admin:index.html.twig');
    }

//    USUNĄĆ!!!!!!!!!!!1
    /**
     * @Route("/admin/edit/{entity}", name="edit")
     */
    public function editAction($entity)
    {
        return $this->render(':admin:edit.html.twig', array('entity'=>$entity));
    }



    /**
     * @Route("/admin/offices", name="offices")
     */
    public function officesAction()
    {
        $entity = $this->getDoctrine()->getRepository('AppBundle:Offices')->findAll();

        return $this->render(':admin:table.html.twig', array('entity'=>$entity));
    }
}