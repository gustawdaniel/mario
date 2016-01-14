<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Phones;
use AppBundle\Form\PhonesType;

/**
 * Phones controller.
 *
 * @Route("/crud/phones")
 */
class PhonesController extends Controller
{
    /**
     * Lists all Phones entities.
     *
     * @Route("/", name="crud_phones_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $phones = $em->getRepository('AppBundle:Phones')->findAll();

        return $this->render('phones/index.html.twig', array(
            'phones' => $phones,
        ));
    }

    /**
     * Creates a new Phones entity.
     *
     * @Route("/new", name="crud_phones_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $phone = new Phones();
        $form = $this->createForm('AppBundle\Form\PhonesType', $phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($phone);
            $em->flush();

            return $this->redirectToRoute('crud_phones_show', array('id' => $phones->getId()));
        }

        return $this->render('phones/new.html.twig', array(
            'phone' => $phone,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Phones entity.
     *
     * @Route("/{id}", name="crud_phones_show")
     * @Method("GET")
     */
    public function showAction(Phones $phone)
    {
        $deleteForm = $this->createDeleteForm($phone);

        return $this->render('phones/show.html.twig', array(
            'phone' => $phone,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Phones entity.
     *
     * @Route("/{id}/edit", name="crud_phones_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Phones $phone)
    {
        $deleteForm = $this->createDeleteForm($phone);
        $editForm = $this->createForm('AppBundle\Form\PhonesType', $phone);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($phone);
            $em->flush();

            return $this->redirectToRoute('crud_phones_edit', array('id' => $phone->getId()));
        }

        return $this->render('phones/edit.html.twig', array(
            'phone' => $phone,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Phones entity.
     *
     * @Route("/{id}", name="crud_phones_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Phones $phone)
    {
        $form = $this->createDeleteForm($phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($phone);
            $em->flush();
        }

        return $this->redirectToRoute('crud_phones_index');
    }

    /**
     * Creates a form to delete a Phones entity.
     *
     * @param Phones $phone The Phones entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Phones $phone)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crud_phones_delete', array('id' => $phone->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
