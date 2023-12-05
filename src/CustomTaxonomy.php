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
      'name'              => "$label_multiple",
      'singular_name'     => "$label_single",
      'search_items'      => "Search $label_multiple",
      'all_items'         => "All $label_multiple",
      'parent_item'       => "Parent $label_single",
      'parent_item_colon' => "Parent $label_single:",
      'edit_item'         => "Edit $label_single",
      'update_item'       => "Update $label_single",
      'add_new_item'      => "Add New $label_single",
      'new_item_name'     => "New $label_single Name",
      'menu_name'         => "$label_single",
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