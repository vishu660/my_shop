<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    // 🛒 Cart Page
    #[Route('/cart', name: 'cart_index')]
    public function index(SessionInterface $session): Response
    {
        // Fake products (abhi DB nahi)
        $products = [
            1 => ['name' => 'iPhone 14', 'price' => 70000],
            2 => ['name' => 'HP Laptop', 'price' => 55000],
            3 => ['name' => 'Headphones', 'price' => 2000],
        ];

        // Session se cart lao
        $cart = $session->get('cart', []);

        $cartItems = [];
        $total = 0;

        foreach ($cart as $id => $qty) {
            if (!isset($products[$id])) {
                continue;
            }

            $subtotal = $products[$id]['price'] * $qty;

            $cartItems[] = [
                'id' => $id,
                'name' => $products[$id]['name'],
                'price' => $products[$id]['price'],
                'quantity' => $qty,
                'subtotal' => $subtotal
            ];

            $total += $subtotal;
        }

        return $this->render('cart/index.html.twig', [
            'items' => $cartItems,
            'total' => $total
        ]);
    }

    // ➕ Add to Cart
    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('cart_index');
    }

    // ❌ Remove from Cart
    #[Route('/cart/remove/{id}', name: 'cart_remove')]
    public function remove(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('cart_index');
    }
}
