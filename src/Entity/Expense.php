<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExpenseRepository")
 */
class Expense
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ExpenseGroup", inversedBy="expenses")
     */
    private $expense_group;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="expenses")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpenseGroup()
    {
        return $this->expense_group;
    }

    /**
     * @param mixed $expense_group
     * @return Expense
     */
    public function setExpenseGroup($expense_group)
    {
        $this->expense_group = $expense_group;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return Expense
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }



    public function __toString()
    {
        return $this->name;
    }
}
