<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
//use AppBundle\Entity\Offices;

class AjaxController extends Controller
{
    /**
     * @Route("/admin/ajax", name="admin_ajax", options={"expose"=true})
     */
    public function deleteAjaxAction(Request $request)
    {
//        $id=$request->request->get('imie');
        $id = $request->request->all();

        if($request->request->get('choice')=='del')
        {
            $id['del']=true;
        }

        if($request->request->get('choice')=='add')
        {
            $id['add']=true;
        }

        return new JsonResponse($id);
    }

    /**
     * @Route("/grid", name="grid")
     */
    public function gridAction()
    {
        return $this->render(':admin:grid.html.twig');
    }

}