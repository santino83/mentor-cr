<?php
/**
 * Created by PhpStorm.
 * User: santino83
 * Date: 07/06/19
 * Time: 18.28
 */

namespace Santino83\CR\Resolver;


use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;

class ControllerResolver
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var UrlMatcherInterface
     */
    private $matcher;

    /**
     * ControllerResolver constructor.
     * @param UrlMatcherInterface $matcher
     */
    public function __construct(UrlMatcherInterface $matcher)
    {
        $this->matcher = $matcher;
    }

    public function resolve(Request $request): callable
    {
        $request->attributes->add($this->matcher->match($request->getPathInfo()));

        $callback = $request->attributes->get('_controller');

        $controllerClass = implode('',array_slice(explode('::', $callback),0,1));
        $controllerMethod = implode('',array_slice(explode('::', $callback),1,1));

        $reflectionClass = new \ReflectionClass($controllerClass);
        $instance = $reflectionClass->newInstance();

        if($instance instanceof ContainerAwareInterface){
            $instance->setContainer($this->container);
        }

        return [$instance, $controllerMethod];
    }

    /**
     * @required
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


}