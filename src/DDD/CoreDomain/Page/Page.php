<?php

namespace DDD\CoreDomain\Page;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique;

/**
 * DDD\CoreDomain\Page\Page
 *
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 * //Unique(fields="slug")
 */
class Page
{
    /**
     * @var MongoId $id
     *
     */
    protected $id;

    /**
     * @var string $title
     *
     * @ODM\Field(name="title", type="string")
     */
    protected $title;

    /**
     * @var raw $body
     *
     * @ODM\Field(name="body", type="raw")
     */
    protected $body;

    /**
     * @var string $slug
     *
     * @ODM\Field(name="slug", type="string")
     * //Assert\NotBlank()
     */
    protected $slug;

    /**
     * @var Tags $tags
     */
    protected $tags;

    /**
     * @var Status $status
     */
    protected $status;

    /**
     * Construct Page object
     *
     * @param string $title
     * @param string $body
     * @param string $slug
     * @param Tags $tags
     * @param Status $status
     */
    public function __construct($title, $body, $slug, Tags $tags, Status $status)
    {
        $this->id     = new \MongoId();
        $this->title  = $title;
        $this->body   = $body;
        $this->slug   = $slug;
        $this->tags   = $tags;
        $this->status = $status;
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get body
     *
     * @return raw $body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get tags
     *
     * @return string $tagDescription
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Get current status
     *
     * @return Status $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function publish()
    {
        $this->status = new Status(Statuses::PUBLISH);
    }

    public function draft()
    {
        $this->status = new Status(Statuses::DRAFT);
    }
}
