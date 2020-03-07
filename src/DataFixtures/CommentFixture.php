<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;


class CommentFixture extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {


            for($i = 0; $i < 100; $i++) {
                /** @var Article $article */
                $article = $this->getReference(sprintf('article_%s', rand(0, 9)));

                $comment = new Comment();
                $comment->setAuthor($this->faker->name)
                    ->setText($this->faker->text)
                    ->setArticle($article)
                ;
                $manager->persist($comment);
            }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

}
