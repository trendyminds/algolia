# <img src="resources/logo.svg" width="35" alt="Algolia logo"> Algolia for Craft CMS

Easily pull search results from Algolia into your Craft CMS website.

## Installation

To install Algolia, follow these steps:

1. Download & unzip the file and place the `algolia` directory into your `craft/plugins` directory
2. Install plugin in the Craft Control Panel under Settings > Plugins
3. The plugin folder should be named `algolia` for Craft to see it. GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.
4. Enter your Application ID and API Key into the Settings area to connect to your Algolia account

Algolia works on Craft 2.4.x and Craft 2.5.x.

## Usage

You can access your Algolia data within your templates using Twig variables or controller endpoints (as a simple REST API):

### Using Twig
```twig
{#
 # Browse an entire index
 #}

{% set optionalBrowseAttrs = {
    distinct: true,
    getRankingInfo: true
  }
%}
{% for record in craft.algolia.browse("indexName", "optional query", optionalBrowseAttrs) %}

{% endfor %}



{#
 # Search within an index
 #}

{% set optionalSearchAttrs = {
    hitsPerPage: 5,
    offset: 2,
    page: 7
  }
%}
{% for search in craft.algolia.search("indexName", "your query", optionalSearchAttrs) %}
  {% for hit in search.hits %}

  {% endfor %}
{% endfor %}
```

### Using REST API controllers
In additional to Twig variables you can make a POST request to one of the following controller endpoints. The same index, query and optional attributes are available when you make your POST request.

**/actions/algolia/browse:**
```json
{
  index: "indexName"
  query: "optional query",
  attrs: {
    distinct: true,
    getRankingInfo: true
  }
}
```

**/actions/algolia/search:**
```json
{
  index: "indexName"
  query: "your query",
  attrs: {
    hitsPerPage: 5,
    offset: 2,
    page: 7
  }
}
```
