<?php

namespace App\Entity;

class Page
{
    /** @var int */
    private int $page = 1;

    /** @var string */
    private string $q = "";
    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(int $page): static
    {
        $this->page = $page;

        return $this;
    }

    public function getQ(): ?string
    {
        return $this->q;
    }

    public function setQ(string $q): static
    {
        $this->q = $q;

        return $this;
    }
}
