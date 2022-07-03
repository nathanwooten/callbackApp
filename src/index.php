<?php

if ( ! defined( 'DEBUG' ) ) define( 'DEBUG', 1 );

require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'require_once.php';

interface InterfaceAbstract {}

class Standard implements InterfaceAbstract
{

	const RESULT = 'r:';
	const INTERFACE = 'i:'
	const 

	protected $bit = 0;

	protected $method;
	protected $property;

	protected $result = [];

	public function __construct( ...$array )
	{

		$properties = array_keys( $this->input );

		if ( count( $array ) !== count( $properties ) ) {
			throw new Exception( 'Please provided data for all required properties' );
		}

		$this->set( array_combine( $properties, $array ) );

	}

	public function set( array $propertiesAndValues )
	{

		$i = 0;
		foreach ( $propertiesAndValues as $property => $value ) {
			$type = gettype( $value );
			if ( gettype( $value ) !== $type ) {
				throw new Exception( 'Wrong type of input provided as required by the input property of the domain object' );
			}
			$class = array_values( $this->input[ $i ] );
			if ( class_exists( $class ) && ! is_object( $value ) || get_class( $value ) !== $class ) {
				throw new Exception( 'Wrong object type provided' );
			}

			$this->result[ $property ] = $this->$property( $value );
		}

	}

	public function get()
	{

		if ( ! $this->has() ) {

			$properties = $content->properties();
			while( $method = array_shift( $properties ) ) {
				$this->result[ $method ] = $this->$method();
			}
		}

	}

	public function direction( $property, $value = null )
	{

		if ( isset( $value ) ) {
			return $this->$property = $value;
		}

		return $this->$property;

	}


	public function setBit( int $bit ) : int
	{

		if ( ! array_key_exists( $bit, $this->properties ) ) {
			return false;
		}

		return $this->bit = $bit;

	}

	public function getBit()
	{

		return $this->bit;

	}

	public function increment( $callingMethodName, $bit, $count = 1 )
	{

		if ( ! array_key_exists( $bit, $this->properties ) || $cMn === array_search( $callingMethodName, $this->properties ) || $callingMethodName !== $cMn ) ) {
			throw new Exception( 'Oh you\'re really fucked now' );
		}

		while ( $count-- > 0 ) {
			$bit = $bit << $count;
		}

		$this->method = $callingMethodName;
		$this->property = $callingMethodName;

		return $this->bit = $bit;

	}

}

class Fn extends Standard
{

	public $name;
	public $returns;

	public function __construct( $name = null, $input = null, $returns = null )
	{

		parent::__construct( [ 'name' => $name, 'input' => $input, 'returns' => $returns ] );

	}

	public function name( string $functionMethod, InterfaceAbstract|string $objectOrClass = null )
	{

		if ( isset( $objectOrClass ) ) {
			$class = get_class( $objectOrClass );
			$name = $class . '::' . $functionMethod;
		} else {
			$name = $functionMethod;
		}

		$this->direction( __FUNCTION__, $name );

	}

	public function input( ...$inputs )
	{

		$inputs = [];
		foreach ( $inputs as $input ) {
		}

	}

	public function returns( $returnType = null )
	{

		$this->direction( __FUNCTION__, $returnType );

	}

}

class PathSegmentFn extends Fn
{

	public $returns = 'string';

	public $name = 'parse_url';
	public $input = [
		'url',
		'phpUrlConstant' => PHP_URL_PATH
	];

}

interface UrlInterface extends InterfaceNone
{

	public function getUrl();
	public function getTarget();
	public function getSegment( $phpUrlConstant );
	public function withUrl( string $url );

}

class UrlAbstract implements UrlInterface
{

	public string $url;

	public function __construct( $url = null )
	{

		$this->url = ! is_null( $url ) ? $url : $_SERVER[ 'REQUEST_URI' ];

	}

	public function withUrl( string $url ) : UrlInterface
	{

		$clone = clone $this;
		$clone->url = $url;

		return $clone;

	}

	public function getUrl()
	{

		if ( is_null( $this->url ) ) {
			return '/';
		}

		return $this->url;

	}

	public function getTarget()
	{

		if ( ! isset( $this->target ) ) {

			$this->target = '';

			$path = $this->getSegment( PHP_URL_PATH );
			$query = $this->getSegment( PHP_URL_QUERY );
			$fragment = $this->getSegment( PHP_URL_FRAGMENT );

			if ( $path ) {
				$this->target .= $path;				
			}
			if ( $query ) {
				$this->target .= '?' . $query;
			}
			if ( $fragment ) {
				$this->target .= $fragment;
			}

		}

		return $this->target;

	}

	public function getSegment( $phpUrlConstant )
	{

		return parse_url( $this->getUrl(), $phpUrlConstant );

	}

}
class Url
{

	public $file;
	public $path;
	public $root;
	public $url;

	public function __construct( UrlInterface $url )
	{

		$this->url = $url;

		$this->root = CONTENTPATH;

		$path = $this->url->getSegment( PHP_URL_PATH );

		$this->file = basename( $path ) . 'content.php';
		$this->path = str_replace( $this->file, '', $path );

	}

	public function basename( $path )
	{

		return basename( $path );

	}

}

class ContentTitle extends Standard
{

	public $fn = [
		'url' => UrlInterface::class,
		'path' => UrlInterface::class
	];

	public function resultHasInterface( $interface )
	{

		$results = $this->result;
		while ( $result = array_shift( $results ) && $result
			if ( in_array( $interface, class_implements( $result ) ) ) {
				return $result;
			}
		}

		return false;

	}


	public function url( UrlInterface $url )
	{

		return $this->direction( $url );

	}

	public function path( UrlInterface $url )
	{

		


	}

}

class ContentFile extends Standard

	public $resultKey = 'pull';

	public $fn = [
		'file' => 'string',
		'pull' => 'r:file'
	];

	protected $file;
	protected $pull;

	protected function file( $file = null )
	{

		if ( ! isset( $file ) ) {
			return $this->file;
		}

		$this->has = 0;

		return $this->file = $file;

	}

	protected function pull( $file = null )
	{

		if ( isset( $this->pull ) && $this->match() ) {
			return $this->pull;
		}

		$pull = '';

		$fh = fopen( $this->file(), 'r' );
		if ( false === $fh ) {
			throw new Exception( 'Could not create file resource from provided filename' );
		}
		$this->fh = $fh;

		while ( $line = fread( $fh, 1024 ) ) {
			$pull .= PHP_EOL . $line;
		}

		$this->increment( $this->getPosition(), __FUNCTION__ );

		return $this->pull = $content;

	}

	protected function match()
	{

		if ( ! isset( $this->fh ) ) {
			return true;
		}

		$meta = stream_get_meta_data( $this->fh );

		if ( $this->basename === $meta[ 'uri' ] ) {
			return true;
		}

		return false;

	}

	public function has()
	{

		return $this->has;

	}

}

$url = new Url;
$file = $url->getFile();

$content = new Content( $file );
$content = $content->resultKey();

var_dump( $content );

