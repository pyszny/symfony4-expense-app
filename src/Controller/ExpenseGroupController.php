<?php

namespace App\Controller;

use App\Entity\ExpenseGroup;
use App\Form\ExpenseGroupType;
use App\Repository\ExpenseGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expense/group")
 */
class ExpenseGroupController extends AbstractController
{
    /**
     * @Route("/", name="expense_group_index", methods="GET")
     */
    public function index(ExpenseGroupRepository $expenseGroupRepository): Response
    {
        return $this->render('expense_group/index.html.twig', ['expense_groups' => $expenseGroupRepository->findAll()]);
    }

    /**
     * @Route("/new", name="expense_group_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $expenseGroup = new ExpenseGroup();
        $form = $this->createForm(ExpenseGroupType::class, $expenseGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($expenseGroup);
            $em->flush();

            return $this->redirectToRoute('expense_group_index');
        }

        return $this->render('expense_group/new.html.twig', [
            'expense_group' => $expenseGroup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expense_group_show", methods="GET")
     */
    public function show(ExpenseGroup $expenseGroup): Response
    {
        return $this->render('expense_group/show.html.twig', ['expense_group' => $expenseGroup]);
    }

    /**
     * @Route("/{id}/edit", name="expense_group_edit", methods="GET|POST")
     */
    public function edit(Request $request, ExpenseGroup $expenseGroup): Response
    {
        $form = $this->createForm(ExpenseGroupType::class, $expenseGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expense_group_edit', ['id' => $expenseGroup->getId()]);
        }

        return $this->render('expense_group/edit.html.twig', [
            'expense_group' => $expenseGroup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expense_group_delete", methods="DELETE")
     */
    public function delete(Request $request, ExpenseGroup $expenseGroup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$expenseGroup->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($expenseGroup);
            $em->flush();
        }

        return $this->redirectToRoute('expense_group_index');
    }
}
