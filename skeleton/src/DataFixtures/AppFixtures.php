<?php

namespace App\DataFixtures;

require_once(dirname(dirname(__FILE__)) . '/Entity/Article.php');
use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public const ARTICLE_WITH_COMMENTS = 'article-with-comments';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setTitle($faker->sentence($nbWords = 3, $variableNbWords = false));
            $article->setSubtitle($faker->sentence($nbWords = 5, $variableNbWords = false));
            $article->setCreatedAt($faker->dateTime($max = 'now', $timezone = null));
            $article->setAuthor($faker->name($gender = 'female'));
            $article->setBody($faker->paragraph($nbSentences = 5, $variableNbSentences = true));
            $article->setImage("/img");
            $manager->persist($article);
        }

        $article = new Article();
        $article->setTitle('Article de test avec commentaires');
        $article->setSubtitle($faker->sentence($nbWords = 5, $variableNbWords = false));
        $article->setCreatedAt(new \DateTime());
        $article->setAuthor($faker->name($gender = 'female'));
        $article->setBody($faker->paragraph($nbSentences = 5, $variableNbSentences = true));
        $article->setImage("/img");
        $manager->persist($article);


        for ($i = 0; $i < 5; $i++) {
            $comment = new Comment();
            $comment->setName($faker->name($gender = 'female'));
            $comment->setEmail($faker->email);
            $comment->setCreatedAt($faker->dateTime($max = 'now', $timezone = null));
            $comment->setComment($faker->paragraph($nbSentences = 5, $variableNbSentences = true));
            $comment->setArticle($article);
            $article->addComment($comment);
            $manager->persist($comment);
        }

        $manager->flush();
    }
}
