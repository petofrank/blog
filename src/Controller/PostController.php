<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Service\PostService;
use App\Utils\Paginator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post')]
class PostController extends AbstractController
{
    /**
     * @var PostService
     */
    private PostService $postService;

    /**
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @param Request $request
     * @param Paginator $paginator
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route('/', name: 'app_post_index', methods: ['GET'])]
    public function index(Request $request, Paginator $paginator, EntityManagerInterface $em): Response
    {
        $query = $em->getRepository(Post::class)->findByExampleField();
        $paginator->paginate($query, $request->query->getInt('page', 1));

        return $this->render('post/index.html.twig', [
            'paginator' => $paginator,
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/new', name: 'app_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postDTO = $form->getData();
            $post = $this->postService->createPost($postDTO);
            return $this->redirectToRoute('app_post_index', ['postId' => $post->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('post/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_show', methods: ['GET'])]
    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }
}
