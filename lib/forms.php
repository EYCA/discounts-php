<?php

namespace Eyca;

function formdata()
{
  static $data;
  if (!$data) {
    if ($_GET) {
      $data = [
        'country' => formitem('country', '[A-Z]{2}( [A-Z][\w\s\-]*)?'),
        'region' => formitem('region', '[A-Z][\w\s\-]*'),
        'category' => formitem('category', '[A-Z]{2}'),
        'tag' => formitem('tag', '[a-z\-]+'),
        'keyword' => formitem('keyword', '.*'),
        'pageno' => formitem('pageno', '\d+'),
        'id' => formitem('id', '[a-f\d]{24}'),
      ];
      if ($data['country'] and !$data['region']) {
        $country = explode(' ', $data['country']);
        $data['country'] = $country[0];
        $data['region'] = join(' ', array_slice($country, 1)) ?: NULL;
      }
    } else {
      $data = array_replace([
        'country' => NULL,
        'region' => NULL,
        'category' => NULL,
        'tag' => NULL,
        'keyword' => NULL,
        'pageno' => NULL,
        'id' => NULL,
      ], config()['search']['default']);
    }
  }
  return $data;
}

function formitem($key, $pattern)
{
  if (empty($_GET[$key])) return NULL;
  $input = $_GET[$key];
  if ('string' !== gettype($input)) throw new \Exception('invalid type: ' . $key);
  if (!preg_match('#^' . $pattern . '$#u', $input)) throw new \Exception('invalid value: ' . $key);
  return $input;
}

function paginate($total, $perpage, $pageno) {
  $pages = intval(ceil($total / $perpage));
  $min = ($pages > 9 ? (($pageno > $pages - 3 ? $pages - 5 : NULL) ?: ($pageno > 0 + 4 ? $pageno - 2 : NULL)) : NULL);
  $max = ($pages > 9 ? (($pageno < 3 ? $min + 5 : NULL) ?: ($pageno < $pages - 5 ? $pageno + 3 : NULL)) : NULL);
  if (!$min) $min = 0;
  if (!$max) $max = $pages;
  return [
    'total'   => $total,
    'pageno'  => $pageno,
    'pages'   => $pages,
    'perpage' => $perpage,
    'min'     => $min,
    'max'     => $max,
  ];
}

function link_to($params = NULL, $include = FALSE)
{
  $url = parse_url(config()['self']);
  $include = $include ? formdata() : [];
  $query = array_filter(array_replace($include, $params ?: []));
  return $url['path'] . ($query ? '?' . http_build_query($query) : '');
}
