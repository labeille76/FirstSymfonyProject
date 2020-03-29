<?php

namespace App\Controller;

require_once(dirname(dirname(__FILE__)) . '/Entity/Article.php');
use App\Entity\Article;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class HomeController extends AbstractController
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $articles = $this->articleRepository->findLast(4);

        return $this->render('home/index.html.twig', [
            'articles' => $articles
        ]);
    }

}
