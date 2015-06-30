<?php
namespace Codeception\Module;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Helper\HelperSet;

class CommandHelper extends \Codeception\Module
{
    /**
     * @var CommandTester
     */
    private $commandTester;

    /**
     * @param ContainerAwareCommand $command
     * @param string                $name
     * @param array                 $args
     *
     * @throws \Codeception\Exception\Module
     */
    public function runCommand(ContainerAwareCommand $command, $name, array $args = [], array $answers = [])
    {
        $command->setContainer($this->getModule('Symfony2')->container);

        $application = new Application();
        $application->add($command);

        $command             = $application->find($name);
        $this->commandTester = new CommandTester($command);

        if ($answers !== null) {
            $helper = $command->getHelper('question');
            $stream = '';
            foreach ($answers as $answer) {
                $stream .=  $answer.PHP_EOL;
            }
            $helper->setInputStream($this->getInputStream($stream));
        }
        $this->commandTester->execute(
            ['command' => $command->getName()] + $args
        );
    }

    /**
     * @param string $text
     *
     * @throws \Codeception\Exception\Module
     */
    public function seeInCommandOutput($text)
    {
        \PHPUnit_Framework_Assert::assertContains($text, $this->commandTester->getDisplay());
    }

    protected function getInputStream($input)
    {
        $stream = fopen('php://memory', 'r+', false);
        fputs($stream, $input);
        rewind($stream);

        return $stream;
    }
}
