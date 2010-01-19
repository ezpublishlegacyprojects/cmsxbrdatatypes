{*?template charset=utf-8?*}
<div class="block">
<input type="hidden" name="ContentClass_brphone_post_{$class_attribute.id}" value="1" />

    <div class="element">
        <label><input type="checkbox" name="ContentClass_brphone_area_{$class_attribute.id}" {if $class_attribute.data_int1}checked="checked"{/if} value="1" />{'Force a area number'|i18n( 'extension/brdatatypes/brphone/class/datatype' )}</label>
    </div>
    <div class="break"></div>
</div>