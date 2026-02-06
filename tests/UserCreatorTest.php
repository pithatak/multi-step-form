<?php

namespace App\Tests;

use App\Service\UserCreator;
use App\Tests\Factory\TestDtoFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class UserCreatorTest extends TestCase
{
    public function testCreatesUserWithRelations(): void
    {
        $em = $this->createMock(EntityManagerInterface::class);

        $em->expects($this->once())->method('persist');
        $em->expects($this->once())->method('flush');

        $service = new UserCreator($em);

        $dto = TestDtoFactory::validMultiEntityDto();

        $service->createFullUser($dto);
    }
}