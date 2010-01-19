{def $cpfcnpj = $attribute.data_text}
<p>
{if $cpfcnpj|count}
{if eq( $attribute.data_int, 1 )}
	CPF: {$cpfcnpj|extract_left( 3 )}.{$cpfcnpj|extract( 3, 3 )}.{$cpfcnpj|extract( 6, 3 )}-{$cpfcnpj|extract( 9, 2 )}
{else}
	CNPJ: {$cpfcnpj|extract_left( 2 )}.{$cpfcnpj|extract( 2, 3 )}.{$cpfcnpj|extract( 5, 3 )}/{$cpfcnpj|extract( 8, 4 )}-{$cpfcnpj|extract_right( 2 )}
{/if}
{/if}
</p>