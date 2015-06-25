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

class PublishPageTransformer implements DataTransformerInterface
{
    public function transform($createPageCommand)
    {
        return $createPageCommand;
    }

    public function reverseTransform($publishPageCommand)
    {
        if ($publishPageCommand === null) {
            return null;
        }

        return new Status(
            $publishPageCommand->name
        );
    }
}