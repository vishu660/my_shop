<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/product')]
class AdminProductController extends AbstractController
{
    #[Route('/add', name: 'admin_product_add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $success = null;

        if ($request->isMethod('POST')) {

            $product = new Product();

            $product->setName($request->request->get('name'));
            $product->setSlug(strtolower(str_replace(' ', '-', $request->request->get('name'))));
            $product->setShortDescription($request->request->get('short_description'));
            $product->setDescription($request->request->get('description'));
            $product->setPrice($request->request->get('price'));
            $product->setSalePrice($request->request->get('sale_price'));
            $product->setStock((int)$request->request->get('stock'));
            $product->setSku($request->request->get('sku'));
            $product->setStatus($request->request->get('status') ? true : false);
            $product->setIsFeatured($request->request->get('is_featured') ? true : false);
            $product->setIsNew($request->request->get('is_new') ? true : false);
            $product->setIsBestSeller($request->request->get('is_best_seller') ? true : false);

            $product->setImage($request->request->get('image'));

            $em->persist($product);
            $em->flush();

            $success = 'Product added successfully 🎉';
        }

        return $this->render('admin/product/add.html.twig', [
            'success' => $success
        ]);
    }
}
