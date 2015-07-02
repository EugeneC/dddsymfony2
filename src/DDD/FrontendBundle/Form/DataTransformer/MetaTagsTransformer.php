<?php
namespace DDD\FrontendBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use DDD\CoreDomain\Page\Tags;

class MetaTagsTransformer implements DataTransformerInterface
{
    public function transform($updatePageWithMetaTagsCommand)
    {
        return $updatePageWithMetaTagsCommand;
    }

    public function reverseTransform($updatePageWithMetaTagsCommand)
    {
        if ($updatePageWithMetaTagsCommand === null) {
            return null;
        }

        return new Tags(
            $updatePageWithMetaTagsCommand->description,
            $updatePageWithMetaTagsCommand->keywords
        );
    }
}