{def $state = $attribute.data_text}
<p>
{if $attribute.has_content}
{if $attribute.contentclass_attribute.data_int2}	
	{cond( eq( $state, 'AC'), 'Acre')}
	{cond( eq( $state, 'AL'), 'Alagoas')}
	{cond( eq( $state, 'AP'), 'Amap&#225;')}
	{cond( eq( $state, 'AM'), 'Amazonas')}
	{cond( eq( $state, 'BA'), 'Bahia')}
	{cond( eq( $state, 'CE'), 'Cear&#225;')}

	{cond( eq( $state, 'DF'), 'Distrito Federal')}
	{cond( eq( $state, 'ES'), 'Esp&#237;rito Santo')}
	{cond( eq( $state, 'GO'), 'Goias')}
	{cond( eq( $state, 'MA'), 'Maranh&#227;o')}
	{cond( eq( $state, 'MT'), 'Mato Grosso')}

	{cond( eq( $state, 'MS'), 'Mato Grosso do Sul')}
	{cond( eq( $state, 'MG'), 'Minas Gerais')}
	{cond( eq( $state, 'PA'), 'Par&#225;')}
	{cond( eq( $state, 'PB'), 'Para&#237;ba')}
	{cond( eq( $state, 'PR'), 'Paran&#225;')}
	{cond( eq( $state, 'PE'), 'Pernambuco')}

	{cond( eq( $state, 'PI'), 'Piau&#237;')}
	{cond( eq( $state, 'RJ'), 'Rio de Janeiro')}
	{cond( eq( $state, 'RN'), 'Rio Grande do Norte')}
	{cond( eq( $state, 'RS'), 'Rio Grande do Sul')}
	{cond( eq( $state, 'RO'), 'Rond&#244;nia')}
	{cond( eq( $state, 'RR'), 'Roraima')}

	{cond( eq( $state, 'SC'), 'Santa Catarina')}
	{cond( eq( $state, 'SP'), 'S&#227;o Paulo')}
	{cond( eq( $state, 'SE'), 'Sergipe')}
	{cond( eq( $state, 'TO'), 'Tocantins')}
{else}
 	{if eq( $state, 'NA')}
		{'Not Applicable'|i18n( 'extension/brdatatypes/brstate/content/datatype' )}
	{else}
		{$state}
	{/if}
{/if}
{/if}
</p>