<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixture extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);


        $this->createMany(10, function($count) use ($manager) {
           $article = new Article();
           $article->setTitle(substr($this->faker->text, 0,20))
           ->setAuthor($this->faker->name)
           ->setText($this->faker->text)
           ->setCreatedAt($this->faker->dateTime)
           ->setUpdatedAt($this->faker->dateTime);

           return $article;
        });

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */

}
