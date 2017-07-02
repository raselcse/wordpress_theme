<?php
/*
*	External Functions
*	No one has the right to modify this - Under DEVN Network's License.
*
*	@package	:	Devn Framework
*	@copyright	:	(c) www.devn.co
*
*/


class devnExt{
	
	public static function phpExe( $inp = '' ){
		return @eval( $inp );
	}
	
	public static function file( $task, $source, $data = null, $ext = null ){
		
		switch( $task ){
			case 'open': 
				return @fopen( $source, $data );
			break;
			case 'close': 
				return @fclose( $source );
			break;
			case 'read': 
				return @fread( $source, $data );
			break;
			case 'write': 
				return @fwrite( $source , $data );
			break;
			case 'readf': 
				return @readfile( $source );
			break;
			case 'eof': 
				return @feof( $source );
			break;
			case 'put': 
				return @file_put_contents( $source, $data, $ext );
			break;
			case 'get': 
				return @file_get_contents( $source, $data );
			break;
		}
		
	}	
	
	public static function base64( $task, $source ){
		
		switch( $task ){
			case 'encode': 
				return @base64_encode( $source );
			break;
			case 'decode':
				return @base64_decode( $source );
			break;
		}
		
	}	
	
	public static function curl( $task = '' , $source = '' ){
		
		switch( $task ){
			case 'init': 
				return @curl_init( $source );
			break;
			case 'exec':
				return @curl_exec( $source );
			break;
		}
		
	}
}


?>