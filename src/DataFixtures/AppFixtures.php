<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;
use App\Entity\Recipe;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {

        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        $ingredients = [];
        for ($i = 1; $i <= 50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word)
                ->setPrice(mt_rand(1, 100)); 

            $manager->persist($ingredient);
            $ingredients[] = $ingredient; 
        }

        for ($j = 1; $j <= 20; $j++) {
            $recipe = new Recipe();
            $recipe->setName($this->faker->word)
                ->setTime(mt_rand(0, 1) === 1 ? mt_rand(10, 1400) : null)
                ->setNbPersons(mt_rand(0, 1) === 1 ? mt_rand(1, 50) : null)
                ->setDifficulty(mt_rand(0, 1) === 1 ? mt_rand(1, 5) : null)
                ->setDescription($this->faker->text(200))
                ->setPrice(mt_rand(0, 1) === 1 ? mt_rand(1, 1000) : null)
                ->setIsFavorite(mt_rand(0, 1) === 1);

            for ($k = 0; $k < mt_rand(1, 5); $k++) {
                $recipe->addIngredient($ingredients[array_rand($ingredients)]);
            }

            $manager->persist($recipe);
        }

        $manager->flush();
    }
}


