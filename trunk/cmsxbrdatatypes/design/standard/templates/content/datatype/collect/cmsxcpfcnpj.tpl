{*?template charset=utf-8?*}
{if is_set( $attribute_base )|not}{def $attribute_base='ContentObjectAttribute'}{/if}
{if eq( $attribute.contentclass_attribute.data_int1, 0 )}
	{'Type'|i18n( 'extension/brdatatypes/cpfcnpj/content/datatype' )}:  
	<input type="radio" name="{$attribute_base}_data_cpfcnpj_type_{$attribute.id}" {if eq( $#collection_attributes[$attribute.id].data_int, 1 )}checked="checked"{/if} value="1" />
	CPF 
	<input type="radio" name="{$attribute_base}_data_cpfcnpj_type_{$attribute.id}" {if eq( $#collection_attributes[$attribute.id].data_int, 2 )}checked="checked"{/if} value="2" />
	CNPJ  - 
{'Number'|i18n( 'extension/brdatatypes/cpfcnpj/content/datatype' )}:
{/if}
<input {if is_set($html_class)}class="{$html_class}"{/if} {if is_set($html_id)}id="{$html_id}"{/if} type="text" name="{$attribute_base}_data_cpfcnpj_num_{$attribute.id}" size="18" maxlength="18" value="{cond( is_set( $#collection_attributes[$attribute.id] ), $#collection_attributes[$attribute.id].data_text, $attribute.content )}" />