<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends MY_Controller {

    public function index()
    {
        $this->load->model('Model_common');
        $this->load->model('Model_news');
        $this->load->model('Model_event');

        $urls = array();

        $static_pages = array(
            '' => '1.0',
            'about' => '0.8',
            'news' => '0.9',
            'event' => '0.7',
            'faq' => '0.6',
            'contact' => '0.8',
            'photo-gallery' => '0.5',
            'pricing' => '0.6',
            'testimonial' => '0.5',
            'terms-and-conditions' => '0.3',
            'privacy-policy' => '0.3'
        );

        foreach($static_pages as $path => $priority) {
            $this->add_url($urls, base_url($path), $priority, 'weekly');
        }

        foreach($this->Model_news->all_news() as $row) {
            $this->add_url($urls, base_url('news/view/'.$row['news_id']), '0.7', 'weekly', $this->format_date($row['news_date']));
        }

        foreach($this->Model_event->all_event() as $row) {
            $this->add_url($urls, base_url('event/view/'.$row['event_id']), '0.6', 'weekly', $this->format_date($row['event_start_date']));
        }

        foreach($this->Model_common->all_categories() as $row) {
            $this->add_url($urls, base_url('category/'.$row['category_id']), '0.6', 'weekly');
        }

        foreach($this->Model_common->all_dynamic_pages() as $row) {
            if(!empty($row['slug'])) {
                $this->add_url($urls, base_url('page/'.$row['slug']), '0.6', 'monthly');
            }
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach($urls as $url) {
            $xml .= '  <url>'."\n";
            $xml .= '    <loc>'.htmlspecialchars($url['loc'], ENT_QUOTES, 'UTF-8').'</loc>'."\n";
            if(!empty($url['lastmod'])) {
                $xml .= '    <lastmod>'.$url['lastmod'].'</lastmod>'."\n";
            }
            $xml .= '    <changefreq>'.$url['changefreq'].'</changefreq>'."\n";
            $xml .= '    <priority>'.$url['priority'].'</priority>'."\n";
            $xml .= '  </url>'."\n";
        }

        $xml .= '</urlset>';

        $this->output
            ->set_content_type('application/xml', 'utf-8')
            ->set_output($xml);
    }

    private function add_url(&$urls, $loc, $priority = '0.5', $changefreq = 'weekly', $lastmod = '')
    {
        $urls[$loc] = array(
            'loc' => $loc,
            'priority' => $priority,
            'changefreq' => $changefreq,
            'lastmod' => $lastmod
        );
    }

    private function format_date($date)
    {
        $timestamp = strtotime($date);
        return $timestamp ? date('Y-m-d', $timestamp) : '';
    }
}
