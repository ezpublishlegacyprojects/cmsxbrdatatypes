<?php

class cmsxCpfCnpjType extends eZDataType
{
    const DATA_TYPE_STRING = 'cmsxcpfcnpj';

    const TYPE_BOTH = 0;
    const TYPE_CPF = 1;
    const TYPE_CNPJ = 2;  
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct( self::DATA_TYPE_STRING, 
                             ezi18n( 'extension/brdatatypes', 'CPF/CNPJ', 'Datatype name' ),
                              array( 'serialize_supported' => true,
                                  'object_serialize_map' => array( 'data_text' => 'identifier',
                                                                   'data_int' => 'type' ) ) );
    }

    function validateObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
        if ( $http->hasPostVariable( $base . '_data_cpfcnpj_num_' . $contentObjectAttribute->attribute( 'id' ) ) )
        {
			$contentClass = $contentObjectAttribute->contentClassAttribute();
			$allowedTypes = $contentClass->attribute( 'data_int1' );
			if ( $allowedTypes == self::TYPE_BOTH )
			{
				if ( !$http->hasPostVariable( $base . '_data_cpfcnpj_type_' . $contentObjectAttribute->attribute( 'id' ) ) )
				{
					$contentObjectAttribute->setValidationError( 
				        ezi18n( 'extension/brdatatypes/cpfcnpj/content/datatype', 'The type (CPF or CNPJ) is mandatory' ) );
			        return eZInputValidator::STATE_INVALID;	
				}
				$type = $http->postVariable( $base . '_data_cpfcnpj_type_' . $contentObjectAttribute->attribute( 'id' ) );
			}
            else
            {
            	$type = ( $allowedTypes == self::TYPE_CPF ) ? self::TYPE_CPF : self::TYPE_CNPJ; 
            }
           	$num = self::cleanNum( $http->postVariable( $base . '_data_cpfcnpj_num_' . $contentObjectAttribute->attribute( 'id' ) ) );
            if ( $type == self::TYPE_CNPJ )
            {
            	if ( $num == '' && $contentObjectAttribute->validateIsRequired() )
            	{
            		$contentObjectAttribute->setValidationError( 
            		    ezi18n( 'extension/brdatatypes/cpfcnpj/content/datatype', 'CNPJ is mandatory' ) );
					return eZInputValidator::STATE_INVALID;
            	}
            	$isValid = self::isCNPJ( $num );
            	if ( $num != '' && !$isValid )
            	{
            		$contentObjectAttribute->setValidationError(  
            		    ezi18n( 'extension/brdatatypes/cpfcnpj/content/datatype', 'Invalid CNPJ' ) );
					return eZInputValidator::STATE_INVALID;
            	}
            	if ( $num != '' && $isValid && $contentClass->attribute( 'data_int3' ) && !$this->isUnique( $num, $contentObjectAttribute ) )
            	{
            		$contentObjectAttribute->setValidationError(  
            		    ezi18n( 'extension/brdatatypes/cpfcnpj/content/datatype', 'CNPJ provided is already being used by another user' ) );
					return eZInputValidator::STATE_INVALID;
            	}
            }
            else
            {
                if ( $num == '' && $contentObjectAttribute->validateIsRequired() )
            	{
            		$contentObjectAttribute->setValidationError(  
            		    ezi18n( 'extension/brdatatypes/cpfcnpj/content/datatype', 'CPF is mandatory' )  );
					return eZInputValidator::STATE_INVALID;
            	}
            	$isValid = self::isCPF( $num );
            	if ( $num != '' && !$isValid )
            	{
            		$contentObjectAttribute->setValidationError(   
            		    ezi18n( 'extension/brdatatypes/cpfcnpj/content/datatype', 'Invalid CPF' )  );
					return eZInputValidator::STATE_INVALID;
            	}
            	if ( $num != '' && $isValid && $contentClass->attribute( 'data_int2' ) && !$this->isUnique( $num, $contentObjectAttribute ) )
            	{
            		$contentObjectAttribute->setValidationError(   
            		    ezi18n( 'extension/brdatatypes/cpfcnpj/content/datatype', 'CPF provided is already being used by another user' ) );
					return eZInputValidator::STATE_INVALID;
            	}            	
            }
            return eZInputValidator::STATE_ACCEPTED;
        }
        $contentObjectAttribute->setValidationError(    
            ezi18n( 'extension/brdatatypes/cpfcnpj/content/datatype', 'The CPF or CNPJ is mandatory' ) );
        return eZInputValidator::STATE_INVALID;
    }

    function fetchObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
    	if ( $http->hasPostVariable( $base . '_data_cpfcnpj_num_' . $contentObjectAttribute->attribute( 'id' ) ) )
        {
        	$contentClass = $contentObjectAttribute->contentClassAttribute();
			$allowedTypes = $contentClass->attribute( 'data_int1' );
			if ( $allowedTypes == self::TYPE_BOTH )
			{
				$type = $http->postVariable( $base . '_data_cpfcnpj_type_' . $contentObjectAttribute->attribute( 'id' ) );
				if ( !$http->hasPostVariable( $base . '_data_cpfcnpj_type_' . $contentObjectAttribute->attribute( 'id' ) ) )
				{
					$type = ( $contentClass->attribute( 'data_int4' ) == self::TYPE_CPF ) ? self::TYPE_CPF : self::TYPE_CNPJ;
				}
				
			}
            else
            {
            	$type = ( $allowedTypes == self::TYPE_CPF ) ? self::TYPE_CPF : self::TYPE_CNPJ; 
            }
        	$num = $http->postVariable( $base . '_data_cpfcnpj_num_' . $contentObjectAttribute->attribute( 'id' ) );
        	$contentObjectAttribute->setAttribute( 'data_int', self::cleanNum( $type ) );
        	$contentObjectAttribute->setAttribute( 'data_text', self::cleanNum( $num ) );
        	return true;
        }
        return false;
    }

    function objectAttributeContent( $contentObjectAttribute )
    {
        return $contentObjectAttribute->attribute( "data_text" );
    }
    function fetchClassAttributeHTTPInput( $http, $base, $classAttribute )
    {
        $classAttributeID = $classAttribute->attribute( 'id' );
        if ( $http->hasPostVariable( $base . '_cpfcnpj_allow_' . $classAttributeID ) &&
             $http->hasPostVariable( $base . '_cpfcnpj_default_' . $classAttributeID ) )
        {
            $allow = $http->postVariable( $base . '_cpfcnpj_allow_' . $classAttributeID );
			$cpfUnique = $http->postVariable( $base . '_cpfcnpj_cpf_unique_' . $classAttributeID );
			$cnpjUnique = $http->postVariable( $base . '_cpfcnpj_cnpj_unique_' . $classAttributeID );
			$default = $http->postVariable( $base . '_cpfcnpj_default_' . $classAttributeID );
			// correct nulled values
			$cpfUnique = ( $cpfUnique == null ) ? 0 : $cpfUnique;
			$cnpjUnique = ( $cnpjUnique == null ) ? 0 : $cnpjUnique;
			$classAttribute->setAttribute( 'data_int1', $allow );
			$classAttribute->setAttribute( 'data_int2', $cpfUnique );
			$classAttribute->setAttribute( 'data_int3', $cnpjUnique );
			$classAttribute->setAttribute( 'data_int4', $default );
			$classAttribute->store(); 	
        }
        return true;
    }
  
    function metaData( $contentObjectAttribute )
    {
        return $contentObjectAttribute->attribute( "data_text" );
    }

    function title( $contentObjectAttribute, $name = null )
    {
        $type = ( $contentObjectAttribute->attribute( 'data_int' ) == self::TYPE_CNPJ ) ? 'PJ' : 'PF';
        return $type . '-' . $contentObjectAttribute->attribute( "data_text" );
    }

    function hasObjectAttributeContent( $contentObjectAttribute )
    {
        return true;
    }
   /**
    * Sets the default value.
    */
   function initializeClassAttribute( $classAttribute )
   {
   		if ( $classAttribute->attribute( 'data_int1') == null )
   		{
   			$classAttribute->setAttribute( 'data_int1', self::TYPE_BOTH );
   		}
        if ( $classAttribute->attribute( 'data_int4') == null )
   		{
   			$classAttribute->setAttribute( 'data_int4', self::TYPE_CPF );
   		}    	    	
		$classAttribute->store();
    }
    function sortKey( $contentObjectAttribute )
    {
        return $contentObjectAttribute->attribute( 'data_text' );
    }
    function sortKeyType()
    {
        return 'string';
    }
	/**
	 * Limpa a entrada
	 *
	 * @param string $num
	 * @return int
	 */
    public static function cleanNum( $num )
    {
        return preg_replace( '/\D+/i', '', $num );;
    }

    public function isCPF( $cpf ) 
    {
    	$invalidNums = array( '00000000000', '11111111111' , '22222222222', '33333333333', '44444444444',
    	                      '55555555555', '66666666666', '77777777777', '88888888888', '99999999999', '12345678909' );
        $cpf = self::cleanNum( $cpf );
        if( $cpf == '' || strlen( $cpf ) != 11 || strlen( (int) $cpf ) < 2 || in_array( $cpf, $invalidNums ) )
        {
        	return false;
        }
        $key = 10;
        $sum1 = '';	
		for( $i = 0; $i < 9; $i++ )	
		{
			$sum1 += ( $cpf[$i] * $key );
			$key--;	
		}
        $sum1 -= ( 11 * ( intval( $sum1 / 11 ) ) );
		$result1 = ( $sum1 < 2 ) ? 0 : 11 - $sum1;
		if ( $result1 == $cpf[9] )
		{
			$key = 10;
        	$sum2 = $cpf[0] * 11;	
			for( $i = 1; $i < 10; $i++ )	
			{
				$sum2 += ( $cpf[$i] * $key );
				$key--;	
			}
		    $sum2 -= ( 11 * ( intval( $sum2 / 11 ) ) );
			$result2 = ( $sum2 < 2 ) ? 0 : 11 - $sum2;
            if ( $result2 == $cpf[10] )
            {
                return true;
            }
		}
		return false;
    }
    
    public  function isCNPJ( $cnpj ) 
    {
    	$invalidNums = array( '00000000000000', '11111111111111', '22222222222222', '33333333333333', '44444444444444', 
    	                      '55555555555555', '66666666666666', '77777777777777', '88888888888888', '99999999999999', '12345678901234' );
        $cnpj = self::cleanNum( $cnpj );
        if( $cnpj == '' || strlen( $cnpj ) != 14 || strlen( (int) $cnpj ) < 2  || in_array( $cnpj, $invalidNums ) )
        {
        	return false;
        }
        $key = 6;
        $sum1 = '';	
        $sum2 = '';	
		for( $i = 0; $i < 13; $i++ )	
		{	
			$key = $key == 1 ? 9 : $key;	
			$sum2 += ( $cnpj{$i} * $key );
			$key--;	
			if( $i < 12 )
			{
				if( $key == 1 )
				{
					$key = 9;	
					$sum1 += ( $cnpj{$i} * $key );	
					$key = 1;
				}
				else
				{
					$sum1 += ( $cnpj{$i} * $key );
				}
			}
		}
		$digit1 = $sum1 % 11 < 2 ? 0 : 11 - $sum1 % 11;	
		$digit2 = $sum2 % 11 < 2 ? 0 : 11 - $sum2 % 11;
		return ( $cnpj{12} == $digit1 && $cnpj{13} == $digit2 );	
    }
    public function isUnique( $value, $attribute )
    {
        // class id
        $classId = (int) $attribute->object()->ClassID;
        // class attribute id
        $attId = (int) $attribute->ContentClassAttributeID;
        // current user object id
        $userObjectId = (int) $attribute->ContentObjectID;
        // sql
		$sql = "SELECT DISTINCT
	               ezcontentobject.*,
				   ezcontentobject_tree.*,
				   ezcontentclass.serialized_name_list as class_serialized_name_list,
				   ezcontentclass.identifier as class_identifier,
				   ezcontentclass.is_container as is_container,
                   ezcontentobject_name.name as name,  ezcontentobject_name.real_translation 
                       FROM
					       ezcontentobject_tree,
					       ezcontentobject,ezcontentclass,
					       ezcontentobject_name,
					       ezcontentobject_attribute a0
					           WHERE
                                   a0.contentobject_id = ezcontentobject.id AND
					               a0.contentclassattribute_id = $attId AND
					               a0.version = ezcontentobject_name.content_version AND 
					               ( a0.sort_key_string = '$value'  ) AND 
					               ezcontentobject_tree.node_id != 1 AND
					               ezcontentobject_tree.contentobject_id = ezcontentobject.id  AND
					               ezcontentobject.id != $userObjectId AND
					               ezcontentclass.id = ezcontentobject.contentclass_id AND
					               ezcontentobject_tree.node_id = ezcontentobject_tree.main_node_id AND
					               ezcontentobject.contentclass_id = $classId AND
					               ezcontentobject_tree.contentobject_id = ezcontentobject_name.contentobject_id and
					               ezcontentobject_tree.contentobject_version = ezcontentobject_name.content_version
					                   ORDER BY path_string ASC;";
	  $db = eZDB::instance();			
      $result = $db->arrayQuery( $sql, array(), false );
      return ( count( $result ) == 0 );
    }
}

eZDataType::register( cmsxCpfCnpjType::DATA_TYPE_STRING, 'cmsxCpfCnpjType' );


?>