<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Movie;


class MoviesController extends AbstractController
{
    // since we're using the EntityManager in multiple methods we define a property to hold it 
    private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    #[Route('/movies', name: 'app_movies', methods: ['GET', 'HEAD'])]    
    /**
     * index
     *
     * @return Response
     */
    public function index(): Response
    {
        $moviesRepository = $this->entityManager->getRepository(Movie::class);

        // findAll() - SELECT * FROM MOVIES
        // find(some id) - SELECT * FROM MOVIES WHERE ID = some id

        $movies = $moviesRepository->findAll();
        return $this->render('movies/index.html.twig',[
            'controller_name' => 'MoviesController',
            'my_name' => 'Amine',
            'movies' => $movies
        ]
        );
    }

    #[Route('/movies/{name}', name: "Movie_detail", defaults: ['name' => null], methods: ['GET'])]    
    /**
     * getMovie
     *
     * @param  mixed $name
     * @return Response
     */
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
