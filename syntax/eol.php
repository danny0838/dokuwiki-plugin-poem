<?php
// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_poem_eol extends DokuWiki_Syntax_Plugin {

    function getType() { return 'poem'; }
    function getPType() { return 'normal'; }
    function getSort() { return 369; }

    /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('(?:^[ \t]*)?\n',$mode,'plugin_poem_eol');
    }

    /**
     * Handle the match
     */
    function handle($match, $state, $pos, Doku_Handler $handler){return true;}

    /**
     * Create output
     */
    function render($format, Doku_Renderer $renderer, $data) {
        if($format == 'xhtml'){
            $renderer->doc .= "<br/>\n";
            return true;
        } else if ($format == 'metadata') {
            $renderer->doc .= "\n";
            return true;
        }
        return false;
    }
}
