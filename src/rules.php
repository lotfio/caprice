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

// comments
$caprice->directive('~<!--(.*)-->~sUm', Caprice\Directives\CommentDirective::class, true);

// if statement
$caprice->directive('#if', Caprice\Directives\IfDirective::class);
$caprice->directive('#endif', Caprice\Directives\EndIfDirective::class);
$caprice->directive('#elseif', Caprice\Directives\ElseIfDirective::class);

// echo 
$caprice->directive('{{', Caprice\Directives\EchoOpenDirective::class);
$caprice->directive('}}', Caprice\Directives\EchoCloseDirective::class);

// for loop / forin 
$caprice->directive('#for', Caprice\Directives\ForDirective::class);
$caprice->directive('#endforin', Caprice\Directives\EndForInDirective::class);
$caprice->directive('#endfor', Caprice\Directives\EndForDirective::class);

// while loop
$caprice->directive('#while', Caprice\Directives\WhileDirective::class);
$caprice->directive('#endwhile', Caprice\Directives\EndWhileDirective::class);

// do while
$caprice->directive('#do', Caprice\Directives\DoWhileDirective::class);
$caprice->directive('#enddo', Caprice\Directives\EndDoWhileDirective::class);

// break & continue statements
$caprice->directive('#break', Caprice\Directives\BreakDirective::class);
$caprice->directive('#continue', Caprice\Directives\ContinueDirective::class);

// extends / yield
$caprice->directive('#extends', Caprice\Directives\ExtendsDirective::class);
$caprice->directive('#yield', Caprice\Directives\YieldDirective::class);

// section 
$caprice->directive('/#section\s*\((.*?)\)(.*?)#endsection/s', Caprice\Directives\ClearLinesDirective::class, true);

// require & include 
$caprice->directive('#include', Caprice\Directives\IncludeDirective::class);
$caprice->directive('#require', Caprice\Directives\IncludeDirective::class);

// php code 
$caprice->directive('#php', Caprice\Directives\PhpDirective::class);
$caprice->directive('#endphp', Caprice\Directives\EndPhpDirective::class);

// helpers
$caprice->directive('#dump', Caprice\Directives\DumpDirective::class);
$caprice->directive('#dd', Caprice\Directives\DumpDirective::class);


// additional helpers directives
$caprice->directive('~[\r\n]+~', Caprice\Directives\ClearLinesDirective::class, true);