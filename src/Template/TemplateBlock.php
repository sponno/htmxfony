<?php

declare(strict_types=1);

namespace Htmxfony\Template;

class TemplateBlock
{

    private $templateFileName;

    private $blockName;

    private $context;

    public function __construct(string $templateFileName, ?string $blockName = null, array $context = [])
    {
        $this->templateFileName = $templateFileName;
        $this->blockName = $blockName;
        $this->context = $context;
    }

    public function getTemplateFileName(): string
    {
        return $this->templateFileName;
    }

    public function getBlockName(): ?string
    {
        return $this->blockName;
    }

    public function getContext(): array
    {
        return $this->context;
    }

}
