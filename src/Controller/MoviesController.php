<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPSTORM_META\map;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'app_movies', methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        $movies = ["Avengers : Endgame", "Inception", "Loki", "Black Widow"];
        return $this->render('movies/index.html.twig',[
            'controller_name' => 'MoviesController',
            'my_name' => 'Amine',
            'movies' => $movies
        ]
        );
    }

    #[Route('/movies/{name}', name: "Movie_detail", defaults: ['name' => null], methods: ['GET'])]
    public function getMovie($name) : Response
    {
        return $this->render('Movies/detail.html.twig', [
            "name" => $name,
            "controller_name" => 'MoviesController',
            "method_name" => 'getMovie',
            "last_name" => 'Maourid',
        ]);
    }
    
    #[Route('/amine', name: 'amine_page', methods: ['GET'])]
    public function getAmine() : Response
    {
        return $this->render('movies/amine.html.twig', [
            "myName" => "amine maourid",
            "age" => "28",
            "nationality" => "moroccan",
            "controller" => "MoviesController",
            "method" => "getAmine",
        ]);
    }
}
