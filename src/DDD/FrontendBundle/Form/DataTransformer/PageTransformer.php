<?php
namespace DDD\FrontendBundle\Form\DataTransformer;

use DDD\CoreDomain\DTO\PublishPageCommand;
use DDD\CoreDomain\Page\Tags;
use DDD\CoreDomain\Page\Status;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use DDD\CoreDomain\Page\Page;
use Sonata\DoctrineMongoDBAdminBundle\Model\ModelManager;

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
        if ($addPageCommand === null) {
            return null;
        }

        return new Page(
            $addPageCommand->withTitle,
            $addPageCommand->withBody,
            $addPageCommand->slug,
            $addPageCommand->tags ? $addPageCommand->tags : new AddMetaTags(),
            $addPageCommand->status ? $addPageCommand->status : new PublishPageCommand()
        );
    }
}