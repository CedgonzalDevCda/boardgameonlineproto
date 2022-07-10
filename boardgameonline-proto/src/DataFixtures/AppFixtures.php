<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Game;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct() {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        // Création des users.
        $users = [];

        // Création du compte détenant tous les rôles.
        $admin= new User();
        $admin->setUsername("testAdmin")
             ->setRoles(["ROLE_ADMIN","ROLE_AUTHOR","ROLE_USER"])
            ->setPassword('test')
            ;
        $users[] = $admin;
        $manager->persist($admin);

        // Création d'un compte Author.
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($this->faker->name())
                ->setRoles(['ROLE_AUTHOR'])
                ->setPassword('test');

            $users[] = $user;
            $manager->persist($user);
        }

        // Création de compte User.
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($this->faker->name())
                ->setRoles(['ROLE_USER'])
                ->setPassword('test');

            $users[] = $user;
            $manager->persist($user);
        }

        // Création de 3 categories par défaut.
        for($c=0; $c < 3; $c++ ){
            $category = new category();
            if($c == 0) {
                $category->setName("Tout public");
            }
            if($c == 1) {
                $category->setName("Intermédiaire");
            }
            if($c == 2) {
                $category->setName("Expert");
            }
            $manager->persist($category);
        }

        // Games
        for ($i=0; $i < 50; $i++) {
            $game = new Game();
            // TODO: Manque ajout de la catégorie à la création.
//            $randomIdCat = mt_rand(0,2);
//            $randomCat = "";
//            if($randomIdCat == 0) $randomCat = "Tout public";
//            if($randomIdCat == 1) $randomCat = "Intermédiaire";
//            if($randomIdCat == 2) $randomCat = "Expert";

            $game->setName('Game Fixture ' . $this->faker->word())
                ->setFavoris(false)
                ->setMinPlayer($this->faker->numberBetween(1,8))
                ->setMaxPlayer($this->faker->numberBetween($game->getMinPlayer(),8))
                ->setMinPlayingTime(1)
                ->setMaxPlayingTime(5)
                ->setRules($this->faker->paragraph(2))
                ->setRuleVersion("0.0.0.0")
                ->setAge($this->faker->numberBetween(3,18))
                ->setDescription($this->faker->paragraph(3))
                ->setOnlineVersion("0.0.0.0");
            // TODO: Manque ajout de l'image.
            $manager->persist($game);
        }

        $manager->flush();
    }
}
