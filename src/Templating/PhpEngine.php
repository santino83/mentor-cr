<?php
/**
 * Created by PhpStorm.
 * User: santino83
 * Date: 08/06/19
 * Time: 0.58
 */

namespace Santino83\CR\Templating;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PhpEngine implements EngineInterface
{

    /**
     * @var string
     */
    private $baseURI;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * PhpEngine constructor.
     * @param string $baseURI
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(string $baseURI, UrlGeneratorInterface $urlGenerator)
    {
        $this->baseURI = $baseURI;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @inheritDoc
     */
    public function render(string $viewName, array $data = []): string
    {
        $viewFullPath = $this->baseURI.DIRECTORY_SEPARATOR.$viewName;

        ob_start();
        extract(array_merge(['urlGenerator' => $this->urlGenerator], $data));
        include $viewFullPath;

        return ob_get_clean();
    }

}