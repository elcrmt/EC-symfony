<?php

namespace App\Controller;

use App\Entity\UserBook;
use App\Form\UserBookType;
use App\Repository\UserBookRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    public function __construct(
        private UserBookRepository $userBookRepository,
        private CategoryRepository $categoryRepository
    ) {
    }

    #[Route('/', name: 'app_home')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        try {
            $booksReading = $this->userBookRepository->findByUserAndStatus($user, false);
            $booksRead = $this->userBookRepository->findByUserAndStatus($user, true);
            
            // Récupérer toutes les catégories et les indexer par ID
            $categories = [];
            foreach ($this->categoryRepository->findAll() as $category) {
                $categories[$category->getId()] = $category->getName();
            }
        } catch (\Exception $e) {
            $this->addFlash('error', 'Une erreur est survenue lors de la récupération de vos livres.');
            $booksReading = [];
            $booksRead = [];
            $categories = [];
        }

        // Créer le formulaire pour l'ajout de livre
        $userBook = new UserBook();
        $form = $this->createForm(UserBookType::class, $userBook);

        return $this->render('pages/home.html.twig', [
            'booksReading' => $booksReading,
            'booksRead' => $booksRead,
            'categories' => $categories,
            'form' => $form->createView(),
        ]);
    }
}
