<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExpenseEntryController extends AbstractController
{
    /**
     * @Route("/expense/entry", name="expense_entry")
     */
    public function index()
    {
        return $this->render('expense_entry/index.html.twig', [
            'controller_name' => 'ExpenseEntryController',
        ]);
    }
}
