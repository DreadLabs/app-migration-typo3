<?php

/*
 * This file is part of the `DreadLabs/app-migration-typo3` project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

require_once __DIR__.'/vendor/autoload.php';

$header = <<<EOF
This file is part of the `DreadLabs/app-migration-typo3` project.

It is free software; you can redistribute it and/or modify it under
the terms of the GNU General Public License, either version 2
of the License, or any later version.

For the full copyright and license information, please read the
LICENSE.txt file that was distributed with this source code.

The TYPO3 project - inspiring people to share!
EOF;

return PhpCsFixer\Config::create()
    ->setRules(
        [
            '@PSR2' => true,
            'header_comment' => [
                'header' => $header,
            ],
            'blank_line_after_opening_tag' => false,
            'no_blank_lines_before_namespace' => true,
            'ordered_imports' => true,
            'phpdoc_order' => true,
            'array_syntax' => [
                'syntax' => 'short',
            ],
        ]
    )
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__)
    )
;
