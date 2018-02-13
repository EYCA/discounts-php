<?php

namespace Eyca;

return [
  'api' => [
    'url' => 'http://dev.eyca.org/api',
  ],
  'search' => [
    'restrict' => [
      'member' => NULL,
      'country' => NULL,
      'region' => NULL,
      'category' => NULL,
      'tag' => NULL,
    ],
    'default' => [
      'country' => NULL,
      'region' => NULL,
      'category' => NULL,
      'tag' => NULL,
    ],
  ],
  'paginate' => [
    'perpage' => 50,
  ],
  'cache' => [
    'dir' => 'cache',
    'ttl' => 60 * 60,
  ],
  'self' => $_SERVER['REQUEST_URI'],
];
