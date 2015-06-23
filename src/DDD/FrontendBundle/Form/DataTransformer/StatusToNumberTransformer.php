<?php
namespace DDD\FrontendBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use DDD\CoreDomain\Page\Page;
use Sonata\DoctrineMongoDBAdminBundle\Model\ModelManager;

class StatusToNumberTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ModelManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($array)
    {
        if (null === $issue) {
            return "";
        }

        return $issue->getNumber();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $number
     *
     * @return Issue|null
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($number)
    {
        if (!$number) {
            return null;
        }

        $issue = $this->om
            ->getRepository('AcmeTaskBundle:Issue')
            ->findOneBy(array('number' => $number));

        if (null === $issue) {
            throw new TransformationFailedException(
                sprintf(
                    'An issue with number "%s" does not exist!',
                    $number
                )
            );
        }

        return $issue;
    }
}