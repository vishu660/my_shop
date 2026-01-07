<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthController extends AbstractController
{
    // ================= LOGIN =================
    #[Route('/login', name: 'app_login')]
    public function login(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher,
        SessionInterface $session
    ): Response
    {
        $error = null;

        if ($request->isMethod('POST')) {

            $email    = $request->request->get('email');
            $password = $request->request->get('password');

            // 🔍 FIND USER FROM DB
            $user = $em->getRepository(User::class)->findOneBy([
                'email' => $email
            ]);

            if (!$user) {
                $error = 'Email not registered';
            }
            // 🔐 VERIFY PASSWORD
            elseif (!$passwordHasher->isPasswordValid($user, $password)) {
                $error = 'Invalid password';
            }
            else {

                // ✅ LOGIN SUCCESS
                $session->set('user', [
                    'id'    => $user->getId(),
                    'email' => $user->getEmail(),
                    'role'  => $user->getRoles()[0] ?? 'ROLE_USER'
                ]);

                // 🔁 ROLE BASED REDIRECT
                if (in_array('ROLE_ADMIN', $user->getRoles())) {
                    return $this->redirectToRoute('admin_dashboard');
                }

                return $this->redirectToRoute('product_list');
            }
        }

        return $this->render('auth/login.html.twig', [
            'error' => $error
        ]);
    }

   // ================= REGISTER =================
#[Route('/register', name: 'app_register')]
public function register(
    Request $request,
    EntityManagerInterface $em,
    UserPasswordHasherInterface $passwordHasher,
    SessionInterface $session
): Response
{
    $error = null;

    if ($request->isMethod('POST')) {

        $name     = $request->request->get('name');
        $email    = $request->request->get('email');
        $phone    = $request->request->get('phone');
        $password = $request->request->get('password');
        $confirm  = $request->request->get('confirm_password');

        if (!$name || !$email || !$password) {
            $error = 'All fields are required';
        }
        elseif ($password !== $confirm) {
            $error = 'Password not match';
        }
        else {

            $existingUser = $em->getRepository(User::class)
                               ->findOneBy(['email' => $email]);

            if ($existingUser) {
                $error = 'Email already registered';
            }
            else {

                $user = new User();
                $user->setName($name); 
                $user->setEmail($email);
                $user->setPhone($phone);
                $user->setRoles(['ROLE_USER']); 

                $hashedPassword = $passwordHasher->hashPassword($user, $password);
                $user->setPassword($hashedPassword);

                $em->persist($user);
                $em->flush();

                $session->set('user', [
                    'id'    => $user->getId(),
                    'email' => $user->getEmail(),
                    'role'  => 'ROLE_USER'
                ]);

                return $this->redirectToRoute('product_list');
            }
        }
    }

    return $this->render('auth/register.html.twig', [
        'error' => $error
    ]);
}


    // ================= LOGOUT =================
    #[Route('/logout', name: 'app_logout')]
    public function logout(SessionInterface $session): Response
    {
        $session->clear();
        return $this->redirectToRoute('app_login');
    }
}

