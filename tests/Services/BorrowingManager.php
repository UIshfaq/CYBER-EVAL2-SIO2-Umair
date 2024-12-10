<?php

namespace App\Tests\Services;

use App\Entity\Book;
use App\Entity\Client;
use PHPUnit\Framework\TestCase;

class BorrowingManager extends TestCase
{
    public function canBorrow(): void
    {
        $book = new Book();
        $client = new Client();
        $client->addBorrowingBook(new Book());
        $client->addBorrowingBook(new Book());
        $client->addBorrowingBook(new Book());
        $client->addBorrowingBook(new Book());

        $borrowingManager = new \App\Service\BorrowingManager();
        $this->assertTrue($borrowingManager->canBorrowBook($client, $book));
    }

    public function cantBorrow(): void
    {
        $book = new Book();
        $client = new Client();
        $client->addBorrowingBook(new Book());
        $client->addBorrowingBook(new Book());
        $client->addBorrowingBook(new Book());
        $client->addBorrowingBook(new Book());
        $client->addBorrowingBook(new Book());

        $borrowingManager = new \App\Service\BorrowingManager();
        $this->assertFalse($borrowingManager->canBorrowBook($client, $book));
    }

    public function dejaEmprunter(): void
    {
        $book = new Book();
        $book->setBorrowed(true);
        $client = new Client();

        $borrowingManager = new \App\Service\BorrowingManager();
        $this->assertFalse($borrowingManager->canBorrowBook($client, $book));
    }

    public function pasEmprunter(): void
    {
        $book = new Book();
        $client = new Client();

        $borrowingManager = new \App\Service\BorrowingManager();
        $this->assertTrue($borrowingManager->canBorrowBook($client, $book));
    }
}
