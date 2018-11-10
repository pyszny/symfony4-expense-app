<?php

namespace App\DataFixtures;

use App\Entity\ExpenseGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ExpenseGroupFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 20; $i++) {
            $expenseGroup = new ExpenseGroup();
            $expenseGroup->setName("expense group " . $i);
            $manager->persist($expenseGroup);
        }

        $manager->flush();
    }
}