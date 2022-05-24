<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Action', 'Actualité', 'Animation', 'Anime',
        'Arts martiaux', 'Aventure', 'Comédie', 'Comédie musicale',
        'Crime', 'Cuisine', 'Documentaire', 'Drame',
        'Enfant', 'Famille', 'Fantastique', 'Game show',
        'Guerre', 'Histoire', 'Horreur', 'Indie',
        'Intérêt particulier', 'Maison et jardinage', 'Mini-série',
        'Mystère', 'Podcast', 'Romance', 'Science-fiction',
        'Soap', 'Sport', 'Suspense', 'Talk-show', 'Thriller',
        'Télé-réalité', 'Voyage', 'Western'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
