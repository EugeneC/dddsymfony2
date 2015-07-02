<?php
namespace DDD\FrontendBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Sonata\DoctrineMongoDBAdminBundle\Model\ModelManager;
use DDD\CoreDomain\DTO\UpdatePageWithStatusCommand;
use DDD\CoreDomain\DTO\UpdatePageWithMetaTagsCommand;
use DDD\CoreDomain\Page\Page;

class PageTransformer implements DataTransformerInterface
{
    /**
     * @var ModelManager
     */
    private $em;

    /**
     * @param ModelManager $em
     */
    public function __construct(ModelManager $em)
    {
        $this->em = $em;
    }

    public function transform($addPageCommand)
    {
        return $addPageCommand;
    }

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
            $addPageCommand->tags ? $addPageCommand->tags : new UpdatehPageWithMetaTagsCommand(),
            $addPageCommand->status ? $addPageCommand->status : new UpdatePageWithStatusCommand()
        );
    }
}