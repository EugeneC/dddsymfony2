<?php
namespace DDD\FrontendBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use DDD\CoreDomain\Page\Status;

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