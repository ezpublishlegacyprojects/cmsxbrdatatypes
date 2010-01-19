<div class="block">
<label>{'Allow'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}:</label>
<select name="ContentClass_cpfcnpj_allow_{$class_attribute.id}">
    <option value="0" {if eq( $class_attribute.data_int1, 0 )}selected="selected"{/if}>{'Both'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}</option>
    <option value="1" {if eq( $class_attribute.data_int1, 1 )}selected="selected"{/if}>{'CPF only'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}</option>
    <option value="2" {if eq( $class_attribute.data_int1, 2 )}selected="selected"{/if}>{'CNPJ only'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}</option>
</select>
</div>

<div class="block">

    <div class="element">
        <label><input type="checkbox" name="ContentClass_cpfcnpj_cpf_unique_{$class_attribute.id}" {if $class_attribute.data_int2}checked="checked"{/if} value="1" />{'CPF must be unique'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}</label>
    </div>

    <div class="element">
        <label><input type="checkbox" name="ContentClass_cpfcnpj_cnpj_unique_{$class_attribute.id}" {if $class_attribute.data_int3}checked="checked"{/if} value="1" />{'CNPJ must be unique'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}</label>
    </div>

    <div class="element">
    <label>{'Default value'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}:</label>
    <select name="ContentClass_cpfcnpj_default_{$class_attribute.id}">
        <option value="0" {if eq( $class_attribute.data_int4, 0 )}selected="selected"{/if}>{'None'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}</option>
        <option value="1" {if eq( $class_attribute.data_int4, 1 )}selected="selected"{/if}>CPF</option>
        <option value="2" {if eq( $class_attribute.data_int4, 2 )}selected="selected"{/if}>CNPJ</option>
    </select>
    </div>

    <div class="break"></div>
</div>