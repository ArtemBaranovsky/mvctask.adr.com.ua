<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author в
 */
class View {
    public function render($tpl, $pageData) {
        include ROOT . $tpl;
        
    }
}
