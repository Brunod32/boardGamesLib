<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoryRepository;
use App\Repository\GameRepository;
use App\Repository\NbPlayerRepository;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        CategoryRepository $categoryRepository, 
        NbPlayerRepository $nbPlayerRepository,
        GameRepository $gameRepository
    ): Response
    {
        // 1. Récupérer toutes les catégories
        $categories = $categoryRepository->findAll();
        $nbPlayers = $nbPlayerRepository->findAll();
        $games = $gameRepository->findAll();

        // 2. Renvoyer la vue en passant les catégories
        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'nbPlayers' => $nbPlayers,
            'games' => $games,
        ]);
    }
}
