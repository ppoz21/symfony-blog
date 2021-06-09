<?php


namespace App\Controller;


use App\Entity\Category;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment;

class PostController extends AbstractController
{

    private EntityManagerInterface $em;
    private Environment $twig;

    public function __construct(EntityManagerInterface $em, Environment $twig)
    {
        $this->em = $em;
        $this->twig = $twig;
    }

    public function postPage(string $slug, int $id): Response
    {
        /** @var Post $category */
        $post = $this->em->getRepository(Post::class)->find($id);

        if (!$post)
        {
            throw new NotFoundHttpException('Nie znaleziono wpisu');
        }

        if ($post->getSlug() !== $slug)
        {
            return new RedirectResponse($this->generateUrl('post_page', ['id' => $id, 'slug' => $category->getSlug()]));
        }


        return new Response($this->twig->render('pages/post-page/post-page.html.twig', [
            'post' => $post
        ]));

    }

}
