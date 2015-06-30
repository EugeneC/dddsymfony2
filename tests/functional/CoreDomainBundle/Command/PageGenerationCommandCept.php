<?php
use DDD\CoreDomain\Page\Statuses;

$I = new FunctionalTester($scenario);
$I->wantTo('Create custom page using command');

$I->amGoingTo('Run console command');

$I->runCommand(
    new \DDD\CoreDomainBundle\Command\PageGenerationCommand(),
    'page:generate',
    [],
    [
        'title',
        'body',
        PAGE_GENERATION_COMMAND_SLUG,
        Statuses::PUBLISH,
        'test description',
        'key, words, test'
    ]
);

$I->seeInCommandOutput('Page successfully generated');

$I->seeInCollection(
    'Page',
    [
        'slug' => PAGE_GENERATION_COMMAND_SLUG
    ]
);