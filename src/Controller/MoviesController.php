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

    #[Route('/movies/{name}', name:'getMovieByName', defaults:['name' => null])]
    public function getMovieByName($name) : Response
    {
        // get the movie by name 
        $moviesRepository = $this->entityManager->getRepository(Movie::class);
        $movieByName = $moviesRepository->findBy(['title' => $name]);
        if(empty($movieByName)){
            return $this->render('movies/notfound.html.twig', ["name" => $name]);
        }
        return $this->render('movies/detail.html.twig', ["movie" => $movieByName[0]]);
    }
}
