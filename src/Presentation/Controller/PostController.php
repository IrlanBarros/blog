<?php

namespace App\Presentation\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Domain\Entity\Post;
use App\Domain\Exception\PostException;
use App\Application\UseCase\Post\CreatePostUseCase;

class PostController extends AbstractController
{
    private CreatePostUseCase $createPostUseCase;

    public function __construct(CreatePostUseCase $createPostUseCase)
    {
        $this->createPostUseCase = $createPostUseCase;
    }

    public function store(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $title = $data['title'] ?? null;
        $content = $data['content'] ?? null;

        if (empty(trim((string) $title)) || empty(trim((string) $content))) {
            return new JsonResponse([
                'error' => 'The title and content properties cannot be empty.'
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $post = new Post((string)$title, (string)$content);
            // UseCase deve retornar um DTO ou domain com id — ajuste conforme sua implementação
            $created = $this->createPostUseCase->execute($post);

            // Se execute() retornar um DTO com getId/getTitle/getContent:
            return new JsonResponse([
                'id' => $created->getId(),
                'title' => $created->getTitle(),
                'content' => $created->getContent(),
            ], Response::HTTP_CREATED);
        } catch (PostException $e) {
            // Validação de domínio — responde 400
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            // Erro inesperado — log e 500
            // $this->get('logger')->error($e->getMessage());
            return new JsonResponse(['error' => 'Internal server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index()
    {
        return new Response(
            '<html><body><h1>Testando!</h1></body></html>'
        );
    }
}
