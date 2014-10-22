<?php

namespace Mile23\Sitemap;

use Goutte\Client;
use Pimple\Container;
use Mile23\UrlBuilder;

class SitemapCrawler extends \ArrayIterator {

  public function __construct(UrlBuilder $u) {
    $pages = array();

    $client = new Client();
    $crawler = $client->request('GET', (string) $u);
    $sitemap_crawler = $crawler->filter('urlset > url > loc');

    foreach ($sitemap_crawler as $url_loc) {
      $url = $url_loc->nodeValue;
      $pages[$url] = $url;
    }

    parent::__construct($pages);
  }

}
