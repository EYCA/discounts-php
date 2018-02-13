<?php

namespace Eyca;

define('DIR', __DIR__);
define('DS', DIRECTORY_SEPARATOR);

require __DIR__ . DS . 'lib' . DS .'config.php';
require __DIR__ . DS . 'lib' . DS .'cache.php';
require __DIR__ . DS . 'lib' . DS .'query.php';
require __DIR__ . DS . 'lib' . DS .'forms.php';
require __DIR__ . DS . 'lib' . DS .'templates.php';
require __DIR__ . DS . 'lib' . DS .'discounts.php';

if ($id = formdata()['id']) {
  // discount detail
  $options = get_options_cached();
  $discount = get_discount_cached($id);
  $canonical = link_to([ 'id' => $id ]);
  template('discount', [
    'options' => $options,
    'discount' => $discount,
    'canonical' => $canonical,
  ]);
} else {
  // search
  $pageno = formdata()['pageno'] ? intval(formdata()['pageno']) - 1 : 0;
  $perpage = config()['paginate']['perpage'];
  $options = get_options_cached();
  $discounts = get_discounts_cached(array_replace(formdata(), array_map(function ($item) {
    return $item ?: NULL;
  }, array_filter(config()['search']['restrict'], function ($item) {
    return !($item === NULL);
  })), [
    'skip' => $pageno * $perpage,
    'limit' => $perpage,
  ]));
  $paginate = paginate($discounts['count'], $perpage, $pageno);
  $canonical = link_to([
    'pageno' => $pageno ? $pageno + 1 : NULL,
  ], TRUE);
  template('index', [
    'options' => $options,
    'discounts' => $discounts,
    'paginate' => $paginate,
    'canonical' => $canonical,
  ]);
}

function dump($data, $vars = FALSE)
{
  echo '<pre>';
  if ($vars) {
    var_dump($data);
  } else {
    print_r($data);
  }
  echo '</pre>';
}
