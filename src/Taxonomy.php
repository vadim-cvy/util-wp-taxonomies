<?php
namespace Cvy\WP\Taxonomies;

use Cvy\WP\TermsQuery\TermsQuery;

use Cvy\WP\Term\Term;

abstract class Taxonomy extends \Cvy\WP\ObjectsTypeWrapper\ObjectsTypeWrapper
{
  static public function get_label_single() : string
  {
    return static::get_original()->labels->singular_name;
  }

  static public function get_label_multiple() : string
  {
    return static::get_original()->labels->name;
  }

  static public function get_original() : \stdClass
  {
    return get_taxonomy( static::get_slug() );
  }

  static public function wrap_one( int $term_id ) : Term
  {
    return new Term( $term_id );
  }

  static final public function build_query( array $query_args = [] ) : TermsQuery
  {
    $query_args['taxonomy'] = static::get_slug();

    return parent::build_query( $query_args );
  }

  static protected function get_query_instance( array $query_args ) : TermsQuery
  {
    return new TermsQuery( $query_args );
  }

  static final public function get_all( array $query_args = [] ) : array
  {
    return static::get( $query_args );
  }
}
