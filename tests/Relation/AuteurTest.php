<?php

namespace App\Tests\Relation;

use App\Entity\Auteur;
use App\Entity\Book;
use PHPUnit\Framework\TestCase;

class AuteurTest extends TestCase
{
    public function testSomething(): void
    {
        $book = new Book();
        $book2 = new Book();
        $auteur = new Auteur();

        $auteur->addBook($book);
        $auteur->addBook($book2);

        $this->assertCount(2, $auteur->getBook());
        $this->assertSame($auteur, $book->getLAuteur());
        $this->assertSame($auteur, $book2->getLAuteur());


        $auteur->removeBook($book);
        $this->assertCount(1, $auteur->getBook());
        $this->assertNull($book->getLAuteur());

    }
}
