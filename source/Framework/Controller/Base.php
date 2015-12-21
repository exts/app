<?php
namespace Framework\Controller;

/**
 * -------------------------------
 * | LIBRARY CLASSES
 * -------------------------------
 */
use Framework\Render\View;

/**
 * @package Framework\Controller
 */
class Controller implements ControllerInterface
{
    /**
     * @var View
     */
    protected $view;

    /**
     * @var string
     */
    protected $layout = 'layouts/template';

    /**
     * @var View
     */
    protected $template;

    /**
     * Base constructor.
     * @param View $view
     */
    public function __construct(View $view)
    {
        $this->view     = $view;
        $this->template = $view->factory($this->layout);
    }

    /**
     * debug info, trim objects down
     * @return array
     */
    public function __debugInfo()
    {
        return [
            'view' => (get_class($this->view) ?? null),
            'template' => (get_class($this->view) ?? null),
            'layout' => $this->layout,
        ];
    }

    /**
     * @param $data
     */
    public function setContent($data)
    {
        $this->template->content = $data;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->template->title = $title;
    }

    /**
     * @param array $data
     * @param bool $merge
     * @return mixed
     * @throws \Exception
     */
    public function render(array $data = [], bool $merge = false)
    {
        return $this->template->render($data, $merge);
    }
}