<?php
namespace DDD\CoreDomain\DTO;

class AddPageCommand
{
    public $id;
    public $slug;
    public $withTitle;
    public $withBody;
    public $tags;
    public $status;

    public function __toString()
    {
        return ($this->withTitle !== null) ? $this->withTitle : 'New';
    }
}