<?php
namespace DDD\CoreDomain\DTO;

/**
 * Class AddPageCommand
 *
 * @package DDD\CoreDomain\DTO
 */
class AddPageCommand
{
    public $id;
    public $slug;
    public $withTitle;
    public $withBody;
    public $tags;
    public $status;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->withTitle;
    }
}