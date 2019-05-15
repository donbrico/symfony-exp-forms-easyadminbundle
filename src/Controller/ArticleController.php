<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $articleRepository, $markdown;

    public function __construct(ArticleRepository $articleRepository, MarkdownParserInterface $markdown)
    {
        $this->articleRepository = $articleRepository;
        $this->markdown = $markdown;
    }

    /**
     * @Route("/article", name="article")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(Request $request)
    {
        $start = $request->get('start', 0);
        $limit = $request->get('limit', 10);
        $articles = $this->articleRepository->all($start, $limit);

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_detail")
     */
    public function detail(int $id, Request $request, EntityManagerInterface $em)
    {
        $article = $this->articleRepository->get($id);
        $back = $this->generateUrl('article');
        $form = $this->createForm(CommentFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if($data = $form->getData()) {
                # $comment = new Comment();
                # $comment->setText($data->text);
                # $comment->setName($data->name);
                # $comment->setEmail($data->email);
                $data->setArticle($article);
                $em->persist($data);
                $em->flush();

                return $this->redirectToRoute('article_detail', [
                    'id'=>$id
                ]);
            }
        }

        return $this->render('article/detail.html.twig', [
            'title'=>$article->getTitle(),
            'content'=>$this->markdown->transformMarkdown($article->getContent()),
            'comments'=>$article->getComments(),
            'back'=>$back,
            'form'=>$form->createView()
        ]);
    }
}
