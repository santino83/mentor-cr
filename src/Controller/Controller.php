<?php
/**
 * Created by PhpStorm.
 * User: santino83
 * Date: 08/06/19
 * Time: 0.30
 */

namespace Santino83\CR\Controller;


use Santino83\CR\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller implements ContainerAwareInterface
{

    /**
     * @var EngineInterface
     */
    private $engine;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->engine = $this->container->get('template.engine'); // EngineInterface
    }


    protected function renderView(string $viewName, array $viewData = []): Response
    {
        $content = $this->engine->render($viewName, $viewData);
        return new Response($content, Response::HTTP_OK, ['content-type' => 'text/html']);
    }

}