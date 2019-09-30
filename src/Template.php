<?php

/*
 * This file is a part of Caprice package
 *
 * @package     Caprice
 * @version     0.1.0
 * @author      Lotfio Lakehal <contact@lotfio.net>
 * @copyright   Lotfio Lakehal 2019
 * @license     MIT
 * @link        https://github.com/lotfio/caprice
 *
 */

namespace Caprice;

class Template
{
    /**
     * template file
     *
     * @var string
     */
    private $file;

    /**
     * constructor
     *
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->file = file_get_contents($fileName);
    }

    /**
     * parse method
     *
     * @param  string $pattern
     * @param  callable $callback
     * @param  string $file
     * @return void
     */
    private function parse(string $pattern, callable $callback, string $file, int $limit = -1)
    {
        return preg_replace_callback($pattern, $callback, $file, $limit);
    }

    /**
     * parse definition block
     *
     * @return void
     */
    public function parseBlock()
    {
        $pattern = "/\({2}(.*?)\){2}/s";

        $this->file = $this->parse($pattern,function($match){

            return '<?php '. trim($match[1]) .'?>';

        }, $this->file);
    }

    /**
     * parse echo method
     *
     * @return void
     */
    public function parseEcho()
    {
        $pattern = "/\(\-{1}(.*?)\-{1}\)/s";

        $this->file = $this->parse($pattern, function($match){

            return '<?='.trim($match[1]).'?>';

        }, $this->file);
    }

    /**
     * parse echo
     *
     * @return void
     */
    public function parseEchoEscaped()
    {
        $pattern = "/\(\={1}(.*?)\={1}\)/s";

        $this->file = $this->parse($pattern, function($match){

            return '<?=htmlentities('.trim($match[1]).', ENT_QUOTES, \'UTF-8\');?>';

        }, $this->file);
    }

    /**
     * for parser
     *
     * @return void
     */
    public function parseFor()
    {
        $pattern  = '/#for\s*\((\$\w+\s*=\s*[\$\w+]+\s*\;)(\s*\$\w+\s*[<=>!]+\s*[\$\w+]+\s*\;\s*)(\$\w+[+-=\/\*\s\w\$]+)\)(.*?)#endfor/s';

        $this->file = $this->parse($pattern, function($match){

            return '<?php for('.trim($match[1]).''. trim($match[2]).''.trim($match[3]).'):?>'.trim($match[4]).'<?php endfor;?>';

        }, $this->file);
    }

    /**
     * for parser
     *
     * @return void
     */
    public function parseForInKeyValue()
    {
        $pattern  = '/#for\s*\((\$\w+\s*=>\s*\$\w+\s*)(\s*in\s*)(\$\w+\s*)\)(.*?)#endfor/s';

        $this->file = $this->parse($pattern, function($match){

            return '<?php foreach('.trim($match[3]).' as '.trim($match[1]).'):?>'.trim($match[4]).'<?php endforeach;?>';

        }, $this->file);
    }

    /**
     * for parser
     *
     * @return void
     */
    public function parseForInValueOnly()
    {
        $pattern  = '/#for\s*\((\$\w+\s*)(\s*in\s*)(\$\w+\s*)\)(.*?)#endfor/s';

        $this->file = $this->parse($pattern, function($match){

            return '<?php foreach('.trim($match[3]).' as '.trim($match[1]).'):?>'.trim($match[4]).'<?php endforeach;?>';

        }, $this->file);
    }

    /**
     * for while
     *
     * @return void
     */
    public function parseWhile()
    {
        $pattern  = '/#while\s*\(([\$\w+\d+\s*\<\=\>\!]+)\)(.+?)#endwhile/s';

        $this->file = $this->parse($pattern, function($match){

            return '<?php while('.trim($match[1]).'):?>'.trim($match[2]).'<?php endwhile;?>';

        }, $this->file);

        $pattern = '/#continue/s';
        $this->file = $this->parse($pattern, function($match){ return '<?php continue;?>';}, $this->file);

        $pattern = '/#break/s';
        $this->file = $this->parse($pattern, function($match){ return '<?php break;?>';}, $this->file);
    }

    /**
     * parse include or require
     *
     * @return void
     */
    public function parseInclude()
    {
        $pattern = '/(#include|#require)\s*\((.*?)\)/s';
        $this->file = $this->parse($pattern, function($match){

            $file = str_replace("'", NULL, $match[2]);
            $file = str_replace('"', NULL, $file);
            $file = str_replace('.cap.php', NULL, $file);
            $file = str_replace('.', '/', $file) . '.php';

            return '<?php '. trim($match[1], '#') .'("' . $file . '");?>';
        }, $this->file);
    }

    /**
     * for while
     *
     * @return void
     */
    public function parseIf()
    {
        $pattern    = '/(#if)\s*\((.*)\)/';
        $this->file = $this->parse($pattern, function($match){
            return '<?php if('.trim($match[2]).'):?>';
        }, $this->file);

        $pattern    = '/(#elif)\s*\((.*)\)/';
        $this->file = $this->parse($pattern, function($match){
            return '<?php elseif('.trim($match[2]).'):?>';
        }, $this->file);

        $pattern    = '/#else*/';
        $this->file = $this->parse($pattern, function($match) { return '<?php else:?>'; }, $this->file);

        $pattern    = '/#endif/';
        $this->file = $this->parse($pattern, function($match){return '<?php endif;?>';}, $this->file);
    }

    /**
     * array access parse method
     *
     * @return void
     */
    public function parseArrayAccess()
    {
        $pattern = '/((\$\w+)\.(\w+)(\s*\;*))/m';
        $this->file = $this->parse($pattern, function($match){
            return $match[2].'["'.$match[3].'"]'.$match[4];
        }, $this->file);
    }

    public function generateParsedFile(string $name)
    {
        $this->parseBlock();
        $this->parseEchoEscaped();
        $this->parseEcho();
        $this->parseFor();
        $this->parseForInKeyValue();
        $this->parseForInValueOnly();
        $this->parseWhile();
        $this->parseIf();
        $this->parseInclude();
        $this->parseArrayAccess();

        $file = preg_replace("~[\r\n]+~", "\r\n", trim($this->file)); //remove white spaces minify from this i can create a package
        return file_put_contents($name, $file);
    }
}