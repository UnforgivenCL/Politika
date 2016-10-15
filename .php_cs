<?php
$finder = Symfony\CS\Finder\DefaultFinder::create()
    // ->exclude('')
    ->in(__DIR__);

return Symfony\CS\Config\Config::create()
    // ->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->fixers(['-psr0'])
    ->finder($finder);
