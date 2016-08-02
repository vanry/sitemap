<?php

namespace Vanry\Sitemap;

use DOMDocument;

class Sitemap
{
    /** @var \DOMDocument */
    private $dom;

    /** @var \DOMNode */
    private $urlset;

    /** @var \DOMNode */
    private $sitemapindex;
    
    /**
     * Create a sitemap instance.
     *
     * @param string $encoding
     */
    public function __construct($encoding = 'utf-8')
    {
        $this->dom = new DOMDocument('1.0', $encoding);

        $this->dom->preserveWhiteSpace = false; 
        $this->dom->formatOutput = true;
    }

    /**
     * Add child elements to url node.
     * 
     * @param string $loc
     * @param string $lastmod
     * @param string $priority
     * @param string $freq
     */
    public function add($loc = null, $lastmod = null, $priority = null, $freq = null)
    {
        $url = $this->createUrl();

        $params = compact('loc', 'lastmod', 'priority', 'freq');

        $this->addItems($url, $params);
    }

    /**
     * Create a url node.
     * 
     * @return \DOMNode
     */
    private function createUrl()
    {
        $url = $this->dom->createElement('url');

        return $this->getUrlset()->appendChild($url);
    }

    /**
     * Get the same urlset node.
     * 
     * @return \DOMNode
     */
    private function getUrlset()
    {
        if (is_null($this->urlset)) {
            $urlset = $this->dom->createElement('urlset');
            $this->urlset = $this->dom->appendChild($urlset);
        }

        return $this->urlset;
    }

    /**
     * Add sitemap nodes to sitemapindex node.
     * 
     * @param string $loc
     * @param string $lastmod
     */
    public function addSitemap($loc = null, $lastmod = null)
    {
        $sitemap = $this->createSitemap();

        $params = compact('loc', 'lastmod');

        $this->addItems($sitemap, $params);
    }

    /**
     * Create a sitemap node.
     * 
     * @return \DOMNode
     */
    private function createSitemap()
    {
        $sitemap = $this->dom->createElement('sitemap');

        return $this->getSitemapindex()->appendChild($sitemap);
    }

    /**
     * Get the same sitemapindex node.
     * 
     * @return \DOMNode
     */
    private function getSitemapindex()
    {
        if (is_null($this->sitemapindex)) {
            $sitemapindex = $this->dom->createElement('sitemapindex');
            $this->sitemapindex = $this->dom->appendChild($sitemapindex);
        }

        return $this->sitemapindex;
    }

    /**
     * Add child elements to a given node.
     * 
     * @param string $node
     * @param array  $params
     */
    private function addItems($node, $params = [])
    {
        foreach ($params as $key => $value) {
            $node->appendChild($this->dom->createElement($key, $value));
        }
    }

    /**
     * Return the sitemap document.
     * 
     * @return string
     */
    public function render()
    {
        return $this->dom->saveXML();
    }

    /**
     * Save sitemap xml file on disk.
     *
     * @param  string $path
     * @return void
     */
    public function save($path)
    {
        $this->dom->save($path);
    }
}
