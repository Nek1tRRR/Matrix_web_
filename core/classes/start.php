<?php

class start extends Main
{
    public function _main_($params)
    {
        if(empty($this -> user -> id))
        {
            $this -> header ();
            $this -> module ('top-container');
            $this -> page( 'main');
            $this -> footer();
        }else{
            header( "Location: /@" . $this -> user -> login);
        }
    }
}