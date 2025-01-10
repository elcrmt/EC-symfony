<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Define the data to insert
        $now = new \DateTime();
        $data = [
            [
                'name' => 'Science-Fiction & Fantasy',
                'description' => 'Livres d\'imaginaire, de science-fiction et de fantasy comme Le Seigneur des Anneaux, Dune, etc.',
            ],
            [
                'name' => 'Littérature Classique',
                'description' => 'Les grands classiques de la littérature mondiale comme Les Misérables, L\'Étranger, etc.',
            ],
            [
                'name' => 'Littérature Jeunesse',
                'description' => 'Livres destinés aux jeunes lecteurs comme Le Petit Prince.',
            ],
            [
                'name' => 'Poésie',
                'description' => 'Recueils de poèmes et œuvres poétiques comme Les Fleurs du Mal.',
            ]
        ];

        foreach ($data as $item) {
            $category = new Category();
            $category->setName($item['name']);
            $category->setDescription($item['description']);
            $category->setCreatedAt($now);
            $category->setUpdatedAt($now);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
