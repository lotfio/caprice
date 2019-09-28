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
<<<<<<< Updated upstream
    private function parse(string $pattern, callable $callback, string $file, int $number = -1)
    {
        return preg_replace_callback($pattern, $callback, $file, $number);
=======
    private function parse(string $pattern, callable $callback, string $file, int $limit = -1)
    {
        return preg_replace_callback($pattern, $callback, $file, $limit);
>>>>>>> Stashed changes
    }

    /**
     * parse definition block
     *
     * @return void
     */
    public function parseBlock()
    {
<<<<<<< Updated upstream
        $pattern = "/\(\-{2}([\$\w\s\+\=\%\~\-\/\*]+)\-{2}\)/s";

        $this->file = $this->parse($pattern, function($match) use($pattern){

            return preg_replace($pattern, '<?=htmlentities("$1", ENT_QUOTES, \'UTF-8\');?>', $match[0]);
=======
        $pattern = "/\({2}(.*?)\){2}/s";

        $this->file = $this->parse($pattern,function($match){

            return '<?php '. trim($match[1]) .'?>';
>>>>>>> Stashed changes

        }, $this->file);
    }

    /**
     * parse echo method
     *
     * @return void
     */
    public function parseEcho()
    {
<<<<<<< Updated upstream
        $pattern = "/\(\-{1}([\$\w\s\+\=\%\~\-\/\*\|]+)\-{1}\)/s";

        $this->file = $this->parse($pattern, function($match) use ($pattern){

            return preg_replace($pattern, '<?="$1"?>', $match[0]);
=======
        $pattern = "/\(\-{1}(.*?)\-{1}\)/s";

        $this->file = $this->parse($pattern, function($match){

            return '<?="'.trim($match[1]).'"?>';

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

            return '<?=htmlentities("'.trim($match[1]).'", ENT_QUOTES, \'UTF-8\');?>';
>>>>>>> Stashed changes

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
<<<<<<< Updated upstream

        $this->file = $this->parse($pattern, function($match) use($pattern){

            $match = preg_replace($pattern, '<?php for($1$2$3):?>$4<?php endfor;?>', $match[0]);
            return $match;
=======
        
        $this->file = $this->parse($pattern, function($match){

            return '<?php for('.trim($match[1]).''. trim($match[2]).''.trim($match[3]).'):?>'.trim($match[4]).'<?php endfor;?>';

>>>>>>> Stashed changes
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
<<<<<<< Updated upstream

        $this->file = $this->parse($pattern, function($match) use ($pattern){
            $match = preg_replace($pattern, '<?php foreach($3 as $1):?>$4<?php endforeach;?>', $match[0]);
            return $match;
=======
        
        $this->file = $this->parse($pattern, function($match){

            return '<?php foreach('.trim($match[3]).' as '.trim($match[1]).'):?>'.trim($match[4]).'<?php endforeach;?>';

>>>>>>> Stashed changes
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
<<<<<<< Updated upstream

        $this->file = $this->parse($pattern, function($match) use ($pattern){
            $match = preg_replace($pattern, '<?php foreach($3 as $1):?>$4<?php endforeach;?>', $match[0]);
            return $match;
=======
        
        $this->file = $this->parse($pattern, function($match){

            return '<?php foreach('.trim($match[3]).' as '.trim($match[1]).'):?>'.trim($match[4]).'<?php endforeach;?>';
        
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream

        $this->file = $this->parse($pattern, function($match) use($pattern){

            return preg_replace($pattern, '<?php while($1):?>$2<?php endwhile;?>', $match[0]);
=======
        
        $this->file = $this->parse($pattern, function($match){

            return '<?php while('.trim($match[1]).'):?>'.trim($match[2]).'<?php endwhile;?>';

>>>>>>> Stashed changes
        }, $this->file);
    }

    /**
     * for while
     *
     * @return void
     */
    public function parseIf()
    {
<<<<<<< Updated upstream
        $pattern  = '/#if\s*\((.*?)\)(.*?)#endif/s';

        $this->file = $this->parse($pattern, function($match) use($pattern){
            return preg_replace($pattern, '<?php if($1):?> $2 <?php endif;?>', $match[0]);
        }, $this->file);
    }
=======
        $pattern    = '/(#if)\s*\((.*?)\)/';
        $this->file = $this->parse($pattern, function($match){
            return '<?php if('.trim($match[2]).'):?>';
        }, $this->file);
>>>>>>> Stashed changes

        $pattern    = '/(#elif)\s*\((.*?)\)/';
        $this->file = $this->parse($pattern, function($match){
            return '<?php elseif('.trim($match[2]).'):?>';
        }, $this->file);

<<<<<<< Updated upstream
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
=======
        $pattern    = '/#else*/';
        $this->file = $this->parse($pattern, function($match) { return '<?php else:?>'; }, $this->file);

        $pattern    = '/#endif/';
        $this->file = $this->parse($pattern, function($match){return '<?php endif;?>';}, $this->file);
>>>>>>> Stashed changes
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

        $file = preg_replace("~[\r\n]+~", "\r\n", trim($this->file)); //remove white spaces minify from this i can create a package
        return file_put_contents($name, $file);
    }
}