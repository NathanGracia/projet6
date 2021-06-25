<?php

namespace App\Twig;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class RouteExtension extends AbstractExtension
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('routeNameBeginWith', [$this, 'routeNameBeginWith']),
        ];
    }

    public function routeNameBeginWith(string $pattern)
    {
        return str_contains($this->requestStack->getCurrentRequest()->attributes->get('_route'), $pattern);
    }
}
