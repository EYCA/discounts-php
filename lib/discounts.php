<?php

namespace Eyca;

function get_options($filter)
{
  $data = query('
    {
      categories { id name }
      tags
      countries { id name regions }
    }
  ');
  $data['regions'] = [];
  if ($filter['country'] !== FALSE) {
    foreach ($data['countries'] as $_country) {
      if (isset($_country['regions']) and (empty($filter['country']) or $filter['country'] === $_country['id'])) {
        foreach ($_country['regions'] as $_region) {
          $data['regions'][] = [
            'name' => $_region,
            'countryId' => $_country['id'],
          ];
        }
      }
    }
  }
  return $data;
}

function get_options_cached($ttl = CACHE_TTL)
{
  return cache('options', config()['search'], function () {
    return get_options(config()['search']);
  }, CACHE_TTL);
}

function get_discounts($variables)
{
  return query('
    query($country: String, $region: String, $category: String, $tag: String, $type: DiscountType, $skip: Int, $limit: Int) {
      discounts(country: $country, region: $region, category: $category, tag: $tag, type: $type) {
        count
        data(skip: $skip, limit: $limit) {
          id
          name vendor
          image
          locations(country: $country, region: $region) { count }
          categories { id name }
          tags
        }
      }
    }
  ', array_replace($variables, parse_array(config()['search'])))['discounts'];
}

function get_discounts_cached($variables, $ttl = CACHE_TTL)
{
  return cache('discounts', $variables, function () use ($variables) {
    return get_discounts($variables);
  }, CACHE_TTL);
}
function get_discount($id)
{
  return query('
    query ($id: ID!) {
      discount(id: $id) {
        id
        name vendor
        text textLocal
        email phone web
        image
        created
        locations {
          count
          data {
            street city zip country { id name region } geo { lat lng }
          }
        }
        categories { id name }
        tags
      }
    }
  ', [ 'id' => $id ])['discount'];
}

function get_discount_cached($id, $ttl = CACHE_TTL)
{
  return cache('discount', $id, function () use ($id) {
    return get_discount($id);
  }, CACHE_TTL);
}

function parse_array($arr)
{
  if (!$arr) {
    return [];
  }
  return array_map(function ($item) {
    return $item ?: NULL;
  }, array_filter($arr, function ($item) {
    return !($item === NULL);
  }));
}
