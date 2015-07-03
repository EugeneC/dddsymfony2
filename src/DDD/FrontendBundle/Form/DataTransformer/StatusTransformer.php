<?php
namespace DDD\FrontendBundle\Form\DataTransformer;

use DDD\CoreDomain\Page\Status;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class StatusTransformer
 *
 * @package DDD\FrontendBundle\Form\DataTransformer
 */
class StatusTransformer implements DataTransformerInterface
{
    /**
     * @param mixed $updatePageWithStatusCommand
     *
     * @return mixed
     */
    public function transform($updatePageWithStatusCommand)
    {
        return $updatePageWithStatusCommand;
    }

    /**
     * @param mixed $updatePageWithStatusCommand
     *
     * @return Status|null
     */
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