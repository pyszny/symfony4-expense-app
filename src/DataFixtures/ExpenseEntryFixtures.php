<?php

namespace App\DataFixtures;

use App\Entity\Expense;
use App\Entity\ExpenseEntry;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class ExpenseEntryFixtures extends Fixture implements DependentFixtureInterface
{
    public function getRandom($objects)
    {
        return $objects[rand(0, (count($objects) - 1))];
    }

    public function generateInterval($days)
    {
        $intervalString = 'P' . $days . 'D';
        $interval = new \DateInterval($intervalString);
        return $interval;
    }

    public function createDatetime(\DateTime $dateTime, \DateInterval $dateInterval)
    {
        $dateA = clone $dateTime;
        $dateA->add($dateInterval);
        return $dateA;
    }

    public function load(ObjectManager $manager)
    {
        $datetime = new \DateTime();
        $date = new Date();
        $expenses = $manager->getRepository(Expense::class)->findAll();

        for($i = 1; $i <= 20; $i++) {;
            $interval = $this->generateInterval($i);
            $expenseEntry = new ExpenseEntry();
            $expenseEntry->setExpenseEntry($this->createDatetime($datetime, $interval));
            $expenseEntry->setExpense($this->getRandom($expenses));
            $expenseEntry->setExpenseDate($this->createDatetime($datetime, $interval));
            $expenseEntry->setValue(mt_rand(1, 10000));
            $manager->persist($expenseEntry);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ExpenseFixtures::class
        );
    }
}