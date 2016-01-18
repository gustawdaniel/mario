<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $desc_tab = $this->getDoctrine()->getRepository('AppBundle:Content')->findBy(array(
            'kind' => 'desc'
        ));

        $desc=[];
        foreach($desc_tab as $d){
            $desc[$d->getName()] = $d->getDescription();
        }

        $office = $this->getDoctrine()->getRepository('AppBundle:Content')->findBy(array(
            'kind' => 'office'
        ));

        $square = $this->getDoctrine()->getRepository('AppBundle:Content')->findBy(array(
            'kind' => 'square'
        ));

        $warehouse = $this->getDoctrine()->getRepository('AppBundle:Content')->findBy(array(
            'kind' => 'warehouse'
        ));

        $other = $this->getDoctrine()->getRepository('AppBundle:Content')->findBy(array(
            'kind' => 'other'
        ));

        $tel = $this->getDoctrine()->getRepository('AppBundle:Content')->findBy(array(
            'kind' => 'tel'
        ));

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'desc' => $desc,
            'office' => $office,
            'square' => $square,
            'warehouse' => $warehouse,
            'other' => $other,
            'tel' => $tel
        ));
    }

    /**
     * @Route("/message", name="contact")
     */
    public function contactAction(Request $request)
    {

        $desc_tab = $this->getDoctrine()->getRepository('AppBundle:Content')->findBy(array(
            'kind' => 'desc'
        ));

        $desc=[];
        foreach($desc_tab as $d){
            $desc[$d->getName()] = $d->getDescription();
        }


        $message = new Message();

        $form = $this->createFormBuilder($message)
            ->add('name', TextType::class)
            ->add('mail', EmailType::class)
            ->add('message',TextareaType::class)
            ->add('submit',SubmitType::class, array('label' => 'Wyślij wiadomość'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->render('default/success.html.twig');
        }

        return $this->render('default/contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}