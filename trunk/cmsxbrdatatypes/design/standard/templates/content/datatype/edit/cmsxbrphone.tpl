{*?template charset=utf-8?*}
{if is_set( $attribute_base )|not}{def $attribute_base='ContentObjectAttribute'}{/if}
<div class="block">
<input id="ezcoa-{if ne( $attribute_base, 'ContentObjectAttribute' )}{$attribute_base}-{/if}{$attribute.contentclassattribute_id}_{$attribute.contentclass_attribute_identifier}_1" class="box ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier}" type="text" name="{$attribute_base}_data_brphone_{$attribute.id}" size="18" maxlength="18" value="{$attribute.data_text}" />
</div>