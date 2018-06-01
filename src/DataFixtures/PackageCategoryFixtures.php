<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\PackageCategory;

class PackageCategoryFixtures extends Fixture
{

    public const REALTIME_REFERENCE = 'realtime';
    public const SOCIAL_REFERENCE = 'social';
    public const STRATEGY_REFERENCE = 'strategy';
    public const TA_REFERENCE = 'ta';
    public const UTIL_REFERENCE = 'util';
    
    public function load(ObjectManager $manager)
    {
        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('Realtime');
        $manager->persist($packageCategory);
        $this->addReference(self::REALTIME_REFERENCE, $packageCategory);

        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('Social');
        $manager->persist($packageCategory);
        $this->addReference(self::SOCIAL_REFERENCE, $packageCategory);

        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('Strategy');
        $manager->persist($packageCategory);
        $this->addReference(self::STRATEGY_REFERENCE, $packageCategory);

        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('TA');
        $packageCategory->setLongname('Technical Analysis');
        $manager->persist($packageCategory);
        $this->addReference(self::TA_REFERENCE, $packageCategory);

        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('Util');
        $manager->persist($packageCategory);
        $this->addReference(self::UTIL_REFERENCE, $packageCategory);

        $manager->flush();
    }

}
