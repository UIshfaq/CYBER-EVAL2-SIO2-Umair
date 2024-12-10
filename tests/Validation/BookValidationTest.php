<?php

namespace App\Tests\Validation;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BookValidationTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }

    public function makeBook(): Book
    {
        $book = new Book();
        $book->setTitle('test');
        $book->setIsbn('12345678902345');
        $book->setPublishedAt(new \DateTime("2021-01-01"));

        return $book;
    }

    public function testInvalid(): void
    {
        self::bootKernel();
        $validator = static::getContainer()->get('validator');

        $book = $this->makeBook();

        $book->setTitle('');
        $book->setIsbn('');
        //$book->setPublishedAt(null);

        $errors = $validator->validate($book);

        $this->assertCount(2, $errors);// 3 avec le publishedAt
    }

    public function testValid(): void
    {
        self::bootKernel();
        $validator = static::getContainer()->get('validator');

        $book = $this->makeBook();

        $errors = $validator->validate($book);

        $this->assertCount(0, $errors);
    }
}