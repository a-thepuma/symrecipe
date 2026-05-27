<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RecipeController extends AbstractController
{
    #[Route('/recipe', name: 'app_recipe')]
    public function index(RecipeRepository $repository): Response
    {

        $recipes = $repository->findAll();

        // dd($recipes);

        return $this->render('pages/recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }
}
