<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExpenseEntryRepository")
 */
class ExpenseEntry
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\Column(type="date")
     */
    private $expense_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expense_entry;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Expense", inversedBy="expenseEntries")
     */
    private $expense;

    /**
     * @return mixed
     */
    public function getExpense()
    {
        return $this->expense;
    }

    /**
     * @param mixed $expense
     */
    public function setExpense($expense): void
    {
        $this->expense = $expense;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getExpenseDate(): ?\DateTimeInterface
    {
        return $this->expense_date;
    }

    public function setExpenseDate(\DateTimeInterface $expense_date): self
    {
        $this->expense_date = $expense_date;

        return $this;
    }

    public function getExpenseEntry(): ?\DateTimeInterface
    {
        return $this->expense_entry;
    }

    public function setExpenseEntry(\DateTimeInterface $expense_entry): self
    {
        $this->expense_entry = $expense_entry;

        return $this;
    }
}
