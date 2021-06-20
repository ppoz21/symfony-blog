<?php


namespace App\Controller;


use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ContactController extends AbstractController
{

    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function contact(Request $request): Response
    {

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        return new Response($this->twig->render('pages/contact/contact.html.twig', [
            'form' => $form->createView()
        ]));
    }

}
