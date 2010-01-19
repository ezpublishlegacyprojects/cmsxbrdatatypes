{*?template charset=utf-8?*}
{def $state = cond( is_set( $#collection_attributes[$attribute.id] ), $#collection_attributes[$attribute.id].data_text, $attribute.content )}
{if is_set( $attribute_base )|not}{def $attribute_base='ContentObjectAttribute'}{/if}
<select {if is_set($html_class)}class="{$html_class}"{/if} {if is_set($html_id)}id="{$html_id}"{/if} name="{$attribute_base}_data_brstate_{$attribute.id}">

	<option value="">&#160;</option>
{if $attribute.contentclass_attribute.data_int2}	
	<option value="AC" {cond( eq( $state, 'AC'), 'selected="selected"')}>Acre</option>
	<option value="AL" {cond( eq( $state, 'AL'), 'selected="selected"')}>Alagoas</option>
	<option value="AP" {cond( eq( $state, 'AP'), 'selected="selected"')}>Amap&#225;</option>
	<option value="AM" {cond( eq( $state, 'AM'), 'selected="selected"')}>Amazonas</option>
	<option value="BA" {cond( eq( $state, 'BA'), 'selected="selected"')}>Bahia</option>
	<option value="CE" {cond( eq( $state, 'CE'), 'selected="selected"')}>Cear&#225;</option>

	<option value="DF" {cond( eq( $state, 'DF'), 'selected="selected"')}>Distrito Federal</option>
	<option value="ES" {cond( eq( $state, 'ES'), 'selected="selected"')}>Esp&#237;rito Santo</option>
	<option value="GO" {cond( eq( $state, 'GO'), 'selected="selected"')}>Goias</option>
	<option value="MA" {cond( eq( $state, 'MA'), 'selected="selected"')}>Maranh&#227;o</option>
	<option value="MT" {cond( eq( $state, 'MT'), 'selected="selected"')}>Mato Grosso</option>

	<option value="MS" {cond( eq( $state, 'MS'), 'selected="selected"')}>Mato Grosso do Sul</option>
	<option value="MG" {cond( eq( $state, 'MG'), 'selected="selected"')}>Minas Gerais</option>
	<option value="PA" {cond( eq( $state, 'PA'), 'selected="selected"')}>Par&#225;</option>
	<option value="PB" {cond( eq( $state, 'PB'), 'selected="selected"')}>Para&#237;ba</option>
	<option value="PR" {cond( eq( $state, 'PR'), 'selected="selected"')}>Paran&#225;</option>
	<option value="PE" {cond( eq( $state, 'PE'), 'selected="selected"')}>Pernambuco</option>

	<option value="PI" {cond( eq( $state, 'PI'), 'selected="selected"')}>Piau&#237;</option>
	<option value="RJ" {cond( eq( $state, 'RJ'), 'selected="selected"')}>Rio de Janeiro</option>
	<option value="RN" {cond( eq( $state, 'RN'), 'selected="selected"')}>Rio Grande do Norte</option>
	<option value="RS" {cond( eq( $state, 'RS'), 'selected="selected"')}>Rio Grande do Sul</option>
	<option value="RO" {cond( eq( $state, 'RO'), 'selected="selected"')}>Rond&#244;nia</option>
	<option value="RR" {cond( eq( $state, 'RR'), 'selected="selected"')}>Roraima</option>

	<option value="SC" {cond( eq( $state, 'SC'), 'selected="selected"')}>Santa Catarina</option>
	<option value="SP" {cond( eq( $state, 'SP'), 'selected="selected"')}>S&#227;o Paulo</option>
	<option value="SE" {cond( eq( $state, 'SE'), 'selected="selected"')}>Sergipe</option>
	<option value="TO" {cond( eq( $state, 'TO'), 'selected="selected"')}>Tocantins</option>
{else}
	<option value="AC" {cond( eq( $state, 'AC'), 'selected="selected"')}>AC</option>
	<option value="AL" {cond( eq( $state, 'AL'), 'selected="selected"')}>AL</option>
	<option value="AP" {cond( eq( $state, 'AP'), 'selected="selected"')}>AP</option>
	<option value="AM" {cond( eq( $state, 'AM'), 'selected="selected"')}>AM</option>
	<option value="BA" {cond( eq( $state, 'BA'), 'selected="selected"')}>BA</option>
	<option value="CE" {cond( eq( $state, 'CE'), 'selected="selected"')}>CE</option>

	<option value="DF" {cond( eq( $state, 'DF'), 'selected="selected"')}>DF</option>
	<option value="ES" {cond( eq( $state, 'ES'), 'selected="selected"')}>ES</option>
	<option value="GO" {cond( eq( $state, 'GO'), 'selected="selected"')}>GO</option>
	<option value="MA" {cond( eq( $state, 'MA'), 'selected="selected"')}>MA</option>
	<option value="MT" {cond( eq( $state, 'MT'), 'selected="selected"')}>MT</option>

	<option value="MS" {cond( eq( $state, 'MS'), 'selected="selected"')}>MS</option>
	<option value="MG" {cond( eq( $state, 'MG'), 'selected="selected"')}>MG</option>
	<option value="PA" {cond( eq( $state, 'PA'), 'selected="selected"')}>PA</option>
	<option value="PB" {cond( eq( $state, 'PB'), 'selected="selected"')}>PB</option>
	<option value="PR" {cond( eq( $state, 'PR'), 'selected="selected"')}>PR</option>
	<option value="PE" {cond( eq( $state, 'PE'), 'selected="selected"')}>PE</option>

	<option value="PI" {cond( eq( $state, 'PI'), 'selected="selected"')}>PI</option>
	<option value="RJ" {cond( eq( $state, 'RJ'), 'selected="selected"')}>RJ</option>
	<option value="RN" {cond( eq( $state, 'RN'), 'selected="selected"')}>RN</option>
	<option value="RS" {cond( eq( $state, 'RS'), 'selected="selected"')}>RS</option>
	<option value="RO" {cond( eq( $state, 'RO'), 'selected="selected"')}>RO</option>
	<option value="RR" {cond( eq( $state, 'RR'), 'selected="selected"')}>RR</option>

	<option value="SC" {cond( eq( $state, 'SC'), 'selected="selected"')}>SC</option>
	<option value="SP" {cond( eq( $state, 'SP'), 'selected="selected"')}>SP</option>
	<option value="SE" {cond( eq( $state, 'SE'), 'selected="selected"')}>SE</option>
	<option value="TO" {cond( eq( $state, 'TO'), 'selected="selected"')}>TO</option>
{/if}
	{if eq( $attribute.contentclass_attribute.data_int1, 0 )}
		<option value="NA" {cond( eq( $state, 'NA'), 'selected="selected"')}>{'Not Applicable'|i18n( 'extension/brdatatypes/brstate/content/datatype' )}</option>
	{/if}
</select>