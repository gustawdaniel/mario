<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Offices;
use Symfony\Component\Form\Form;
use Ali\DatatableBundle\Util\Datatable;
use Symfony\Component\HttpFoundation\Response;
///**
// * @Route("/admin")
// */
class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction(Request $request)
    {
        $data = $request->request->all();

        return $this->render(':admin:index.html.twig',array('request',$data));
    }





    /**
     * @Route("/admin/offices", name="offices")
     */
    public function officesAction()
    {
        $entity = $this->getDoctrine()->getRepository('AppBundle:Offices')->findAll();


        return $this->render(':admin:table.html.twig', array('entity'=>$entity));
    }

    private function createDeleteForm(Offices $office)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crud_offices_delete', array('id' => $office->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}