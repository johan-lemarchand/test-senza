<?php

namespace App\DataFixtures;

use App\Entity\Produits;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');


        for ($i =1; $i <= 30; $i++){
            $produit = new Produits();

            $nom = $faker->sentence(3);
            $description = $faker->paragraph(3);
            $photo = $faker->imageUrl(350,350, 'cats');

            $produit->setNom($nom)
                ->setDescription($description)
                ->setPrix(mt_rand(10, 300))
                ->setPhotos($photo);

            $manager->persist($produit);
        }

        $manager->flush();
    }
}
