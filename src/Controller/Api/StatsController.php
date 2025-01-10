<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api/stats', name: 'api_stats_')]
class StatsController extends AbstractController
{
    #[Route('/categories', name: 'categories', methods: ['GET'])]
    public function getCategoriesStats(EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        
        $sql = "
            SELECT c.name as label, COUNT(ub.id) as value
            FROM category c
            LEFT JOIN book b ON b.category_id = c.id
            LEFT JOIN user_book ub ON ub.book_id = b.id 
            WHERE ub.user_id = :userId AND ub.is_finished = true
            GROUP BY c.id, c.name
            HAVING value > 0
        ";
        
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->bindValue('userId', $user->getId());
        
        try {
            $result = $stmt->executeQuery();
            $data = $result->fetchAllAssociative();
            
            // Formater les données pour le graphique radar
            $series = [[
                'name' => 'Livres terminés',
                'data' => array_map(fn($item) => (int)$item['value'], $data)
            ]];
            $labels = array_map(fn($item) => $item['label'], $data);
            
            return new JsonResponse([
                'series' => $series,
                'labels' => $labels
            ]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
}
