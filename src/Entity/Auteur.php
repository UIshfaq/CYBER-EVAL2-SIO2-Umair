<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuteurRepository::class)]
class Auteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, book>
     */
    #[ORM\OneToMany(targetEntity: book::class, mappedBy: 'lAuteur')]
    private Collection $book;

    public function __construct()
    {
        $this->book = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, book>
     */
    public function getBook(): Collection
    {
        return $this->book;
    }

    public function addBook(book $book): static
    {
        if (!$this->book->contains($book)) {
            $this->book->add($book);
            $book->setLAuteur($this);
        }

        return $this;
    }

    public function removeBook(book $book): static
    {
        if ($this->book->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getLAuteur() === $this) {
                $book->setLAuteur(null);
            }
        }

        return $this;
    }
}
