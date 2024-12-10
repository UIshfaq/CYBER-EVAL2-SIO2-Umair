<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Collection;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, book>
     */
    #[ORM\ManyToMany(targetEntity: book::class, inversedBy: 'Isborrowed')]
    private \Doctrine\Common\Collections\Collection $borrowingBook;

    public function __construct()
    {
        $this->borrowingBook = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection<int, book>
     */
    public function getBorrowingBook(): \Doctrine\Common\Collections\Collection
    {
        return $this->borrowingBook;
    }

    public function addBorrowingBook(book $borrowingBook): static
    {
        if (!$this->borrowingBook->contains($borrowingBook)) {
            $this->borrowingBook->add($borrowingBook);
        }

        return $this;
    }

    public function removeBorrowingBook(book $borrowingBook): static
    {
        $this->borrowingBook->removeElement($borrowingBook);

        return $this;
    }

    public function getBorrowedBooksCount()
    {
        return count($this->borrowingBook);
    }

}
