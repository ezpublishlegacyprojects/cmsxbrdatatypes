<div class="block">
<input type="hidden" name="ContentClass_brstate_post_{$class_attribute.id}" value="1" />

    <div class="element">
        <label><input type="checkbox" name="ContentClass_brstate_valid_{$class_attribute.id}" {if $class_attribute.data_int1}checked="checked"{/if} value="1" />{'Force a valid state'|i18n( 'extension/brdatatypes/brstate/class/datatype' )}</label>
    </div>

    <div class="element">
        <label><input type="checkbox" name="ContentClass_brstate_names_{$class_attribute.id}" {if $class_attribute.data_int2}checked="checked"{/if} value="1" />{'Show state names'|i18n( 'extension/brdatatypes/brstate/class/datatype' )}</label>
    </div>

    <div class="break"></div>
</div>