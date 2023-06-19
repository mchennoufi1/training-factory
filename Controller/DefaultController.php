<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/", name="app_default")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('default/login.html.twig', [
            'controller_name' => 'LoginController',
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
    
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            
            // Check if email and password are provided
            if (!$email || !$password) {
                // Handle validation error
                return new Response('Please provide both email and password.');
            }
            
            // Encrypt the password
            $encodedPassword = $this->passwordEncoder->encodePassword(new User(), $password);
            
            // Save the user to the database (assuming you have a UserRepository)
            $userRepository = $this->getDoctrine()->getRepository(User::class);
            
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($encodedPassword);
            $user->setRoles(['ROLE_KLANT']); // Set the user role as "klant"
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            // Redirect the user to the home page
            return $this->redirectToRoute('app_default');
        }
        
        return $this->render('default/register.html.twig');
    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): Response
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
    
    /**
     * @Route("/redirect", name="redirect")
     */
    public function redirectAction(Security $security): Response
    {
        if ($security->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin');
        } elseif ($security->isGranted('ROLE_KLANT')) {
            return $this->redirectToRoute('app_klant');
        } elseif ($security->isGranted('ROLE_INSTRUCTEUR')) {
            return $this->redirectToRoute('app_instructeur');
        } else {
            return $this->redirectToRoute('app_default');
        }
    }
    
    /**
     * @Route("/registration-success", name="registration_success")
     */
    public function registrationSuccess(): Response
    {
        return new Response('Registration successful!');
    }
}

