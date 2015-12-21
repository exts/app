<?php
namespace Framework\Render;

/**
 * View Object for Rendering Templates
 * @package Framework\Render
 */
class View
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $template;

    /**
     * @var RenderInterface
     */
    protected $renderer;

    /**
     * @var string
     */
    protected $extension = '.twig';

    /**
     * View constructor.
     * @param RenderInterface $renderer
     */
    public function __construct(RenderInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param string $template
     * @return View
     */
    public function factory(string $template)
    {
        $factory = new static($this->renderer);
        $factory->setTemplate($template);

        return $factory;
    }

    /**
     * @param string $template
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    /**
     * @param array $data
     * @param bool $merge
     * @return mixed
     * @throws \Exception
     */
    public function render(array $data = [], bool $merge = false)
    {
        if(empty($this->template)) {
            throw new \Exception("Please set a template to render");
        }

        $data = $merge === true ? array_merge($this->data, $data) : $data;
        $data = empty($data) ? $this->data : $data;

        if(!preg_match(sprintf('#%s$#i', preg_quote($this->extension)), $this->template)) {
            $this->template .= $this->extension;
        }

        return $this->renderer->render($this->template, $data);
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @return mixed|string
     */
    public function __toString()
    {
        try {
            return $this->render();
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }
}