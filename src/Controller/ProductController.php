<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_list')]
    public function list()
    {
        // Dummy products (abhi DB nahi)
        $products = [
            [
                'id' => 1,
                'name' => 'iPhone 14',
                'price' => 70000,
                'image' => 'https://via.placeholder.com/300'
            ],
            [
                'id' => 2,
                'name' => 'HP Laptop',
                'price' => 55000,
                'image' => 'https://via.placeholder.com/300'
            ],
            [
                'id' => 3,
                'name' => 'Headphones',
                'price' => 2000,
                'image' => 'https://via.placeholder.com/300'
            ]
        ];

        return $this->render('product/list.html.twig', [
            'products' => $products
        ]);
    }
    #[Route('/product/{id}', name: 'product_detail')]
public function detail($id)
{
    $products = [
        1 => [
            'id' => $id,
            'name' => 'iPhone 14',
            'price' => 70000,
            'description' => 'Latest Apple iPhone with powerful performance',
            'image' => 'https://via.placeholder.com/500'
        ],
        2 => [
            'id' => $id,
            'name' => 'HP Laptop',
            'price' => 55000,
            'description' => 'Perfect laptop for work and study',
            'image' => 'https://via.placeholder.com/500'
        ],
        3 => [
            'id' => $id,
            'name' => 'Headphones',
            'price' => 2000,
            'description' => 'High quality sound headphones',
            'image' => 'https://via.placeholder.com/500'
        ]
    ];

    $product = $products[$id];

    return $this->render('product/detail.html.twig', [
        'product' => $product
    ]);
}

}
