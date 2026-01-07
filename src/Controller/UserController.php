<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/profile', name: 'user_profile')]
    public function profile(): Response
    {
        return $this->render('user/profile.html.twig');
    }

    #[Route('/orders', name: 'user_orders')]
    public function orders(): Response
    {
        return $this->render('user/orders.html.twig');
    }

    #[Route('/wishlist', name: 'user_wishlist')]
    public function wishlist(): Response
    {
        return $this->render('user/wishlist.html.twig');
    }
}
