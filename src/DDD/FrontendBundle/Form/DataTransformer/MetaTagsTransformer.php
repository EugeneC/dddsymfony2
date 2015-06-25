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

class MetaTagsTransformer implements DataTransformerInterface
{
    public function transform($addMetaTagsCommand)
    {
        return $addMetaTagsCommand;
    }

    public function reverseTransform($addMetaTagsCommand)
    {
        if ($addMetaTagsCommand === null) {
            return null;
        }

        return new Tags(
            $addMetaTagsCommand->description,
            $addMetaTagsCommand->keywords
        );
    }
}