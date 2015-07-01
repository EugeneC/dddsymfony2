<?php
namespace DDD\FrontendBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use DDD\CoreDomain\Page\Tags;

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