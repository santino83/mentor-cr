<?php
/**
 * Created by PhpStorm.
 * User: santino83
 * Date: 08/06/19
 * Time: 1.31
 */

$containerBuilder = new \Symfony\Component\DependencyInjection\ContainerBuilder();

$containerBuilder->register('context', \Symfony\Component\Routing\RequestContext::class)
    ->setPublic(true);

$containerBuilder->register('matcher', \Symfony\Component\Routing\Matcher\UrlMatcher::class)
    ->setArguments(['%routes%', new \Symfony\Component\DependencyInjection\Reference('context')]);
$containerBuilder->setAlias(\Symfony\Component\Routing\Matcher\UrlMatcherInterface::class, 'matcher');

$containerBuilder->register('url.generator', \Symfony\Component\Routing\Generator\UrlGenerator::class)
    ->setArguments(['%routes%', new \Symfony\Component\DependencyInjection\Reference('context')]);

$containerBuilder->autowire(\Santino83\CR\Resolver\ControllerResolver::class)
    ->setPublic(true);

$containerBuilder->register('template.engine', \Santino83\CR\Templating\TwigEngine::class)
    ->setArguments(['%base_template_uri%', new \Symfony\Component\DependencyInjection\Reference('url.generator')])
    ->setPublic(true);

$containerBuilder->setAlias(\Santino83\CR\Templating\EngineInterface::class, 'template.engine')
    ->setPublic(true);

return $containerBuilder;