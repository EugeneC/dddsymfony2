<?php
namespace DDD\FrontendBundle\Form\DataTransformer;

use DDD\CoreDomain\DTO\AddPageCommand;
use DDD\CoreDomain\Page\Page;
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Sonata\DoctrineMongoDBAdminBundle\Model\ModelManager;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class PageTransformer
 *
 * @package DDD\FrontendBundle\Form\DataTransformer
 */
class PageTransformer implements DataTransformerInterface
{
    /**
     * @var ModelManager
     */
    private $em;

    /**
     * @param ModelManagerInterface $em
     */
    public function __construct(ModelManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param AddPageCommand $addPageCommand
     *
     * @return AddPageCommand
     */
    public function transform($addPageCommand)
    {
        return $addPageCommand;
    }

    /**
     * @param AddPageCommand $addPageCommand
     *
     * @return Page|null
     */
    public function reverseTransform($addPageCommand)
    {
        /** @var Page $page */
        $page = $this->em
            ->findOneBy('DDD\CoreDomain\Page\Page', ['id' => $addPageCommand->id]);
        if ($page === null) {
            return null;
        }

        return $page->update(
            $addPageCommand->withTitle,
            $addPageCommand->withBody,
            $addPageCommand->slug,
            $addPageCommand->tags,
            $addPageCommand->status
        );
    }
}