<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Package;
use App\DataFixtures\PackageCategoryFixtures;

class PackageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('momentum_evaluator')
            ->setDescription('A technical analysis evaluator example from DrakkarS team.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::TA_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/momentum_evaluator.py');
        $manager->persist($package);


        $manager->flush();
    }
}
