<?php
namespace DDD\FrontendBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use DDD\CoreDomain\Page\Tags;

/**
 * Class MetaTagsTransformer
 *
 * @package DDD\FrontendBundle\Form\DataTransformer
 */
class MetaTagsTransformer implements DataTransformerInterface
{
    /**
     * @param mixed $updatePageWithMetaTagsCommand
     *
     * @return mixed
     */
    public function transform($updatePageWithMetaTagsCommand)
    {
        return $updatePageWithMetaTagsCommand;
    }

    /**
     * @param mixed $updatePageWithMetaTagsCommand
     *
     * @return Tags|null
     */
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