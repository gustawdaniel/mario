<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Surfaces;
use AppBundle\Form\SurfacesType;

/**
 * Surfaces controller.
 *
 * @Route("/crud/surfaces")
 */
class SurfacesController extends Controller
{
    /**
     * Lists all Surfaces entities.
     *
     * @Route("/", name="crud_surfaces_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $surfaces = $em->getRepository('AppBundle:Surfaces')->findAll();

        return $this->render('surfaces/index.html.twig', array(
            'surfaces' => $surfaces,
        ));
    }

    /**
     * Creates a new Surfaces entity.
     *
     * @Route("/new", name="crud_surfaces_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $surface = new Surfaces();
        $form = $this->createForm('AppBundle\Form\SurfacesType', $surface);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($surface);
            $em->flush();

            return $this->redirectToRoute('crud_surfaces_show', array('id' => $surfaces->getId()));
        }

        return $this->render('surfaces/new.html.twig', array(
            'surface' => $surface,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Surfaces entity.
     *
     * @Route("/{id}", name="crud_surfaces_show")
     * @Method("GET")
     */
    public function showAction(Surfaces $surface)
    {
        $deleteForm = $this->createDeleteForm($surface);

        return $this->render('surfaces/show.html.twig', array(
            'surface' => $surface,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Surfaces entity.
     *
     * @Route("/{id}/edit", name="crud_surfaces_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Surfaces $surface)
    {
        $deleteForm = $this->createDeleteForm($surface);
        $editForm = $this->createForm('AppBundle\Form\SurfacesType', $surface);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($surface);
            $em->flush();

            return $this->redirectToRoute('crud_surfaces_edit', array('id' => $surface->getId()));
        }

        return $this->render('surfaces/edit.html.twig', array(
            'surface' => $surface,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Surfaces entity.
     *
     * @Route("/{id}", name="crud_surfaces_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Surfaces $surface)
    {
        $form = $this->createDeleteForm($surface);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($surface);
            $em->flush();
        }

        return $this->redirectToRoute('crud_surfaces_index');
    }

    /**
     * Creates a form to delete a Surfaces entity.
     *
     * @param Surfaces $surface The Surfaces entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Surfaces $surface)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crud_surfaces_delete', array('id' => $surface->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
