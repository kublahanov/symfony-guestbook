<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ConferenceController extends AbstractController
{
    // #[Route('/hello/{name}', name: 'homepage')]
    // #[Route('/hello', name: 'homepage')]
    // public function +index(string $name = ''): Response
    // public function index(Request $request): Response
    #[Route('/', name: 'homepage')]
    public function index(ConferenceRepository $conferenceRepository): Response
    {
        // $greet = '';

        // if ($request->query->has('name')) {
        //     $greet = sprintf('<h1>Hello %s!</h1>', htmlspecialchars($request->query->get('name')));
        // }

        // dump($request);

        // return new Response(<<<EOF
        //     <html>
        //         <body>
        //             $greet
        //             <img src="/images/under-construction.gif" />
        //         </body>
        //     </html>
        //     EOF
        // );
        return $this->render('conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
        ]);
    }

    #[Route('/conference/{slug}', name: 'conference')]
    public function show(Request $request, Conference $conference, CommentRepository $commentRepository, ConferenceRepository $conferenceRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $commentRepository->getCommentPaginator($conference, $offset);

        return $this->render('conference/show.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
            'conference' => $conference,
            'comments' => $paginator,
            'previous' => $offset - CommentRepository::COMMENTS_PER_PAGE,
            'next' => min(count($paginator), $offset + CommentRepository::COMMENTS_PER_PAGE),
        ]);
    }
}
