<?php

namespace App\Tests\Unit;

use App\Entity\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testBook(): void
    {
        $book = new Book();


        $book->setTitle('titre');
        $book->setIsbn("23");
        $book->setPublishedAt(new \DateTime('2021-01-01'));


        $this->assertEquals('titre', $book->getTitle());
        $this->assertEquals('23', $book->getIsbn());
        $this->assertEquals(new \DateTime('2021-01-01'), $book->getPublishedAt());
    }
}
