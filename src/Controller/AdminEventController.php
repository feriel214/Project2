<?php

namespace App\Controller;

use App\Entity\Events;
use App\Form\EventType;
use App\Repository\EventsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminEventController extends AbstractController
{
    /**
     * @Route("/admin/event", name="admin_event")
     */
    public function index()
    {
        return $this->render('admin_event/index.html.twig', [
            'controller_name' => 'AdminEventController'
        ]);
    }
    /**
     * @Route("/listevent", name="listevent")
     */
    public function listEvent()
    {
        $events = $this->getDoctrine()
            ->getRepository(Events::class)
            ->findAll();
        return $this->render('admin/list_event.html.twig', [
            'events' => $events
        ]);
    }
    /**
     * @Route("/api/listevent", name="api_listevent", methods={"GET"})
     */
    public function apiListEvent(EventsRepository $eventsrepository)
    {
        return $this->json($eventsrepository->findAll(), 200, [], ['groups'=>'events:read']);
    }

    /**
     * @Route("/showevent/{id}", name="showevent")
     */
    public function showEvent($id)
    {
        $event = $this->getDoctrine()
            ->getRepository(Events::class)
            ->find($id);
        return $this->render('admin/event_show.html.twig', [
            'event' => $event
        ]);
    }
    /**
     * @Route("/api/show/event/{id}" , name="api_showevent",methods={"POST"})
     */
    public function apiShowEvent($id)
    {
        $event = $this->getDoctrine()
        ->getRepository(Events::class)
        ->find($id);
        return $this->json($event, 200, [], ['groups'=>'events:read']);

    }

    /**
     * @Route("/delete/event/{id}", name="delete_event")
     * @Method({"DELETE"})
     */
    public function deleteEvent($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $event = $this->getDoctrine()
            ->getRepository(Events::class)
            ->find($id);
        $entityManager->remove($event);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'Votre évenement a été supprimer  avec succées'
        );
        return $this->redirectToRoute('listevent');
    }
      /**
     * @Route("/api/delete/event/{id}", name="api_deleteevent" ,methods={"DELETE"})
     */
    public function apiDeleteEvent($id)
    {
        $event = $this->getDoctrine()
            ->getRepository(Events::class)
            ->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($event);
        $entityManager->flush();
        return new Response('ok');
    }
    /**
     * @Route("/editevent/{id}", name="editevent")
     * @Method({"GET","POST"})
     */
    public function editEvent(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $event = new Events();
        $event = $entityManager->getRepository(Events::class)->find($id);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dd = $event->getDateDebut();
            $df = $event->getDateFin();
            $td = $event->getTempsDebut();
            $tf = $event->getTempsFin();
            if (
                $df->format('dd/mm/yy') < $dd->format('dd/mm/yy') ||
                $tf->format('H:i') < $td->format('H:i')
            ) {
                die(
                    'impossible date debut superieur a datr finn ou temps debut superieur a temps fin '
                );
            }
            $file = $request->files->get('event')['photo'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($uploads_directory, $filename);
            $event->setPhoto($filename);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Votre évenement a été modifier avec succées'
            );
            return $this->redirectToRoute('listevent');
            dd($filename);
        }
        return $this->render('admin/edit_event.html.twig', [
            'form' => $form->createView()
        ]);
    }
     /**
     * @Route("/api/edit/event/{id}", name="api_editevent", methods={"PUT"})
     */
    public function apiEditEvent(Request $request,?Events $event)
    {
        $data=json_decode($request->getContent());
        $code=200;
        if(! $event){
            $event = new Events();
            $code=201;
        }
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($event);
        $entityManager->flush();
        return new Response('ok',$code);
          
    }

    /**
     * @Route("/addevent", name="addevent")
     * @Method({"GET","POST"})
     */
    public function addEvent(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = new Events();
        $form = $this->createForm(EventType::class, $event);
        /*
        $event_name = $this->getDoctrine()
            ->getRepository(Events::class)
            ->findOneBy(array('nom' => $request->request->get('nom')));

        $event_start_date = $this->getDoctrine()
            ->getRepository(Events::class)
            ->findOneBy(array(
                'date_debut' => $request->request->get('date_debut')
            ));
        echo'<pre>';
        print_r($event_name);  
        echo'</pre>';  
       
       
       */
        $form->handleRequest($request);
        // if ($event_name != null || $event_start_date != null ) {
        // return $this->redirect($this->generateUrl('addevent'));
        // }
        if ($form->isSubmitted() && $form->isValid()) {
            $dd = $event->getDateDebut();
            $df = $event->getDateFin();
            $td = $event->getTempsDebut();
            $tf = $event->getTempsFin();
            if (
                $df->format('dd/mm/yy') < $dd->format('dd/mm/yy') ||
                $tf->format('H:i') < $td->format('H:i')
            ) {
                die(
                    'impossible date debut superieur a datr finn ou temps debut superieur a temps fin '
                );
            } else {
                $file = $request->files->get('event')['photo'];
                $uploads_directory = $this->getParameter('uploads_directory');
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($uploads_directory, $filename);
                $event->setPhoto($filename);
                $event = $form->getData();
                $em->persist($event);
                $em->flush();
                $this->addFlash(
                    'success',
                    'Votre évenement a été ajoutér avec succées'
                );
                return $this->redirectToRoute('listevent');
            }
        }
        // $filename='744d11edc87e24d0b1df98283efef6ab.png';
        //<img src="{{ asset('uploads/') ~ photo }}"  alt="" >
        return $this->render('admin/event.html.twig', [
            'form' => $form->createView()
            //'photo'=>$filename
        ]);
    }
}
