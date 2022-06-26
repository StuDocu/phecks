<?php

namespace Juampi92\Phecks\Domain\Violations;

use Juampi92\Phecks\Domain\DTOs\FileMatch;

class Violation
{
    private string $identifier;

    private ?string $explanation;

    private ?FileMatch $file = null;

    public function __construct(
        string $identifier,
        ?string $explanation = null,
    ) {
        $this->identifier = $identifier;
        $this->explanation = $explanation;
    }

    public function setFile(FileMatch $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getTarget(): string
    {
        return $this->file->file;
    }

    public function getLocation(): ?string
    {
        return sprintf(
            '%s%s%s',
            $this->file->file,
            $this->file->line ? ":{$this->file->line}" : '',
            $this->file->method ? " @{$this->file->method}" : '',
        );
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getExplanation(): ?string
    {
        return $this->explanation;
    }
}
