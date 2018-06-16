<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\PackageCategory;

class PackageCategoryFixtures extends Fixture
{

    // Evaluator
    public const EVALUATOR_REFERENCE = 'evaluator';
    public const REALTIME_REFERENCE = 'realtime';
    public const SOCIAL_REFERENCE = 'social';
    public const STRATEGY_REFERENCE = 'strategy';
    public const TA_REFERENCE = 'ta';
    public const UTIL_REFERENCE = 'util';

    // Trading
    public const TRADING_REFERENCE = 'trading';
    public const TRADING_MODE_REFERENCE = 'trading mode';


    public function load(ObjectManager $manager)
    {
        ////////////////////////////////////////////////////////////////////////
        // EVALUATOR_REFERENCE
        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('Evaluator');
        $manager->persist($packageCategory);
        $this->addReference(self::EVALUATOR_REFERENCE, $packageCategory);

        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('Realtime');
        $packageCategory->setParent($this->getReference(self::EVALUATOR_REFERENCE));
        $manager->persist($packageCategory);
        $this->addReference(self::REALTIME_REFERENCE, $packageCategory);

        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('Social');
        $packageCategory->setParent($this->getReference(self::EVALUATOR_REFERENCE));
        $manager->persist($packageCategory);
        $this->addReference(self::SOCIAL_REFERENCE, $packageCategory);

        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('Strategy');
        $packageCategory->setParent($this->getReference(self::EVALUATOR_REFERENCE));
        $manager->persist($packageCategory);
        $this->addReference(self::STRATEGY_REFERENCE, $packageCategory);

        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('TA');
        $packageCategory->setLongname('Technical Analysis');
        $packageCategory->setParent($this->getReference(self::EVALUATOR_REFERENCE));
        $manager->persist($packageCategory);
        $this->addReference(self::TA_REFERENCE, $packageCategory);

        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('Util');
        $packageCategory->setLongname('Utility');
        $packageCategory->setParent($this->getReference(self::EVALUATOR_REFERENCE));
        $manager->persist($packageCategory);
        $this->addReference(self::UTIL_REFERENCE, $packageCategory);

        ////////////////////////////////////////////////////////////////////////
        // Trading
        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('Trading');
        $manager->persist($packageCategory);
        $this->addReference(self::TRADING_REFERENCE, $packageCategory);

        $packageCategory = new PackageCategory();
        $packageCategory->setShortname('Trading Mode');
        $packageCategory->setParent($this->getReference(self::TRADING_REFERENCE));
        $manager->persist($packageCategory);
        $this->addReference(self::TRADING_MODE_REFERENCE, $packageCategory);

        ////////////////////////////////////////////////////////////////////////

        $manager->flush();
    }

}
