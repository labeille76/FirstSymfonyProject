<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $article = $this->getReference(AppFixtures::ARTICLE_WITH_COMMENTS);

        for ($i = 0; $i < 5; $i++) {
            $comment = new Comment();
            $comment->setName($faker->name($gender = 'female'));
            $comment->setEmail($faker->email);
            $comment->setCreatedAt($faker->dateTime($max = 'now', $timezone = null));
            $comment->setComment($faker->paragraph($nbSentences = 5, $variableNbSentences = true));
            $comment->setArticle($article);
            $article->addComment($comment);
            //$manager->persist($comment);
        }

        //$manager->flush();
    }

}
