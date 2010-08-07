<?php

class cmsxBrPhoneType extends eZDataType
{
    const DATA_TYPE_STRING = 'cmsxbrphone';

    const REQUIRE_NONE = 0; 
    const REQUIRE_AREA = 1;     
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct( self::DATA_TYPE_STRING, 
                             ezi18n( 'extension/brdatatypes', 'Brazilian Phone', 'Datatype name' ),
                              array( 'serialize_supported' => true,
                                     'object_serialize_map' => array( 'data_text' => 'brphone' ) ) );
    }

    function validateObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute, $infoCollector = false )
    {
        if ( $http->hasPostVariable( $base . '_data_brphone_' . $contentObjectAttribute->attribute( 'id' ) ) )
        {
			$contentClass = $contentObjectAttribute->contentClassAttribute();
           	$phone = trim( $http->postVariable( $base . '_data_brphone_' . $contentObjectAttribute->attribute( 'id' ) ) );
            if ( $phone == '' && $contentObjectAttribute->validateIsRequired() && 
                 ( !$contentObjectAttribute->attribute( 'is_information_collector' ) || $infoCollector ) )
            {
            	$contentObjectAttribute->setValidationError( 
            	    ezi18n( 'extension/brdatatypes/brphone/content/datatype', 'Phone number is mandatory' ) );
				return eZInputValidator::STATE_INVALID;
            }
            $requireArea = $contentClass->attribute( 'data_int1' );
            if ( $phone != '' && $requireArea && !self::isPhoneNumber( $phone, true ) )
            {
            	$contentObjectAttribute->setValidationError( 
            	    ezi18n( 'extension/brdatatypes/brphone/content/datatype', 'Area number is mandatory' ) );
				return eZInputValidator::STATE_INVALID;
            }
            if ( $phone != '' && !self::isPhoneNumber( $phone, false ) )
            {
            	$contentObjectAttribute->setValidationError( 
            	    ezi18n( 'extension/brdatatypes/brphone/content/datatype', 'Invalid phone number' ) );
				return eZInputValidator::STATE_INVALID;
            }            
            return eZInputValidator::STATE_ACCEPTED;
        }
        elseif ( $contentObjectAttribute->validateIsRequired() )
        {
            $contentObjectAttribute->setValidationError( 
                ezi18n( 'extension/brdatatypes/brphone/content/datatype', 'Phone number is mandatory' ) );
			return eZInputValidator::STATE_INVALID;
        }
        return eZInputValidator::STATE_ACCEPTED;
    }

    function fetchObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
    	if ( $http->hasPostVariable( $base . '_data_brphone_' . $contentObjectAttribute->attribute( 'id' ) ) )
        {
        	$phone = $http->postVariable( $base . '_data_brphone_' . $contentObjectAttribute->attribute( 'id' ) );
        	$contentObjectAttribute->setAttribute( 'data_text', self::cleanPhone( $phone ) );
        	return true;
        }
        return false;
    }

    function objectAttributeContent( $contentObjectAttribute )
    {
        return $contentObjectAttribute->attribute( "data_text" );
    }
    /**
     * Validate information collector
     */
    function validateCollectionAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
    	return $this->validateObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute, true );
    }
    /** 
     * Fetches the http post variables for collected information
     */
    function fetchCollectionAttributeHTTPInput( $collection, $collectionAttribute, $http, $base, $contentObjectAttribute )
    {
        if ( $http->hasPostVariable( $base . '_data_brphone_' . $contentObjectAttribute->attribute( 'id' ) ) )
        {
        	$phone = $http->postVariable( $base . '_data_brphone_' . $contentObjectAttribute->attribute( 'id' ) );
        	$collectionAttribute->setAttribute( 'data_text', self::cleanPhone( $phone ) );
        	return true;
        }
        return false;
    }
    function fetchClassAttributeHTTPInput( $http, $base, $classAttribute )
    {
        $classAttributeID = $classAttribute->attribute( 'id' );
        if ( $http->hasPostVariable( $base . '_brphone_post_' . $classAttributeID ) )
        {
            $area = self::REQUIRE_NONE;
        	if ( $http->hasPostVariable( $base . '_brphone_area_' . $classAttributeID ) )
			{
				$area = $http->postVariable( $base . '_brphone_area_' . $classAttributeID );
			}
			$classAttribute->setAttribute( 'data_int1', $area );
			$classAttribute->store(); 	
        }
        return true;
    }
    function isIndexable()
    {
        return true;
    }
    function isInformationCollector()
    {
        return true;
    }
    function metaData( $contentObjectAttribute )
    {
        return $contentObjectAttribute->attribute( "data_text" );
    }

    function title( $contentObjectAttribute, $name = null )
    {
        return $contentObjectAttribute->attribute( "data_text" );
    }

    function hasObjectAttributeContent( $contentObjectAttribute )
    {
        return trim( $contentObjectAttribute->attribute( "data_text" ) ) != '';
    }
    
    function sortKey( $contentObjectAttribute )
    {
        return $contentObjectAttribute->attribute( 'data_text' );
    }
    function sortKeyType()
    {
        return 'string';
    }
    public static function isPhoneNumber( $num, $validateArea = false )
    {
    	$num = self::cleanPhone( $num );
        if ( $validateArea ) 
        {
            if ( preg_match( '/^(\()?[1-9]{2}(?(1)\))[- ](\d{4})/', $num ) )
            {
                return  true;
            }
        }
        else
        {
            if ( preg_match( '/^(\()?([1-9]{2})?(?(1)\))[- ]?(\d{4})[- ]?(\d{4})$/', $num ) )
            {
                return true;
            }
        }
        return false;
    }    
    public static function cleanPhone( $num )
    {
    	$num = preg_replace( '/([^\(\) \-\d])+/i', '', trim( $num ) );
        return $num;
    }
}

eZDataType::register( cmsxBrPhoneType::DATA_TYPE_STRING, 'cmsxBrPhoneType' );


?>