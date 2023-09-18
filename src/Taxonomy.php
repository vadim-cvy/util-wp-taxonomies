<?php
namespace Cvy\WP\CustomTaxonomy;

use Cvy\WP\TermsQuery\TermsQuery;

use Cvy\WP\Term\Term;

abstract class CustomTaxonomy extends \Cvy\WP\ObjectsTypeWrap\ObjectsTypeWrapper
{
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
