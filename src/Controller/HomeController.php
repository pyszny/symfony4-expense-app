<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(CategoryRepository $categoryRepository)
    {
        $ids = [];
        $categories = $categoryRepository->findAll();
        foreach ($categories as $category)
            array_push($ids, $category->getId());
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'ids' => $ids
        ]);
    }
}
