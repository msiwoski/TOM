<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
function openKCFinder(btn) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            //div.innerHTML = '<div style="margin:5px">Loading...</div>';
            
            
            
            //var img = new Image();
            var img = btn.parentNode.getElementsByTagName('img')[0];
            
            img.src = url;
            btn.parentNode.getElementsByTagName('input')[0].value = url.substring(url.lastIndexOf('/') + 1);
        }
    };
    window.open('/assets/kcfinder/browse.php?type=images',
        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );//&dir=../../../data
}