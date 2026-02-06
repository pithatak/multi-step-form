<?php

namespace App\Tests\DTO;

use App\DTO\ContactDTO;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContactDTOTest extends KernelTestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->validator = self::getContainer()->get(ValidatorInterface::class);
    }

    public function testPhoneRegex():void
    {
        $dto = new ContactDTO();
        $dto->email = 'test@gmail.com';
        $dto->phone = 'QWERTYUIOP[]ASDF';

        $errors = $this->validator->validate($dto);
        $this->assertCount(1, $errors);
    }

    public function testPhoneValid(): void
    {
        $dto = new ContactDTO();
        $dto->email = 'test@gmail.com';
        $dto->phone = '123456789';

        $errors = $this->validator->validate($dto);
        $this->assertCount(0, $errors);
    }

}