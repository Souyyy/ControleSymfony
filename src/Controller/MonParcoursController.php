<?php

namespace App\Controller;

use App\Repository\ParcoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MonParcoursController extends AbstractController
{
    private $parcoursRepository;

    public function __construct(ParcoursRepository $parcoursRepository)
    {
        $this->parcoursRepository = $parcoursRepository;
    }

    #[Route('/mon-parcours', name: 'app_mon_parcours')]
    public function index(UserInterface $user): Response
    {
        // Récupérer le parcours de l'utilisateur via la relation Choisit
        //$parcours = $user->getChoisit();

        // Si aucun parcours n'est trouvé, rediriger vers la liste des parcours
        // if (!$parcours) {
        //     $this->addFlash('warning', 'Vous n\'avez pas encore choisi de parcours.');
        //     return $this->redirectToRoute('app_parcours_index');
        // }

        // Récupérer les étapes du parcours
        //$etapes = $parcours->getEtapes();

        // Afficher le parcours de l'utilisateur et ses étapes
        return $this->render('mon_parcours/index.html.twig', [
            //'parcours' => $parcours,
            //'etapes' => $etapes,
        ]);
    }
}
