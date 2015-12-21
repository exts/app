<?php
namespace App\Controllers;

/**
 * -------------------------------
 * | VENDOR LIBRARIES
 * -------------------------------
 */
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * -------------------------------
 * | LOCAL LIBRARIES
 * -------------------------------
 */
use Framework\Controller\SlimController;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController extends SlimController
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function index(Request $request, Response $response, $args = [])
    {
        $this->setContent('John Doe');
         return $this->response($response);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function admin(Request $request, Response $response, $args = [])
    {
        $this->setContent('John Admin');

        return $this->response($response);
    }
}