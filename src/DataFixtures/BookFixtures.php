<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $books = [
            [
                'name' => 'Le Seigneur des Anneaux',
                'description' => 'Une épopée fantastique écrite par J.R.R. Tolkien',
                'category_id' => 1,
                'pages' => 1178,
                'publication_date' => '1954-07-29'
            ],
            [
                'name' => '1984',
                'description' => 'Un roman dystopique de George Orwell',
                'category_id' => 2,
                'pages' => 328,
                'publication_date' => '1949-06-08'
            ],
            [
                'name' => 'Harry Potter à l\'école des sorciers',
                'description' => 'Le début des aventures du jeune sorcier Harry Potter',
                'category_id' => 1,
                'pages' => 309,
                'publication_date' => '1997-06-26'
            ],
            [
                'name' => 'L\'Étranger',
                'description' => 'Un roman d\'Albert Camus sur l\'absurdité de la vie',
                'category_id' => 2,
                'pages' => 159,
                'publication_date' => '1942-05-19'
            ],
            [
                'name' => 'Les Misérables',
                'description' => 'L\'œuvre majeure de Victor Hugo',
                'category_id' => 2,
                'pages' => 1488,
                'publication_date' => '1862-04-03'
            ],
            [
                'name' => 'Le Petit Prince',
                'description' => 'Un conte poétique de Saint-Exupéry',
                'category_id' => 3,
                'pages' => 93,
                'publication_date' => '1943-04-06'
            ],
            [
                'name' => 'Dune',
                'description' => 'Le chef-d\'œuvre de Frank Herbert',
                'category_id' => 1,
                'pages' => 896,
                'publication_date' => '1965-08-01'
            ],
            [
                'name' => 'Notre-Dame de Paris',
                'description' => 'Roman historique de Victor Hugo',
                'category_id' => 2,
                'pages' => 940,
                'publication_date' => '1831-03-16'
            ],
            [
                'name' => 'Fondation',
                'description' => 'Premier tome de la série d\'Isaac Asimov',
                'category_id' => 1,
                'pages' => 255,
                'publication_date' => '1951-05-01'
            ],
            [
                'name' => 'Le Comte de Monte-Cristo',
                'description' => 'Roman d\'aventure d\'Alexandre Dumas',
                'category_id' => 2,
                'pages' => 1312,
                'publication_date' => '1844-08-28'
            ],
            [
                'name' => 'Les Fleurs du Mal',
                'description' => 'Recueil de poèmes de Charles Baudelaire',
                'category_id' => 4,
                'pages' => 400,
                'publication_date' => '1857-06-25'
            ],
            [
                'name' => 'Le Hobbit',
                'description' => 'Le prélude au Seigneur des Anneaux',
                'category_id' => 1,
                'pages' => 310,
                'publication_date' => '1937-09-21'
            ],
            [
                'name' => 'Crime et Châtiment',
                'description' => 'Chef-d\'œuvre de Dostoïevski',
                'category_id' => 2,
                'pages' => 576,
                'publication_date' => '1866-01-01'
            ],
            [
                'name' => 'Fahrenheit 451',
                'description' => 'Roman dystopique de Ray Bradbury',
                'category_id' => 1,
                'pages' => 256,
                'publication_date' => '1953-10-19'
            ],
            [
                'name' => 'Les Trois Mousquetaires',
                'description' => 'Roman de cape et d\'épée d\'Alexandre Dumas',
                'category_id' => 2,
                'pages' => 884,
                'publication_date' => '1844-03-14'
            ],
            [
                'name' => 'Voyage au Centre de la Terre',
                'description' => 'Roman d\'aventure de Jules Verne',
                'category_id' => 1,
                'pages' => 378,
                'publication_date' => '1864-11-25'
            ],
            [
                'name' => 'La Peste',
                'description' => 'Roman d\'Albert Camus sur une épidémie',
                'category_id' => 2,
                'pages' => 336,
                'publication_date' => '1947-06-10'
            ],
            [
                'name' => 'Le Portrait de Dorian Gray',
                'description' => 'Roman d\'Oscar Wilde',
                'category_id' => 2,
                'pages' => 288,
                'publication_date' => '1890-07-01'
            ],
            [
                'name' => 'Les Hauts de Hurlevent',
                'description' => 'Roman d\'Emily Brontë',
                'category_id' => 2,
                'pages' => 384,
                'publication_date' => '1847-12-01'
            ],
            [
                'name' => 'Vingt Mille Lieues sous les Mers',
                'description' => 'Roman d\'aventure de Jules Verne',
                'category_id' => 1,
                'pages' => 552,
                'publication_date' => '1869-06-20'
            ]
        ];

        foreach ($books as $bookData) {
            $book = new Book();
            $book->setName($bookData['name']);
            $book->setDescription($bookData['description']);
            $book->setCategoryId($bookData['category_id']);
            $book->setPages($bookData['pages']);
            $book->setPublicationDate(new \DateTime($bookData['publication_date']));
            $book->setCreatedAt(new \DateTime());
            $book->setUpdatedAt(new \DateTime());
            $manager->persist($book);
        }

        $manager->flush();
    }
}
