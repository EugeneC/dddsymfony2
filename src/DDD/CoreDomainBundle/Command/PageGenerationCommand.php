<?php

namespace DDD\CoreDomainBundle\Command;

use DDD\CoreDomain\Page\Statuses;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;


/**
 * Class PageGenerationCommand
 *
 * @package DDD\CoreDomainBundle\Command
 */
class PageGenerationCommand extends ContainerAwareCommand
{
    /**
     * Configure command
     */
    protected function configure()
    {
        $this
            ->setName('page:generate')
            ->setDescription('Generates page')
            ->addArgument(
                'title',
                InputArgument::OPTIONAL,
                'Page title'
            )
            ->addArgument(
                'body',
                InputArgument::OPTIONAL,
                'Page body'
            )
            ->addArgument(
                'slug',
                InputArgument::OPTIONAL,
                'Page slug'
            )
            ->addArgument(
                'status',
                InputArgument::OPTIONAL,
                'Page status'
            )
            ->addArgument(
                'description',
                InputArgument::OPTIONAL,
                'Tag description'
            )
            ->addArgument(
                'keywords',
                InputArgument::OPTIONAL,
                'Tag keywords'
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper              = $this->getHelper('question');
        $questionTitle       = $this->addNotEmptyValidator(new Question('Please enter the title of the page: '));
        $questionBody        = $this->addNotEmptyValidator(new Question('Please enter the body of the page: '));
        $questionSlug        = $this->addNotEmptyValidator(new Question('Please enter the slug of the page: '));
        $questionStatus      = new ChoiceQuestion(
            'Please enter the status of the page: ',
            Statuses::getAsArray(),
            Statuses::PUBLISH
        );
        $questionDescription = new Question('Please enter the tag "description" of the page: ');
        $questionKeywords    = new Question('Please enter the tag "keywords" of the page: ');
        $title               = $helper->ask($input, $output, $questionTitle);
        $body                = $helper->ask($input, $output, $questionBody);
        $slug                = $helper->ask($input, $output, $questionSlug);
        $status              = $helper->ask($input, $output, $questionStatus);
        $description         = $helper->ask($input, $output, $questionDescription);
        $keywords            = $helper->ask($input, $output, $questionKeywords);
        $this->getContainer()->get('page_service')->add(
            $title,
            $body,
            $slug,
            $status,
            $description,
            $keywords
        );
        $output->writeln('['.(new \DateTime())->format('c').'] Page successfully generated');
    }

    /**
     * @param Question $question
     *
     * @return mixed
     */
    public function addNotEmptyValidator($question)
    {
        $question->setMaxAttempts(3);
        $question->setValidator(
            function ($value) {
                if (trim($value) == '') {
                    throw new \Exception('The field can not be empty');
                }

                return $value;
            }
        );

        return $question;
    }
}