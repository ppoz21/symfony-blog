<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class MainController extends AbstractController
{
    private EntityManagerInterface $em;
    private Environment $twig;

    public function __construct(EntityManagerInterface $em, Environment $twig)
    {
        $this->em = $em;
        $this->twig = $twig;
    }

    public function homepage(Request $request): Response
    {
        /** @var Post[] $posts */
        $posts = $this->em->getRepository(Post::class)->findBy([], ['addDate'=>'DESC'], 5);

        return new Response($this->twig->render('pages/homepage/index.html.twig', [
            'posts' => $posts
        ]));
    }
}
