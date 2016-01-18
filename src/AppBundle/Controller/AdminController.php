<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Content;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        return $this->render(':admin:index.html.twig');
    }

    /**
     * @Route("/admin/table/{kind}", name="table")
     */
    public function tableAction($kind)
    {

        $content=$this->getDoctrine()->getRepository('AppBundle:Content')->findBy(array('kind'=>$kind));

        return $this->render(':admin:table.html.twig',array('content'=>$content,'kind'=>$kind));
    }

    /**
     * @Route("/admin/table/{kind}/delete/{id}", name="delete_content")
     */
    public function deleteContentAction($kind, $id)
    {
        $content=$this->getDoctrine()->getRepository('AppBundle:Content')->findOneBy(array(
            'kind' => $kind,
            'id' => $id
        ));

        $em = $this->getDoctrine()->getManager();
        $em->remove($content);
        $em->flush();

        return $this->redirect($this->generateUrl('admin') . '#'.$kind);
    }

    /**
     * @Route("/admin/table/{kind}/add", name="add_content")
     */
    public function addContentAction($kind, Request $request)
    {
        $content = new Content();
        $content->setKind($kind);

        $form = $this->createFormBuilder($content)
            ->add('name',TextType::class,array('label' => 'Nazwa'))
            ->add('description',TextareaType::class,array('label' => 'Opis'))
            ->add('update',SubmitType::class,array('label' => 'Dodaj'))
            ->getForm();

        $form->handleRequest($request);


        if($form->isSubmitted())
        {
            $content->setKind($kind);

            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();

            return $this->redirect($this->generateUrl('admin') . '#'.$kind);
        }

        return $this->render(':admin:row.html.twig',array('form' => $form->createView(),'kind'=>$kind));

    }

    /**
     * @Route("/admin/table/{kind}/update/{id}", name="update_table")
     */
    public function updateContentAction($kind, $id, Request $request)
    {
        $content=$this->getDoctrine()->getRepository('AppBundle:Content')->findOneBy(array(
            'kind' => $kind,
            'id' => $id
        ));
        $name = $content->getName();

        $create = $this->createFormBuilder($content)
            ->add('name',TextType::class,array('label' => 'Nazwa'))
            ->add('description',TextareaType::class,array('label' => 'Opis'))
            ->add('update',SubmitType::class,array('label' => 'Aktualizuj'));


        if($kind=='desc'){
            $create->remove('name');

        }

        $form=$create->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $content->setKind($kind);

            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();

            return $this->redirect($this->generateUrl('admin') . '#'.$kind);
        }


//
        return $this->render(':admin:row.html.twig',array('form' => $form->createView(),'kind'=>$kind,'name'=>$name));
    }

    /**
     * @Route("/admin/messages", name="show_messages")
     */
    public function showMessagesAction()
    {
        $content=$this->getDoctrine()->getRepository('AppBundle:Message')->findAll();

        return $this->render(':admin:show_messages.html.twig',array('content' => $content));
    }

    /**
     * @Route("/admin/message/delete/{id}", name="delete_message")
     */
    public function deleteMessageAction($id)
    {
        $content=$this->getDoctrine()->getRepository('AppBundle:Message')->findOneBy(array(
            'id' => $id
        ));

        $em = $this->getDoctrine()->getManager();
        $em->remove($content);
        $em->flush();

        return $this->redirect($this->generateUrl('show_messages'));
    }

    /**
     * @Route("/admin/help", name="help")
     */
    public function helpAction()
    {
        return $this->render(':admin:help.html.twig');
    }

    /**
     * @Route("/admin/doc", name="doc")
     */
    public function docAction()
    {
        return $this->render(':admin:doc.html.twig');
    }
}