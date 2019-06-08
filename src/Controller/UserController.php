<?php
/**
 * Created by PhpStorm.
 * User: santino83
 * Date: 08/06/19
 * Time: 1.19
 */

namespace Santino83\CR\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    /**
     * Renders the user homepage
     *
     * @param Request $request
     * @return Response
     */
    public function getUserAction(Request $request): Response
    {
        $username = $request->get('username');

        $requestedFormat = $request->headers->get('accept','text/html');

        if($requestedFormat === 'application/json'){
            return new Response(json_encode(['hello' => $username]), Response::HTTP_OK, ['content-type' => 'application/json']);
        }else{
            return $this->renderView('user.twig', ['username' => $username]);
        }

    }

}