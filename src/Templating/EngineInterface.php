<?php
/**
 * Created by PhpStorm.
 * User: santino83
 * Date: 07/06/19
 * Time: 16.05
 */

namespace Santino83\CR\Templating;


interface EngineInterface
{

    /**
     * Renders a view
     *
     * @param string $viewName the view name
     * @param array $data the view data
     * @return string the rendered view
     */
    public function render(string $viewName, array $data = []): string;

}