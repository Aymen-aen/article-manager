<?php
namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Form\ArtType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/", name="artilce_list")
     */

    public function article_list(EntityManagerInterface $em, PaginatorInterface $paginator, Request $request)
    {
        $dql   = "SELECT a FROM App:Article a";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),5
        );


        return $this->render('index.html.twig', ['pagination' => $pagination]);
    }


    /**
     * @Route("/{id}/show", name="article_show")
     * @param Article $article
     * @return Response
     */
    public function show(Article $article): Response
    {
        return $this->render("article/show.html.twig", [
            "article" => $article
        ]);
    }

    /**
     * @Route("/article/new", name="article_new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_list');

        }
        return $this->render('article/new.html.twig', [
            "form" => $form->createView()
        ]);

    }

    /**
     * @Route("article/{id}/edit", name="article_edit")
     * @param Article $article
     * @param Request $request
     * @return Response
     */

    public function edit(Article $article, Request $request): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('article_list');
        }
        return $this->render("article/edit.html.twig", [
            "form" => $form->createView()
        ]);
    }


    /**
     * @Route("/article/{id}/delete", name="article_delete")
     * @param Article $article
     * @return RedirectResponse
     */
    public function delete(Article $article): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute("article_list");
    }
}




