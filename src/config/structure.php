<?php
return  function(){
    return
        \Nifus\AdminPanel::structure(
            [
                \Nifus\AdminPanel::createItem('geo')->sub(['Country','Region','City']),
                \Nifus\AdminPanel::createItem('users')->sub(['Users','Group']),
            ]
        );
};
