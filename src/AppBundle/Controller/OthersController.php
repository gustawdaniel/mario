<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Others;
use AppBundle\Form\OthersType;

/**
 * Others controller.
 *
 * @Route("/crud/others")
 */
class OthersController extends Controller
{
    /**
     * Lists all Others entities.
     *
     * @Route("/", name="crud_others_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $others = $em->getRepository('AppBundle:Others')->findAll();

        return $this->render('others/index.html.twig', array(
            'others' => $others,
        ));
    }

    /**
     * Creates a new Others entity.
     *
     * @Route("/new", name="crud_others_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $other = new Others();
        $form = $this->createForm('AppBundle\Form\OthersType', $other);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($other);
            $em->flush();

            return $this->redirectToRoute('crud_others_show', array('id' => $others->getId()));
        }

        return $this->render('others/new.html.twig', array(
            'other' => $other,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Others entity.
     *
     * @Route("/{id}", name="crud_others_show")
     * @Method("GET")
     */
    public function showAction(Others $other)
    {
        $deleteForm = $this->createDeleteForm($other);

        return $this->render('others/show.html.twig', array(
            'other' => $other,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Others entity.
     *
     * @Route("/{id}/edit", name="crud_others_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Others $other)
    {
        $deleteForm = $this->createDeleteForm($other);
        $editForm = $this->createForm('AppBundle\Form\OthersType', $other);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($other);
            $em->flush();

            return $this->redirectToRoute('crud_others_edit', array('id' => $other->getId()));
        }

        return $this->render('others/edit.html.twig', array(
            'other' => $other,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Others entity.
     *
     * @Route("/{id}", name="crud_others_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Others $other)
    {
        $form = $this->createDeleteForm($other);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($other);
            $em->flush();
        }

        return $this->redirectToRoute('crud_others_index');
    }

    /**
     * Creates a form to delete a Others entity.
     *
     * @param Others $other The Others entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Others $other)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crud_others_delete', array('id' => $other->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
