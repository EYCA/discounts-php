<?php

namespace Eyca;

return [
  'api' => [
    // API url
    'url' => 'https://www.eyca.org/api',
  ],
  'search' => [
    // (array) restrict search options to certain parameters
    'restrict' => [
      // (24 hexadecimal string) find member id at http://dev.eyca.org/members/[member-id]
      'member' => NULL,
      // (string) ISO 3166-1 alpha-2 country code
      // set FALSE to prevent user input
      'country' => NULL,
      // (string) region name; query for available regions via API `{ countries { id regions } }`
      // set FALSE to prevent user input
      'region' => NULL,
      // (string) category id; query for available categories via API `{ categories { id name } }`
      // set FALSE to prevent user input
      'category' => NULL,
      // (string) tag; query for available tags via API `{ tags }`
      // set FALSE to prevent user input
      'tag' => NULL,
      // (string) keyword
      // set FALSE to prevent user input
      'keyword' => NULL,
    ],
    // (array) set default search query
    'default' => [
      'country' => NULL,
      'region' => NULL,
      'category' => NULL,
      'tag' => NULL,
      'keyword' => NULL,
    ],
  ],
  // (array) pagination
  'paginate' => [
    // (int) set number of entries per page
    'perpage' => 50,
  ],
  // (array) cache setup
  'cache' => [
    // (string) path to cache direcotry
    // either relative path to document root
    // or absolute path when starting with `/`
    // directory must be writable
    'dir' => 'cache',
    // (int) cache lifespan in seconds
    'ttl' => 60 * 60,
  ],
  // (string) request uri
  'self' => $_SERVER['REQUEST_URI'],
];
