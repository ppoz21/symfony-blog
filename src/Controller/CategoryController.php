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

class CategoryController extends AbstractController
{

    private EntityManagerInterface $em;
    private Environment $twig;

    public function __construct(EntityManagerInterface $em, Environment $twig)
    {
        $this->em = $em;
        $this->twig = $twig;
    }

    public function categoryPage(string $slug, int $id): Response
    {
        /** @var Category $category */
        $category = $this->em->getRepository(Category::class)->find($id);

        if (!$category)
        {
            throw new NotFoundHttpException('Nie znaleziono kategorii');
        }

        if ($category->getSlug() !== $slug)
        {
            return new RedirectResponse($this->generateUrl('category_page', ['id' => $id, 'slug' => $category->getSlug()]));
        }


        /** @var Post[] $posts */
        $posts = $this->em->getRepository(Post::class)->findBy(['category' => $category], ['addDate'=>'DESC']);

        return new Response($this->twig->render('pages/homepage/index.html.twig', [
            'posts' => $posts,
            'category' => $category
        ]));

    }

    public function categories(): Response
    {

        /** @var Category[] $categories */
        $categories = $this->em->getRepository(Category::class)->findBy(['parent' => null]);

        return new Response($this->twig->render('pages/categories/categories.html.twig', [
            'categories' => $categories
        ]));

    }

}
