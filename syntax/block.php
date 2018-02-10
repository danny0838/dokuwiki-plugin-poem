<?php
// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_poem_block extends DokuWiki_Syntax_Plugin {

    function getType() { return 'container'; }
    function getPType() { return 'stack'; }
    function getAllowedTypes() { return array('formatting', 'substition', 'disabled', 'poem'); }
    function getSort() { return 20; }

    /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {
        $this->Lexer->addEntryPattern('<poem>\n?',$mode,'plugin_poem_block');
    }

    function postConnect() {
        $this->Lexer->addExitPattern('</poem>','plugin_poem_block');
    }

    /**
     * Handle the match
     */
    function handle($match, $state, $pos, Doku_Handler $handler){
        if ($state==DOKU_LEXER_UNMATCHED) {
            $handler->_addCall('cdata', array($match), $pos);
        }
        return false;
    }

    /**
     * Create output
     */
    function render($format, Doku_Renderer $renderer, $data) {}
}
