{*?template charset=utf-8?*}
{if is_set( $attribute_base )|not}{def $attribute_base='ContentObjectAttribute'}{/if}
<div class="block">
<br />
{if eq( $attribute.contentclass_attribute.data_int1, 0 )}
	{'Type'|i18n( 'extension/brdatatypes/cpfcnpj/content/datatype' )}:  
	<input id="ezcoa-{if ne( $attribute_base, 'ContentObjectAttribute' )}{$attribute_base}-{/if}{$attribute.contentclassattribute_id}_{$attribute.contentclass_attribute_identifier}_1" class="ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier}" type="radio" name="{$attribute_base}_data_cpfcnpj_type_{$attribute.id}" {if eq( $attribute.data_int, 1 )}checked="checked"{/if} value="1" />
	CPF
	<input id="ezcoa-{if ne( $attribute_base, 'ContentObjectAttribute' )}{$attribute_base}-{/if}{$attribute.contentclassattribute_id}_{$attribute.contentclass_attribute_identifier}_1" class="ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier}" type="radio" name="{$attribute_base}_data_cpfcnpj_type_{$attribute.id}" {if eq( $attribute.data_int, 2 )}checked="checked"{/if} value="2" />
	CNPJ
	<br />
{'Number'|i18n( 'extension/brdatatypes/cpfcnpj/content/datatype' )}:
{/if}
<input id="ezcoa-{if ne( $attribute_base, 'ContentObjectAttribute' )}{$attribute_base}-{/if}{$attribute.contentclassattribute_id}_{$attribute.contentclass_attribute_identifier}_1" class="ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier}" type="text" name="{$attribute_base}_data_cpfcnpj_num_{$attribute.id}" size="18" maxlength="18" value="{$attribute.data_text}" />
</div>