<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DomController extends Controller
{
    public function index()
    {
        $url = 'https://books.toscrape.com/';
        $html = file_get_contents($url);

        $dom = new \DOMDocument();
        // libxml_use_internal_errors(true);
        $dom->loadHTML($html, LIBXML_NOERROR);

        // Menampilkan DOMDocument
        echo $dom->saveHTML();
    }
}
