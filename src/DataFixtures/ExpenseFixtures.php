<?php

namespace App\DataFixtures;


use App\Entity\Category;
use App\Entity\Expense;
use App\Entity\ExpenseGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ExpenseFixtures extends Fixture implements DependentFixtureInterface
{
    public function getRandom($objects)
    {
        return $objects[rand(0, (count($objects) - 1))];
    }

    public function load(ObjectManager $manager)
    {
        $categories = $manager->getRepository(Category::class)->findAll();
        $expenseGroups = $manager->getRepository(ExpenseGroup::class)->findAll();

        for($i = 1; $i <= 20; $i++) {
            $expense = new Expense();
            $expense->setName("expense " . $i);
            $expense->setCategory($this->getRandom($categories));
            $expense->setExpenseGroup($this->getRandom($expenseGroups));
            $manager->persist($expense);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ExpenseGroupFixtures::class,
            CategoryFixtures::class
        );
    }
}