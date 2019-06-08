<?php
/**
 * Created by PhpStorm.
 * User: santino83
 * Date: 08/06/19
 * Time: 1.07
 */

namespace Santino83\CR\Templating;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigEngine implements EngineInterface
{

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var Environment
     */
    private $engine;

    /**
     * TwigEngine constructor.
     * @param string $baseURI
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(string $baseURI, UrlGeneratorInterface $urlGenerator)
    {

        $loader = new FilesystemLoader($baseURI);
        $this->engine = new Environment($loader);

        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @inheritDoc
     */
    public function render(string $viewName, array $data = []): string
    {
        return $this->engine->render($viewName, array_merge($this->getDefaults(), $data));
    }

    protected function getDefaults(): array
    {
        return ['urlGenerator' => $this->urlGenerator];
    }

}