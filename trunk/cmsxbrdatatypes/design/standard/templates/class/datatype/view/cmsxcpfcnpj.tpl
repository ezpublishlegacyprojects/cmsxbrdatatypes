<div class="block">
<label>{'Allow'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}:</label>
<p>
{switch match=$class_attribute.data_int1}
    {case match=2}
        {'CNPJ only'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}
    {/case}
    {case match=1}
    	{'CPF only'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}
    {/case}
    {case}
	    {'Both'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}
    {/case} 
{/switch}
</p>
</div>

<div class="block">

    <div class="element">
    <p>{if $class_attribute.data_int2}{'CPF must be unique'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}{else}{"CPF is not unique"|i18n("extension/brdatatypes/cpfcnpj/class/datatype")}{/if}</p>
    </div>

    <div class="element">
    	<p>{if $class_attribute.data_int3}{'CNPJ must be unique'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}{else}{"CNPJ is not unique"|i18n("extension/brdatatypes/cpfcnpj/class/datatype")}{/if}</p>
    </div>
    
    <div class="element">
	<label>{'Default value'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}:</label>
	<p>
	{switch match=$class_attribute.data_int4}
	    {case match=2}
	        CNPJ
	    {/case}
	    {case match=1}
	    	CPF
	    {/case}
	    {case}
		    {'None'|i18n( 'extension/brdatatypes/cpfcnpj/class/datatype' )}
	    {/case} 
	{/switch}
	</p>
	</div>
    
    <div class="break"></div>
</div>

