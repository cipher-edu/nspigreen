<?php

function arts_get_footer_columns( $option ) {
  $columns = [];

  switch ( $option ) {
    case '7_5':
      $columns[0] = 'col-lg-7';
      $columns[1] = 'col-lg-5';
      break;
    case '6_6':
      $columns[0] = 'col-lg-6';
      $columns[1] = 'col-lg-6';
      break;
    case '5_7':
      $columns[0] = 'col-lg-5';
      $columns[1] = 'col-lg-7';
      break;
    default:
      $columns[0] = 'col-12';
      $columns[1] = 'col-12';
      break;
  }

  return $columns;
}
