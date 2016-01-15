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
     * @Route("/admin/delete", name="admin_delete", options={"expose"=true})
     */
    public function deleteAjaxAction(Request $request)
    {
//        $data = $request->request->all();



        return new JsonResponse(array('a'=>'b'));
    }

}