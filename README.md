# <img src="src/icon.svg" width="35" alt="Algolia logo"> Algolia

<img src="resources/promo-banner.png" alt="Query your Algolia data using Twig">

## About

Algolia for Craft CMS allows you to easily pull search results from Algolia into your Twig templates or through REST API endpoints.

## Template Usage

### Browse an index

[Additional search parameters](https://www.algolia.com/doc/api-reference/search-api-parameters/) can be provided in the `params` object.

```twig
{% for result in craft.algolia.browse({
    index: "indexName",
    query: "optional query",
    params: {
      distinct: true,
      getRankingInfo: true
    }
  })
%}

{% endfor %}
```

### Search an index

[Additional search parameters](https://www.algolia.com/doc/api-reference/search-api-parameters/) can be provided in the `params` object.

```twig
{% set search = craft.algolia.search({
    index: "indexName",
    query: "optional query",
    params: {
      hitsPerPage: 5,
      page: 7
    }
  })
%}

{% for hit in search.hits %}

{% endfor %}
```

### Perform a multiple query search

[Additional search parameters](https://www.algolia.com/doc/api-reference/search-api-parameters/) can be provided in each `queries` object.

```twig
{% set search = craft.algolia.multipleQueries([
    {
      indexName: "indexName1",
      query: "optional query"
    },
    {
      indexName: "indexName2",
      query: "optional query"
    }
  ])
%}

{% for group in search.results %}
  {% for hit in group.hits %}

  {% endfor %}
{% endfor %}
```

### Parsing filters

When using filters in an Algolia search the engine requires [a particular syntax](https://www.algolia.com/doc/api-reference/api-parameters/filters/). Rather than stringifying your filters in Twig this plugin offers a way to convert an object like...

```json
{
  "food": ["fries", "cake", "pizza"],
  "colors": ["blue", "green", "red"],
  "featured": true
}
```
to a valid Algolia filter string like...
```
'(food:"fries" OR food:"cake" OR food:"pizza") AND (colors:"blue" OR colors:"green" OR colors:"red") AND (featured:"1")'
```

```twig
{% set filters = {
  food: ['fries', 'cake', 'pizza'],
  colors: ['blue', 'green', 'red'],
  featured: true
} %}

{{ craft.algolia.parseFilters(filters) }}
```

## Using JSON REST API controllers
In additional to Twig variables you can make a `POST` request to one of the following controller endpoints. The same index, query and optional attributes are available when you make your `POST` request.

**NOTE**: The following examples use [Axios](https://github.com/axios/axios) for making API requests

### Browse an index

[Additional search parameters](https://www.algolia.com/doc/api-reference/search-api-parameters/) can be provided in the `params` object.

```js
axios.post("/actions/algolia/default/browse", {
  index: "indexName",
  query: "optional query",
  params: {
    distinct: true,
    getRankingInfo: true
  }
}, {
  headers: {
    "X-CSRF-Token": YOUR_CRAFT_CSRF_TOKEN
  }
});
```

### Search an index

[Additional search parameters](https://www.algolia.com/doc/api-reference/search-api-parameters/) can be provided in the `params` object.

```js
axios.post("/actions/algolia/default/search", {
  index: "indexName",
  query: "optional query",
  params: {
    hitsPerPage: 5,
    page: 7
  }
}, {
  headers: {
    "X-CSRF-Token": YOUR_CRAFT_CSRF_TOKEN
  }
});
```

### Perform a multiple query search

[Additional search parameters](https://www.algolia.com/doc/api-reference/search-api-parameters/) can be provided in each `queries` object.

```js
axios.post("/actions/algolia/default/multiple-queries", {
  queries: [
    {
      indexName: "indexName1",
      query: "optional query"
    },
    {
      indexName: "indexName2",
      query: "optional query"
    }
  ]
}, {
  headers: {
    "X-CSRF-Token": YOUR_CRAFT_CSRF_TOKEN
  }
});
```

## Requirements

This plugin requires Craft CMS 3.1.19+ and PHP 7.1+.

## Installation

[Install Algolia from the Craft CMS Plugin Store!](https://plugins.craftcms.com/algolia)

## Attribution
This plugin is powered by the [Algolia PHP API client](https://www.algolia.com/doc/api-client/getting-started/install/php/). The client and icon/logo belong to Algolia.
