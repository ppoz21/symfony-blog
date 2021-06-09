<?php


namespace App\Controller;


use App\Entity\Category;
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


        // TODO: Dodać render stronki z przekazaną kategorią :)
        return $this->render('pages/category/category.html.twig', [
            'category_name' => $category->getName()
        ]);

    }

}
