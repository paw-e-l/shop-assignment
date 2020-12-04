<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontendController extends AbstractController 
{
    /**
     * @Route("/{path}", name="frontend", requirements={"path": "(?!api|_|login|logout).*"})
     */
    public function index() 
    {
        return $this->render('frontend.html.twig');
    }

}