<?php
namespace DDD\FrontendBundle\Form\DataTransformer;

use DDD\CoreDomain\DTO\PublishPageCommand;
use DDD\CoreDomain\Page\Status;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class PublishPageTransformer implements DataTransformerInterface
{
    public function transform($publishPageCommand)
    {
        return $publishPageCommand;
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