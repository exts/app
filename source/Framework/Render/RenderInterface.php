<?php
namespace Framework\Render;

/**
 * Render Interface
 * @package Framework\Render
 */
interface RenderInterface
{
    public function render(string $template, array $data = []);
}