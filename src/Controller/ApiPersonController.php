<?php

namespace App\Controller;
use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiPersonController extends AbstractController
{
    /**
     * @Route("/api/list/person" , name="list_person", methods={"GET"})
     */
    public function apiListPerson(PersonRepository $Personrepository)
    {
        return $this->json($Personrepository->findAll(), 200, []);
    }
    /**
     * @Route("/api/add/person" , name="add_person", methods={"POST"})
     */
    public function apiAddPerson(Request $request)
    {
        if ($request != null) {
            $person = new Person();
            $donnees = json_decode($request->getContent());

            // On hydrate l'objet
            $person->setLastname($donnees->lastname);
            $person->setAge($donnees->age);
            $person->setNumber($donnees->number);
            $person->setCountry($donnees->country);
            $person->setCompleted(false);

            // On sauvegarde en base
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($person);
            $entityManager->flush();

            // On retourne la confirmation
            return new Response('ok', 201);
        }
        return new Response('Failed', 404);
    }
    /**
     * @Route("/api/edit/person/{id}" , name="edit_person" , methods={"PUT"})
     */
    public function apiEditPerson(Request $request,Person $person)
    {
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(PersonType::class, $person);
        $form->submit($data);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return  $this->redirectToRoute('list_person');
    }

    /**
     * @Route("/api/delete/person/{id}" , name="delete_person" ,methods={"DELETE"})
     */
    public function apiDeletePerson($id)
    {
        $person = $this->getDoctrine()
            ->getRepository(Person::class)
            ->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($person);
        $entityManager->flush();
        return new Response('ok');
    }
    /**
     * @Route("/api/show/person/{id}" , name="show_person" , methods={"GET"})
     */
    public function apiShowPerson($id)
    {
        $person = $this->getDoctrine()
            ->getRepository(Person::class)
            ->find($id);
        return $this->json($person, 200, []);
    }
}
