<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Service\CommentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/comment')]
class CommentController extends AbstractController
{
    /**
     * @var CommentService
     */
    private CommentService $commentService;

    /**
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    #[Route('/new/{post}', name: 'app_comment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Post $post): Response
    {
        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentDTO = $form->getData();
            $commentDTO->post = $post;
            $this->commentService->createComment($commentDTO);
            return $this->redirectToRoute('app_post_show', ['id' => $post->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comment/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comment_show', methods: ['GET'])]
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }
}
