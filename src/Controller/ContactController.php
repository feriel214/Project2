<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
     /**
     * @Route("/addCon", name="add_contact")
     */
    public function addContact(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact->setCreatedAt(new \DateTime());
            $contact= $form->getData();
            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', 'Votre Message a été envoyeer avec succées');
        }
       
        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
