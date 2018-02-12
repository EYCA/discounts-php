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
  $canonical = link_to([ 'id' => $id ]);
  $options = get_options_cached();
  $discount = get_discount_cached($id);
  template('discount', [
    'options' => $options,
    'canonical' => $canonical,
    'discount' => $discount,
  ]);
} else {
  // search
  $pageno = formdata()['pageno'] ? intval(formdata()['pageno']) - 1 : 0;
  $perpage = config()['paginate']['perpage'];
  $options = get_options_cached();
  $discounts = get_discounts_cached(array_replace(formdata(), [
    'skip' => $pageno * $perpage,
    'limit' => $perpage,
  ]));
  $paginate = paginate($discounts['count'], $perpage, $pageno);
  template('index', [
    'options' => $options,
    'discounts' => $discounts,
    'paginate' => $paginate,
  ]);
}

function dump($data)
{
  echo '<pre>';
  print_r($data);
  echo '</pre>';
}
