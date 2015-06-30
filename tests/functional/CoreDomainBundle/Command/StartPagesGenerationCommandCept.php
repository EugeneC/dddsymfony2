<?php
$I = new FunctionalTester($scenario);
$I->wantTo('Create simple pages using command');

$I->amGoingTo('Run console command');

$I->runCommand(
    new \DDD\CoreDomainBundle\Command\StartPagesGenerationCommand(),
    'start:pages:generate'
);

$I->seeInCommandOutput('Pages successfully generated');

$I->seeInCollection(
    'Page',
    ['slug' => 'home']
);
$I->seeInCollection(
    'Page',
    ['slug' => 'new']
);
$I->seeInCollection(
    'Page',
    ['slug' => 'about-us']
);