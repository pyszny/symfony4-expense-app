<?php

namespace App\Controller;

use App\Entity\ExpenseEntry;
use App\Form\ExpenseEntryType;
use App\Repository\ExpenseEntryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expense/entry")
 */
class ExpenseEntryController extends AbstractController
{
    /**
     * @Route("/", name="expense_entry_index", methods="GET")
     */
    public function index(ExpenseEntryRepository $expenseEntryRepository): Response
    {
        return $this->render('expense_entry/index.html.twig', ['expense_entries' => $expenseEntryRepository->findAll()]);
    }

    /**
     * @Route("/new", name="expense_entry_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $expenseEntry = new ExpenseEntry();
        $now = new \DateTime();
        $expenseEntry->setExpenseEntry($now);
        $form = $this->createForm(ExpenseEntryType::class, $expenseEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($expenseEntry);
            $em->flush();

            return $this->redirectToRoute('expense_entry_index');
        }

        return $this->render('expense_entry/new.html.twig', [
            'expense_entry' => $expenseEntry,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expense_entry_show", methods="GET")
     */
    public function show(ExpenseEntry $expenseEntry): Response
    {
        return $this->render('expense_entry/show.html.twig', ['expense_entry' => $expenseEntry]);
    }

    /**
     * @Route("/{id}/edit", name="expense_entry_edit", methods="GET|POST")
     */
    public function edit(Request $request, ExpenseEntry $expenseEntry): Response
    {
        $form = $this->createForm(ExpenseEntryType::class, $expenseEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expense_entry_edit', ['id' => $expenseEntry->getId()]);
        }

        return $this->render('expense_entry/edit.html.twig', [
            'expense_entry' => $expenseEntry,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expense_entry_delete", methods="DELETE")
     */
    public function delete(Request $request, ExpenseEntry $expenseEntry): Response
    {
        if ($this->isCsrfTokenValid('delete'.$expenseEntry->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($expenseEntry);
            $em->flush();
        }

        return $this->redirectToRoute('expense_entry_index');
    }
}
