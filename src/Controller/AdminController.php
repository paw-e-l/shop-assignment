<?php
namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="adminpanel")
     */
    public function index(): Response
    {
        return $this->redirect('/admin/product');
    }

    /**
     * @Route("/admin/product")
     */
    public function product(EntityManagerInterface $em, Request $request): Response
    {
        $product = new Product;
        $product->setCurrency('EUR');
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $em->persist($product);
            $em->flush();
            $this->addFlash('success', 'Product has been added');
            return $this->redirect('/admin/product');
        }
        return $this->render('admin/product.html.twig', [
            'form' => $form->createView()
        ]);
    }
}