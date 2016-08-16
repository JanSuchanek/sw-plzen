<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("AppBundle:default:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need7
        $form = $this->getContactForm();
        return $params = [
            'form' => $form->createView(),
        ];
    }

    public function getContactForm()
    {
        $contact = new \AppBundle\Entity\Contact;
        return $this->createFormBuilder($contact)
            ->setAction($this->generateUrl('save'))
            ->add('name', TextType::class)
            ->add('email', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();
    }

    /**
     * @Route("/save", name="save")
     * @Template("AppBundle:default:index.html.twig")
     */
    public function saveAction(Request $request)
    {
        $form = $this->getContactForm();
        $form->handleRequest($request);

        if(!$form->isSubmitted() || ! $form->isValid()){
            return $params = [
                'form' => $form->createView(),
            ];
            //return $this->render("AppBundle:default:index.html.twig", $params);
        }

        $contact = $form->getData();
        $this->get("business.contact")->save($contact);
        return $this->redirectToRoute("done");
        //return new Response('OK');

    }

    /**
     * @Route("/done", name="done")
     * @Template("AppBundle:default:done.html.twig")
     */
    public function doneAction()
    {
        return $params = [
            'all' => $this->get("business.contact")->findAll(),
        ];

    }

    /**
     * @Route("/delete", name="delete")
     * @Template("AppBundle:default:index.html.twig")
     */
    public function deleteAction()
    {

    }
}
