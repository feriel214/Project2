<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AdminContactController extends AbstractController
{
    /**
     * @Route("/admin/contact", name="admin_contact")
     */
    public function index()
    {
        return $this->render('admin_contact/index.html.twig', [
            'controller_name' => 'AdminContactController'
        ]);
    }
    /**
     * @Route("/listcontact", name="list_contact")
     */
    public function listContact()
    {
        $contacts = $this->getDoctrine()
            ->getRepository(Contact::class)
            ->findAll();
        return $this->render('admin/list_contact.html.twig', [
            'contact' => $contacts
        ]);
    }
    /**
     * @Route("/delete/contact/{id}", name="delete_contact")
     * @Method({"DELETE"})
     */
    public function deleteContact($id)
    {
        $contact = $this->getDoctrine()
            ->getRepository(Contact::class)
            ->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($contact);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'Cette contact  a été supprimer  avec succées'
        );
        return $this->redirectToRoute('list_contact');
    }
}
