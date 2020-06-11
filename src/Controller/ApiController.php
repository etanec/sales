<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/product/add", name="api_add_product", methods={"POST"})
     */
    public function addProduct(Request $request): JsonResponse
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product, ['csrf_protection' => false]);

        $data = \json_decode($request->getContent(), true);
        $form->submit($data);
        if (!$form->isValid()) {
            throw new \Exception('An error occured', 400);
        }

        return new JsonResponse('Product created', 201);
    }
}
