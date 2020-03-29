<?php

namespace App\Controller;

use App\Entity\Events;
use App\Entity\Comment;
use App\Entity\Contact;
use App\Form\CommentType;
use App\Form\ContactType;
use App\Entity\EventsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController'
        ]);
    }
    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('blog/about.html.twig', [
            'controller_name' => 'BlogController'
        ]);
    }
    /**
     * @Route("/causes", name="causes")
     */
    public function causes()
    {
        return $this->render('blog/causes.html.twig', [
            'controller_name' => 'BlogController'
        ]);
    }
    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function gallery()
    {
        return $this->render('blog/portfolio.html.twig', [
            'controller_name' => 'BlogController'
        ]);
    }
    /**
     * @Route("/news", name="blog_news")
     */
    public function news(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        //the 3 latest events
        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Events p
            ORDER BY p.id DESC
            '
        );
        $query->setMaxResults(3);
        //the 3 popular events RAND
        $q2 = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Events p
            ORDER BY p.id ASC
            '
        );
        $q2->setMaxResults(3);
        if (!$query->getResult() || !$q2->getResult()) {
            throw $this->createNotFoundException(
                'Aucun evenemnt trouvée trouvé  '
            );
        }
        //  return $this->redirectToRoute('comment_listcomment');

        return $this->render('blog/news.html.twig', [
            'event' => $query->getResult(),
            'popevent' => $q2->getResult()
        ]);
    }
    /**
     * @Route("/add/comment/{id}" , name="add_comment")
     */
    public function addComment(Request $request, Events $ev, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM App\Entity\Events p
            ORDER BY p.id DESC
            '
        );
        $query->setMaxResults(3);
        //the 3 popular events RAND
        $q2 = $em->createQuery(
            'SELECT p
            FROM App\Entity\Events p
            ORDER BY p.id ASC
            '
        );
        $q2->setMaxResults(3);
        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findBy(['events_id'=>$id]);
        $event = $this->getDoctrine()
            ->getRepository(Events::class)
            ->find($id);
        $comment = new Comment();
        $form1 = $this->createForm(CommentType::class, $comment);
        $form1->handleRequest($request);
        if ($form1->isSubmitted() && $form1->isValid()) {
            $comment->setCreatedAt(new \DateTime());
            $comment->setEvents($ev);
            $comment = $form1->getData();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('add_comment',['id' => $ev->getId()]);
        }

        return $this->render('blog/showEventComments.html.twig', [
            'events' => $event,
            'formco' => $form1->createView(),
            'formc' => $comments,
            'event' => $query->getResult(),
            'popevent' => $q2->getResult()
        ]);
    }
    /**
     * @Route("/edit/comment/{id}", name ="comment_edit")
     */
    public function editComment(Request $request, $id, Events $ev)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comment = new Comment();
        $comment = $entityManager->getRepository(Comment::class)->find($id);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime());
            $comment->setEvents($ev);
            $comment = $form1->getData();
            $em->persist($comment);
            $em->flush();
        }

        return $this->render('blog/showEventComments.html.twig', [
            'formco' => $form1->createView()
        ]);
    }
    /**
     * @Route("/delete/comment/{id}" , name="delete_comment")
     * * @Method({"DELETE"})
     */
    public function deleteComment($id)
    {
        $comment = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($comment);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'Votre écommentaire a été supprimer  avec succées'
        );
        return $this->redirectToRoute('add_comment',['id'=>$id ]);
    }

    /**
     * @Route("/testtest", name="test")
     */
    public function test()
    {
        return $this->render('contact/test.html.twig', [
            'controller_name' => 'BlogController'
        ]);
    }
    /**
     * @Route("/blogcontact", name="blogcontact")
     */
    public function contact(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
        $contact=$form->getData();
        $contact->setCreatedAt(new \DateTime());
        $em->persist($contact);
        $em->flush();
        $this->addFlash('success', 'Votre Message a été envoyeer avec succées');
        }
       
        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
