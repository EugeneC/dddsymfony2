<?php
namespace DDD\FrontendBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use DDD\CoreDomain\DTO\PublishPageCommand;
use DDD\CoreDomain\DTO\AddMetaTagsCommand;

class PageTransformer implements DataTransformerInterface
{
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
            $addPageCommand->tags ? $addPageCommand->tags : new AddMetaTagsCommand(),
            $addPageCommand->status ? $addPageCommand->status : new PublishPageCommand()
        );
    }
}