<?php
namespace Framework\Controller;

/**
 * -------------------------------
 * | VENDOR LIBRARIES
 * -------------------------------
 */
use Slim\Http\Response;

/**
 * Class SlimBase
 * @package Framework\Controller
 */
class SlimController extends Controller implements ControllerInterface
{
    /**
     * We wrap the base
     * @param Response $response
     * @param array $data
     * @param bool $merge
     * @return Response
     */
    public function response(Response $response, $data = [], $merge = false)
    {
        return $response->write($this->render($data, $merge));
    }
}