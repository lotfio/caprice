<?php

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     1.0.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2019
 * @license     MIT
 * @link        https://github.com/lotfio/caprice
 *
 */

$caprice->directive('#if', Caprice\Directives\IfDirective::class);
$caprice->directive('#endif', Caprice\Directives\EndIfDirective::class);

$caprice->directive('{{', Caprice\Directives\EchoOpenDirective::class);
$caprice->directive('}}', Caprice\Directives\EchoCloseDirective::class);

$caprice->directive('#dump', Caprice\Directives\DumpDirective::class);

$caprice->directive('#for', Caprice\Directives\ForDirective::class);
$caprice->directive('#endforin', Caprice\Directives\EndForInDirective::class);
$caprice->directive('#endfor', Caprice\Directives\EndForDirective::class);

$caprice->directive('#while', Caprice\Directives\WhileDirective::class);
$caprice->directive('#endwhile', Caprice\Directives\EndWhileDirective::class);

$caprice->directive('#do', Caprice\Directives\DoWhileDirective::class);
$caprice->directive('#enddo', Caprice\Directives\EndDoWhileDirective::class);

$caprice->directive('#break', Caprice\Directives\EndDoWhileDirective::class);
$caprice->directive('#continue', Caprice\Directives\EndDoWhileDirective::class);

$caprice->directive('#extends', Caprice\Directives\ExtendsDirective::class);
$caprice->directive('#yield', Caprice\Directives\YieldDirective::class);

$caprice->directive('/#section\s*\((.*?)\)(.*?)#endsection/s', Caprice\Directives\ClearLinesDirective::class, true);

$caprice->directive('#include', Caprice\Directives\IncludeDirective::class);
$caprice->directive('#require', Caprice\Directives\IncludeDirective::class);

$caprice->directive('#php', Caprice\Directives\PhpDirective::class);
$caprice->directive('#endphp', Caprice\Directives\EndPhpDirective::class);

// additional helpers directives
$caprice->directive('~<!--(.*)-->~sUm', Caprice\Directives\CommentDirective::class, true);
$caprice->directive('~[\r\n]+~', Caprice\Directives\ClearLinesDirective::class, true);