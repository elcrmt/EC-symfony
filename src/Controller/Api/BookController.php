<?php

namespace App\Controller\Api;

use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/book', name: 'api_book_')]
class BookController extends AbstractController
{
    #[Route('/{id}/category', name: 'category', methods: ['GET'])]
    public function getCategory(int $id, BookRepository $bookRepository, CategoryRepository $categoryRepository): JsonResponse
    {
        $book = $bookRepository->find($id);
        
        if (!$book) {
            return new JsonResponse(['error' => 'Livre non trouvé'], 404);
        }
        
        $category = $categoryRepository->find($book->getCategoryId());
        
        if (!$category) {
            return new JsonResponse(['error' => 'Catégorie non trouvée'], 404);
        }
        
        return new JsonResponse([
            'category' => $category->getName()
        ]);
    }
}
