{*?template charset=utf-8?*}
{if is_set( $attribute_base )|not}{def $attribute_base='ContentObjectAttribute'}{/if}
<input {if is_set($html_class)}class="{$html_class}"{/if} {if is_set($html_id)}id="{$html_id}"{/if} type="text" name="{$attribute_base}_data_brphone_{$attribute.id}" size="18" maxlength="18" value="{cond( is_set( $#collection_attributes[$attribute.id] ), $#collection_attributes[$attribute.id].data_text, $attribute.content )}" />