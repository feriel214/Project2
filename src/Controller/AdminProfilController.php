<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AdminProfilController extends AbstractController
{
    private $tokenManager;

    public function __construct(CsrfTokenManagerInterface $tokenManager = null)
    {
        $this->tokenManager = $tokenManager;
    }

   
    /**
     * @Route("/addadmin", name="add_admin")
     */
    public function addAdmin(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $admin = new User();
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();

            $verif = $em
                ->getRepository(User::class)
                ->findOneBy(array('email' => $request->request->get('email')));

            $verif2 = $em->getRepository(User::class)->findOneBy(array(
                'name' => $request->request->get('name')
            ));
            if ($verif != null) {
                $this->get('session')
                    ->getFlashBag()
                    ->add(
                        'erraddarchi',
                        'Email ' .
                            $request->request->get('email') .
                            '   existe déjà '
                    );
                return $this->redirectToRoute('add_admin');
            }

            if ($verif2 != null) {
                $this->get('session')
                    ->getFlashBag()
                    ->add(
                        'erraddarchi',
                        'Login ' .
                            $request->request->get('name') .
                            '   existe déjà '
                    );
                return $this->redirectToRoute('add_admin');
            }
            $rolesArr = array('ROLE_ADMIN');
            $admin->setUsername($request->request->get('name'));
            $admin->setPassword($request->request->get('pass'));
            $admin->setEmail($request->request->get('email'));
            $admin->setName($request->request->get('name'));
            $admin->setPhone($request->request->get('phone'));
            $admin->setBirthdate(
                new \DateTime($request->request->get('birthdate'))
            );
            $admin->setAdress($request->request->get('address'));
            $admin->setPlainPassword($request->request->get('pass'));
            $admin->setEnabled(true);
            $admin->setRoles($rolesArr);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($admin);
            $em->flush();

            $this->get('session')
                ->getFlashBag()
                ->add('addadmin', 'Votre Compte a été crée avec Succées ! ');
            return $this->redirectToRoute('login');
        }
        return $this->render('registration/inscription.html.twig');
    }

    /**
     * @Route("show/profile/{id}", name="show_profile")
     */
    public function showProfil($id)
    {
        $id = 1;
        $admin = $this->getDoctrine()
            ->getRepository(User::class)
            ->find(1);
        return $this->render('admin/show_profil.html.twig', [
            'admin' => $admin
        ]);
    }
    /**
     * @Route("update/profile/{id}", name="update_profile")
     */
    public function updateProfil($id)
    {
        $id = 1;
        $admin = $this->getDoctrine()
            ->getRepository(User::class)
            ->find(1);
        return $this->render('admin/update_profil.html.twig', [
            'admin' => $admin
        ]);
    }
    /**
     * @Route("update/password/{id}", name="update_password")
     */
    public function updatePassword($id)
    {
        $id = 1;
        $admin = $this->getDoctrine()
            ->getRepository(User::class)
            ->find(1);
        return $this->render('admin/update_pass.html.twig', [
            'admin' => $admin
        ]);
    }
     /**
     * @Route("/redirectlogin", name="redirectlogin")
     */
    public function index(Request $request)
    {
        if (
            $this->get('security.authorization_checker')->isGranted(
                'ROLE_ADMIN'
            )
        ) {
            return $this->redirect($this->generateUrl('listevent'));
        } 
    }

}
