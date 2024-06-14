<?php

declare(strict_types=1);

namespace Htmxfony\Controller;

use Htmxfony\Response\HtmxRedirectResponse;
use Htmxfony\Response\HtmxRefreshResponse;
use Htmxfony\Response\HtmxResponse;
use Htmxfony\Response\HtmxStopPollingResponse;
use Htmxfony\Template\TemplateBlock;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Twig\TemplateWrapper;

trait HtmxControllerTrait
{

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Throwable
     */
    protected function htmxRenderBlock(TemplateBlock ...$blocks): HtmxResponse
    {
        $content = '';
        foreach ($blocks as $block) {
            /** @var TemplateWrapper $template */
            $template = $this->container->get('twig')->load($block->getTemplateFileName());
            if ($block->getBlockName()) {
                $content .= $template->renderBlock($block->getBlockName(), $block->getContext());
            } else {
                $content .= $template->render($block->getContext());
            }
        }

        return new HtmxResponse($content);
    }

    protected function htmxRender(string $view, array $parameters = [], Response $response = null): HtmxResponse
    {
        if ($response === null) {
            $response = new HtmxResponse();
        }

        return parent::render($view, $parameters, $response);
    }

    protected function htmxRedirect(string $url): HtmxRedirectResponse
    {
        return new HtmxRedirectResponse($url);
    }

    protected function htmxRefresh(): HtmxRefreshResponse
    {
        return new HtmxRefreshResponse();
    }

    protected function htmxStopPolling(): HtmxStopPollingResponse
    {
        return new HtmxStopPollingResponse();
    }

}
