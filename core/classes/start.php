<?php

class start extends Main
{
    public function _main_($params)
    {
        $this -> header ();
        $this -> module ('top-container');
        $this -> page( 'start');

        $this -> footer();
    }
}