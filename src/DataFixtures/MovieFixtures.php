<?php 

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture 
{
    public function load(ObjectManager $manager) : void 
    {
        // insert some dummy data into movies table using the cli 
        $movie = new Movie();
        $movie->setTitle('The Dark Knight');
        $movie->setReleaseYear(2008);
        $movie->setDescription('this is the description for The Dark Knight !');
        $movie->setImagePath('https://cdn.pixabay.com/photo/2024/01/15/11/36/batman-8510026_1280.png');
        // add data to pivot table 
        // adding the actors by getting their references as referred in ActorFixtures
        $movie->addActor($this->getReference('actor_1'));
        $movie->addActor($this->getReference('actor_2'));

        $manager->persist($movie);

        $movie2 = new Movie();
        $movie2->setTitle('Avengers : Endgame');
        $movie2->setReleaseYear(2019);
        $movie2->setDescription('this is the description for The Avengers : Endgame released in the last years !');
        $movie2->setImagePath('https://cdn.pixabay.com/photo/2024/01/06/02/35/ai-generated-8490500_1280.jpg');

        // same thing, adding data to pivot table 
        // adding the actors by reference 
        $movie2->addActor($this->getReference('actor_3'));
        $movie2->addActor($this->getReference('actor_4'));
        
        $manager->persist($movie2);

        $manager->flush();
    }
}