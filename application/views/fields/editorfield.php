<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="units-row">
    <div class="unit-centered unit-80">
        <div id="editable" contenteditable="true" class="width-50">{text}</div>
    </div>
    <textarea style="display: none" name="{id}" id='{id}'></textarea>
</div>
<script>
    
    function update_editor() {
        document.getElementById('{id}').innerHTML = CKEDITOR.instances.editable.getData();
    }
    
</script>