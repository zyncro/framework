<?php

namespace Zyncro\Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class App implements HttpKernelInterface
{
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        switch ($request->getPathInfo()) {
            case '/':
                $response = new Response('This is the website home');
                break;

            case '/about':
                $response = new Response('This is the about page');
                break;

            default:
                $response = new Response('Not found !', Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
}