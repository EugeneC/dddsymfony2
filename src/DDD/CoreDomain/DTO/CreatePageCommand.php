<?php
namespace DDD\CoreDomain\DTO;

class CreatePageCommand
{
    public $id;
    public $slug;
    public $withTitle;
    public $withBody;
    public $tags;
    public $status;
}