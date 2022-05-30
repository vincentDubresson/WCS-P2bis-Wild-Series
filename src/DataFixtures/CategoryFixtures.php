<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    const CATEGORIES = [
        'Action', 'Crime', 'Fantastique', 
        'Horreur', 'Romance', 'Science-fiction'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $category->setSlug($this->slugify->generate($categoryName));
            $manager->persist($category);
            $this->addReference('category_' . $categoryName, $category);
        }
        $manager->flush();
    }
}
