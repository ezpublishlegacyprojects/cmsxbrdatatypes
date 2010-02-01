<?php

class cmsxBrStateType extends eZDataType
{
    const DATA_TYPE_STRING = 'cmsxbrstate';
    
    const FORCE_VALID = 1;    
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct( self::DATA_TYPE_STRING, 
                             ezi18n( 'extension/brdatatypes', 'Brazilian state', 'Datatype name' ),
                              array( 'serialize_supported' => true,
                                     'object_serialize_map' => array( 'data_text' => 'brstate' ) ) );
    }

    function validateObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
        if ( $http->hasPostVariable( $base . '_data_brstate_' . $contentObjectAttribute->attribute( 'id' ) ) )
        {
			$contentClass = $contentObjectAttribute->contentClassAttribute();
			$valid = $contentClass->attribute( 'data_int1' );

           	$state = trim( $http->postVariable( $base . '_data_brstate_' . $contentObjectAttribute->attribute( 'id' ) ) );
            if ( $state == '' && !$classAttribute->attribute( 'is_information_collector' ) && 			 
                 $contentObjectAttribute->validateIsRequired() )
            {
            	$contentObjectAttribute->setValidationError( 
            	    ezi18n( 'extension/brdatatypes/brstate/content/datatype', 'State is mandatory' ) );
				return eZInputValidator::STATE_INVALID;
            }
            $isValid = self::isBrState( $state, $valid );
            if ( $state != '' && !$isValid )
            {
            	$contentObjectAttribute->setValidationError( 
            	    ezi18n( 'extension/brdatatypes/brstate/content/datatype', 'Invalid State' ) );
				return eZInputValidator::STATE_INVALID;
            }
            return eZInputValidator::STATE_ACCEPTED;
        }
        elseif ( $contentObjectAttribute->validateIsRequired() )
        {
            $contentObjectAttribute->setValidationError( 
                ezi18n( 'extension/brdatatypes/brstate/content/datatype', 'State is mandatory' ) );
			return eZInputValidator::STATE_INVALID;
        }
        return eZInputValidator::STATE_ACCEPTED;
    }

    function fetchObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
    	if ( $http->hasPostVariable( $base . '_data_brstate_' . $contentObjectAttribute->attribute( 'id' ) ) )
        {
        	$state = $http->postVariable( $base . '_data_brstate_' . $contentObjectAttribute->attribute( 'id' ) );
        	$contentObjectAttribute->setAttribute( 'data_text', $state );
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
    	if ( $http->hasPostVariable( $base . '_data_brstate_' . $contentObjectAttribute->attribute( 'id' ) ) )
        {
			$contentClass = $contentObjectAttribute->contentClassAttribute();
			$valid = $contentClass->attribute( 'data_int1' );

           	$state = trim( $http->postVariable( $base . '_data_brstate_' . $contentObjectAttribute->attribute( 'id' ) ) );
            if ( $state == '' && $contentObjectAttribute->validateIsRequired() )
            {
            	$contentObjectAttribute->setValidationError( 
            	    ezi18n( 'extension/brdatatypes/brstate/content/datatype', 'State is mandatory' ) );
				return eZInputValidator::STATE_INVALID;
            }
            $isValid = self::isBrState( $state, $valid );
            if ( $state != '' && !$isValid )
            {
            	$contentObjectAttribute->setValidationError( 
            	    ezi18n( 'extension/brdatatypes/brstate/content/datatype', 'Invalid State' ) );
				return eZInputValidator::STATE_INVALID;
            }
            return eZInputValidator::STATE_ACCEPTED;
        }
        elseif ( $contentObjectAttribute->validateIsRequired() )
        {
            $contentObjectAttribute->setValidationError( 
                ezi18n( 'extension/brdatatypes/brstate/content/datatype', 'State is mandatory' ) );
			return eZInputValidator::STATE_INVALID;
        }
    }
    /** 
     * Fetches the http post variables for collected information
     */
    function fetchCollectionAttributeHTTPInput( $collection, $collectionAttribute, $http, $base, $contentObjectAttribute )
    {
        if ( $http->hasPostVariable( $base . '_data_brstate_' . $contentObjectAttribute->attribute( 'id' ) ) )
        {
        	$state = $http->postVariable( $base . '_data_brstate_' . $contentObjectAttribute->attribute( 'id' ) );
        	$collectionAttribute->setAttribute( 'data_text', $state );
        	return true;
        }
        return false;
    }
    function fetchClassAttributeHTTPInput( $http, $base, $classAttribute )
    {
        $classAttributeID = $classAttribute->attribute( 'id' );
        if ( $http->hasPostVariable( $base . '_brstate_post_' . $classAttributeID ) )
        {
        	$valid = 0;
        	if ( $http->hasPostVariable( $base . '_brstate_valid_' . $classAttributeID ) )
			{
				$valid = $http->postVariable( $base . '_brstate_valid_' . $classAttributeID );
			}
            $names = 0;
        	if ( $http->hasPostVariable( $base . '_brstate_names_' . $classAttributeID ) )
			{
				$names = $http->postVariable( $base . '_brstate_names_' . $classAttributeID );
			}
			$classAttribute->setAttribute( 'data_int1', $valid );
			$classAttribute->setAttribute( 'data_int2', $names );
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
    public static function isBrState( $state, $blockNA = true )
    {
    	$state = strtoupper( $state );
        $validStates = array( 'AC','AP','AL','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA',
                            'PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO' );
        $validStates = $blockNA ? $validStates : array_merge( $validStates, array( 'NA' ) );
        return in_array( $state, $validStates );
    }
}

eZDataType::register( cmsxBrStateType::DATA_TYPE_STRING, 'cmsxBrStateType' );


?>