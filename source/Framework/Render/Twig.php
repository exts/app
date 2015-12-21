<?php
namespace Framework\Render;

/**
 * -------------------------------
 * | VENDOR CLASSES
 * -------------------------------
 */
use Twig_Environment;

/**
 * Twig Renderer
 * @package Framework\Render
 */
class Twig implements RenderInterface
{
    /**
     * @var Twig_Environment
     */
    protected $renderer;

    /**
     * initialize twig environment
     * @param Twig_Environment $renderer
     */
    public function __construct(Twig_Environment $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Render template & data
     * @param string $template
     * @param array $data
     * @return mixed
     */
    public function render(string $template, array $data = [])
    {
        return $this->renderer->render($template, $data);
    }
}