<?php

namespace Eyca;

function get_options()
{
  $data = query('
    {
      categories { id name }
      tags
      countries { id name regions }
    }
  ');
  return $data;
}

function get_options_cached($ttl = CACHE_TTL)
{
  return cache('options', NULL, function () {
    return get_options();
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
  ', $variables)['discounts'];
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
