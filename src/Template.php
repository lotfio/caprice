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
    private function parse(string $pattern, callable $callback, string $file, int $number = -1)
    {
        return preg_replace_callback($pattern, $callback, $file, $number);
    }

    /**
     * parse echo
     *
     * @return void
     */
    public function parseEchoEscaped()
    {
        $pattern = "/\(\-{2}([\$\w\s\+\=\%\~\-\/\*]+)\-{2}\)/s";

        $this->file = $this->parse($pattern, function($match) use($pattern){

            return preg_replace($pattern, '<?=htmlentities("$1", ENT_QUOTES, \'UTF-8\');?>', $match[0]);

        }, $this->file);
    }

    /**
     * parse echo method
     *
     * @return void
     */
    public function parseEcho()
    {
        $pattern = "/\(\-{1}([\$\w\s\+\=\%\~\-\/\*]+)\-{1}\)/s";

        $this->file = $this->parse($pattern, function($match) use ($pattern){

            return preg_replace($pattern, '<?="$1"?>', $match[0]);

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

        $this->file = $this->parse($pattern, function($match) use($pattern){

            $match = preg_replace($pattern, '<?php for($1$2$3):?>$4<?php endfor;?>', $match[0]);
            return $match;
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

        $this->file = $this->parse($pattern, function($match) use ($pattern){
            $match = preg_replace($pattern, '<?php foreach($3 as $1):?>$4<?php endforeach;?>', $match[0]);
            return $match;
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

        $this->file = $this->parse($pattern, function($match) use ($pattern){
            $match = preg_replace($pattern, '<?php foreach($3 as $1):?>$4<?php endforeach;?>', $match[0]);
            return $match;
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

        $this->file = $this->parse($pattern, function($match) use($pattern){

            return preg_replace($pattern, '<?php while($1):?>$2<?php endwhile;?>', $match[0]);;
        }, $this->file);
    }


    /**
     * parse definition block
     *
     * @return void
     */
    public function parseBlock()
    {
        $pattern = "/\({2}.*\){2}/s";

        $this->file = $this->parse($pattern, function($match){

            $str = str_replace("((", "<?php", $match[0]);
            return str_replace("))", "?>", $str);

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

        $file = preg_replace("~[\r\n]+~", "\r\n", trim($this->file)); //remove white spaces minify from this i can create a package
        return file_put_contents($name, $file);
    }
}