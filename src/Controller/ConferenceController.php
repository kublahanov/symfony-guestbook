<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ConferenceController extends AbstractController
{
    #[Route('/hello/{name}', name: 'homepage')]
    // public function index(string $name = ''): Response
    public function index(Request $request): Response
    {
        $greet = '';

        // if ($name) {
        //     $greet = sprintf('<h1>Hello %s!</h1>', htmlspecialchars($name));
        // }

        dump($request);

        return new Response(<<<EOF
            <html>
                <body>
                    $greet
                    <img src="/images/under-construction.gif" />
                </body>
            </html>
            EOF
        );
    }
}
