<?php

namespace Eyca;

return [
  'api' => [
    'url' => 'http://dev.eyca.org/api',
  ],
  'search' => [
    'country' => NULL,
    'region' => NULL,
    'category' => NULL,
    'tag' => NULL,
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
