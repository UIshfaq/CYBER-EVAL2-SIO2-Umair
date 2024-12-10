<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Regex('/^\d{14}$/')]
    private ?string $isbn = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $publishedAt = null;

    #[ORM\ManyToOne(inversedBy: 'book')]
    private ?Auteur $lAuteur = null;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\ManyToMany(targetEntity: Client::class, mappedBy: 'borrowingBook')]
    private Collection $Isborrowed;

    public function __construct()
    {
        $this->Isborrowed = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): static
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getLAuteur(): ?Auteur
    {
        return $this->lAuteur;
    }

    public function setLAuteur(?Auteur $lAuteur): static
    {
        $this->lAuteur = $lAuteur;

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getIsborrowed(): Collection
    {
        return $this->Isborrowed;
    }

    public function addIsborrowed(Client $isborrowed): static
    {
        if (!$this->Isborrowed->contains($isborrowed)) {
            $this->Isborrowed->add($isborrowed);
            $isborrowed->addBorrowingBook($this);
        }

        return $this;
    }

    public function removeIsborrowed(Client $isborrowed): static
    {
        if ($this->Isborrowed->removeElement($isborrowed)) {
            $isborrowed->removeBorrowingBook($this);
        }

        return $this;
    }

    public function isBorrowed()
    {
        return !$this->Isborrowed->isEmpty();
    }

    public function setBorrowed(bool $true)
    {
        if ($true) {
            $this->Isborrowed = new ArrayCollection();
        } else {
            $this->Isborrowed = new ArrayCollection();
        }
    }


}
