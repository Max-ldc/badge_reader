<?php

namespace App\DataFixtures;

use App\Entity\Badge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        for ($i = 0; $i < 5; $i++) {
            $badge = new Badge();
            $badge->setSerialNumber($i . "00.7777");

            $manager->persist($badge);
        }

        $manager->flush();
    }
}
