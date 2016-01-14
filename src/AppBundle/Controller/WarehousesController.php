<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Warehouses;
use AppBundle\Form\WarehousesType;

/**
 * Warehouses controller.
 *
 * @Route("/crud/warehouses")
 */
class WarehousesController extends Controller
{
    /**
     * Lists all Warehouses entities.
     *
     * @Route("/", name="crud_warehouses_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $warehouses = $em->getRepository('AppBundle:Warehouses')->findAll();

        return $this->render('warehouses/index.html.twig', array(
            'warehouses' => $warehouses,
        ));
    }

    /**
     * Creates a new Warehouses entity.
     *
     * @Route("/new", name="crud_warehouses_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $warehouse = new Warehouses();
        $form = $this->createForm('AppBundle\Form\WarehousesType', $warehouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($warehouse);
            $em->flush();

            return $this->redirectToRoute('crud_warehouses_show', array('id' => $warehouses->getId()));
        }

        return $this->render('warehouses/new.html.twig', array(
            'warehouse' => $warehouse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Warehouses entity.
     *
     * @Route("/{id}", name="crud_warehouses_show")
     * @Method("GET")
     */
    public function showAction(Warehouses $warehouse)
    {
        $deleteForm = $this->createDeleteForm($warehouse);

        return $this->render('warehouses/show.html.twig', array(
            'warehouse' => $warehouse,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Warehouses entity.
     *
     * @Route("/{id}/edit", name="crud_warehouses_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Warehouses $warehouse)
    {
        $deleteForm = $this->createDeleteForm($warehouse);
        $editForm = $this->createForm('AppBundle\Form\WarehousesType', $warehouse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($warehouse);
            $em->flush();

            return $this->redirectToRoute('crud_warehouses_edit', array('id' => $warehouse->getId()));
        }

        return $this->render('warehouses/edit.html.twig', array(
            'warehouse' => $warehouse,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Warehouses entity.
     *
     * @Route("/{id}", name="crud_warehouses_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Warehouses $warehouse)
    {
        $form = $this->createDeleteForm($warehouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($warehouse);
            $em->flush();
        }

        return $this->redirectToRoute('crud_warehouses_index');
    }

    /**
     * Creates a form to delete a Warehouses entity.
     *
     * @param Warehouses $warehouse The Warehouses entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Warehouses $warehouse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crud_warehouses_delete', array('id' => $warehouse->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
