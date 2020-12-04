<?php
namespace App\Controller\Api;

use App\ApiResponse\PaginatedList;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

class ProductController extends AbstractFOSRestController {

    /**
     * @Rest\Get("/products/{page}", requirements={"page"="\d+"})
     */
    public function list(EntityManagerInterface $em, PaginatedList $response, $page = 0)
    {
        /** @var \App\Repository\ProductRepository $productRepository */
        $productRepository = $em->getRepository(\App\Entity\Product::class);
        $perPage = 10;
        $products = $productRepository->findAllPaginated($page, $perPage);
        $totalCount = $productRepository->findTotalCount();

        return View::create($response->get($page, $perPage, $totalCount, $products));
    }

}