<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Offices;
use AppBundle\Form\OfficesType;

/**
 * Offices controller.
 *
 * @Route("/crud/offices")
 */
class OfficesController extends Controller
{
    /**
     * Lists all Offices entities.
     *
     * @Route("/", name="crud_offices_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offices = $em->getRepository('AppBundle:Offices')->findAll();

        return $this->render('offices/index.html.twig', array(
            'offices' => $offices,
        ));
    }

    /**
     * Creates a new Offices entity.
     *
     * @Route("/new", name="crud_offices_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $office = new Offices();
        $form = $this->createForm('AppBundle\Form\OfficesType', $office);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($office);
            $em->flush();

            return $this->redirectToRoute('crud_offices_show', array('id' => $office->getId()));
        }

        return $this->render('offices/new.html.twig', array(
            'office' => $office,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Offices entity.
     *
     * @Route("/{id}", name="crud_offices_show")
     * @Method("GET")
     */
    public function showAction(Offices $office)
    {
        $deleteForm = $this->createDeleteForm($office);

        return $this->render('offices/show.html.twig', array(
            'office' => $office,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Offices entity.
     *
     * @Route("/{id}/edit", name="crud_offices_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Offices $office)
    {
        $deleteForm = $this->createDeleteForm($office);
        $editForm = $this->createForm('AppBundle\Form\OfficesType', $office);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($office);
            $em->flush();

            return $this->redirectToRoute('crud_offices_edit', array('id' => $office->getId()));
        }

        return $this->render('offices/edit.html.twig', array(
            'office' => $office,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Offices entity.
     *
     * @Route("/{id}", name="crud_offices_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Offices $office)
    {
        $form = $this->createDeleteForm($office);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($office);
            $em->flush();
        }

        return $this->redirectToRoute('crud_offices_index');
    }

    /**
     * Creates a form to delete a Offices entity.
     *
     * @param Offices $office The Offices entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Offices $office)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crud_offices_delete', array('id' => $office->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
