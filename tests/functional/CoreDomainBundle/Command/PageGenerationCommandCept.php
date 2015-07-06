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
        TITLE,
        BODY,
        SLUG,
        Statuses::PUBLISH,
        DESCRIPTION,
        KEYWORDS
    ]
);

$I->seeInCommandOutput('Page successfully generated');

$I->seeInCollection(
    'Page',
    [
        'slug' => SLUG
    ]
);