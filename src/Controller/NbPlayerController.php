<?php

namespace App\Controller;

use App\Entity\NbPlayer;
use App\Form\NbPlayerType;
use App\Repository\NbPlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/nb-players')]
final class NbPlayerController extends AbstractController
{
    #[Route(name: 'app_nb_player_index', methods: ['GET'])]
    public function index(NbPlayerRepository $nbPlayerRepository): Response
    {
        return $this->render('nb_player/index.html.twig', [
            'nb_players' => $nbPlayerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_nb_player_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nbPlayer = new NbPlayer();
        $form = $this->createForm(NbPlayerType::class, $nbPlayer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($nbPlayer);
            $entityManager->flush();

            return $this->redirectToRoute('app_nb_player_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('nb_player/new.html.twig', [
            'nb_player' => $nbPlayer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nb_player_show', methods: ['GET'])]
    public function show(NbPlayer $nbPlayer): Response
    {
        return $this->render('nb_player/show.html.twig', [
            'nb_player' => $nbPlayer,
            'players_label' => $nbPlayer->getPlayersLabel(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_nb_player_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NbPlayer $nbPlayer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NbPlayerType::class, $nbPlayer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_nb_player_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('nb_player/edit.html.twig', [
            'nb_player' => $nbPlayer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nb_player_delete', methods: ['POST'])]
    public function delete(Request $request, NbPlayer $nbPlayer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nbPlayer->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($nbPlayer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_nb_player_index', [], Response::HTTP_SEE_OTHER);
    }
}
