<?php
namespace DDD\FrontendBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use DDD\CoreDomain\Page\Status;

class StatusTransformer implements DataTransformerInterface
{
    public function transform($updatePageWithStatusCommand)
    {
        return $updatePageWithStatusCommand;
    }

    public function reverseTransform($updatePageWithStatusCommand)
    {
        if ($updatePageWithStatusCommand === null) {
            return null;
        }

        return new Status(
            $updatePageWithStatusCommand->name
        );
    }
}