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

        /////////////////////////////////////
        // RealTime
        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('instant_fluctuations_evaluator')
            ->setDescription('A  public "RealTime" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::REALTIME_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/RealTime/instant_fluctuations_evaluator.py');
        $manager->persist($package);

        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('orderbook_evaluator')
            ->setDescription('A  public "RealTime" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::REALTIME_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/orderbook_evaluator.py');
        $manager->persist($package);

        /////////////////////////////////////
        // Social
        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('forum_evaluator')
            ->setDescription('A  public "Social Reference" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::SOCIAL_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/forum_evaluator.py');
        $manager->persist($package);

        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('news_evaluator')
            ->setDescription('A  public "Social Reference" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::SOCIAL_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/news_evaluator.py');
        $manager->persist($package);

        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('stats_evaluator')
            ->setDescription('A  public "Social Reference" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::SOCIAL_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/stats_evaluator.py');
        $manager->persist($package);

        /////////////////////////////////////
        // Strategies
        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('mixed_strategies_evaluator')
            ->setDescription('A  public "Strategy" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::STRATEGY_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/mixed_strategies_evaluator.py');
        $manager->persist($package);

        /////////////////////////////////////
        // TA
        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('momentum_evaluator')
            ->setDescription('A  public "Technical Analysis" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::TA_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/momentum_evaluator.py');
        $manager->persist($package);

        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('trend_evaluator')
            ->setDescription('A  public "Technical Analysis" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::TA_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/trend_evaluator.py');
        $manager->persist($package);

        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('volatility_evaluator')
            ->setDescription('A  public "Technical Analysis" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::TA_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/volatility_evaluator.py');
        $manager->persist($package);

        /////////////////////////////////////
        // Util
        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('overall_state_analysis')
            ->setDescription('A  public "Utility" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::UTIL_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/overall_state_analysis.py');
        $manager->persist($package);

        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('pattern_analysis')
            ->setDescription('A  public "Utility" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::UTIL_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/pattern_analysis.py');
        $manager->persist($package);

        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('statistics_analysis')
            ->setDescription('A  public "Utility" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::UTIL_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/statistics_analysis.py');
        $manager->persist($package);

        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('text_analysis')
            ->setDescription('A  public "Utility" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::UTIL_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/text_analysis.py');
        $manager->persist($package);

        $package = new Package();
        $package
            ->setVendor('tentacle')
            ->setName('trend_analysis')
            ->setDescription('A  public "Utility" tentacles (packages) for the OctoBot project evaluator.')
            ->setWebsite('https://github.com/Drakkar-Software')
            ->setCategory($this->getReference(PackageCategoryFixtures::UTIL_REFERENCE))
            ->setVersion('1.0.0')
            ->setRepository('https://github.com/Drakkar-Software/OctoBot-Tentacles/blob/master/TA/trend_analysis.py');
        $manager->persist($package);



        $manager->flush();
    }
}
