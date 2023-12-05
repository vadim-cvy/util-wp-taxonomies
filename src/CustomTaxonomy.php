<?php
namespace Cvy\WP\Taxonomies;

abstract class CustomTaxonomy extends Taxonomy
{
  protected function __construct()
  {
    add_action( 'init', fn() => $this->register() );
  }

  private function register() : void
  {
    register_taxonomy( $this->get_slug(), $this->get_post_types(), $this->get_register_args() );
  }

  abstract protected function get_post_types() : array;

  protected function get_register_args() : array
  {
    $label_single = $this->get_label_single();
    $label_multiple = $this->get_label_multiple();

    $labels = [
      'name'              => 'Genres',
      'singular_name'     => 'Genre',
      'search_items'      => 'Search Genres',
      'all_items'         => 'All Genres',
      'parent_item'       => 'Parent Genre',
      'parent_item_colon' => 'Parent Genre:',
      'edit_item'         => 'Edit Genre',
      'update_item'       => 'Update Genre',
      'add_new_item'      => 'Add New Genre',
      'new_item_name'     => 'New Genre Name',
      'menu_name'         => 'Genre',
    ];

    return [
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => [ 'slug' => $this->get_slug() ],
    ];
  }

  static public function get_label_single() : string
  {
    throw new Exception( 'This method is abstract and must be implemented!' );
  }

  static public function get_label_multiple() : string
  {
    throw new Exception( 'This method is abstract and must be implemented!' );
  }
}