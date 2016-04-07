<?php

namespace CRUDL\Table;

use DOMDocument;

class Table
{

    /**
     * Headers to display in the table.
     *
     * @var array
     */
    protected $headers;

    /**
     * Data to display in the table.
     *
     * @var array
     */
    protected $data;

    /**
     * Columns to out without escaping.
     *
     * @var array
     */
    protected $noescape;

    /**
     * Instance of DOMDocument.
     *
     * @var DOMDocument
     */
    protected $dom;

    /**
     * Table constructor.
     *
     * @param array $headers  headers to display in the table.
     * @param array $data     data to display in the table.
     * @param array $noescape to avoid escaping.
     */
    public function __construct(array $headers = [], array $data = [], array $noescape = [])
    {
        $this->headers  = $headers;
        $this->data     = $data;
        $this->noescape = $noescape;
    }

    /**
     * Constructs and returns the html for the table.
     *
     * @return string
     */
    public function render()
    {
        $this->dom = new DOMDocument();
        $this->dom->loadHTML('<table><thead><tr></tr></thead><tbody></tbody></table>');

        $this->makeHead();
        $this->makeBody();

        return $this->dom->saveHTML();
    }

    /**
     * Create the head part of the table.
     *
     * @return void
     */
    protected function makeHead()
    {
        foreach ($this->headers as $header) {
            $th = $this->dom->createElement('th', $header);
            $this->dom->getElementsByTagName('tr')->item(0)->appendChild($th);
        }
    }

    /**
     * Create the body part of the table.
     *
     * @return void
     */
    protected function makeBody()
    {
        $body = $this->dom->getElementsByTagName('tbody')->item(0);
        foreach ($this->data as $row) {
            $tr = $this->dom->createElement('tr');
            foreach ($row as $key => $value) {
                if (!in_array($key, $this->noescape)) {
                    $td = $this->dom->createElement('td', $value);
                    $tr->appendChild($td);
                } else {
                    $html = new DOMDocument();
                    @$html->loadHTML($value);
                    $td = $this->dom->createElement('td');
                    $td->appendChild($this->dom->importNode($html->documentElement, true));
                    $tr->appendChild($td);
                }
            }
            $body->appendChild($tr);
        }
    }

    /**
     * Gets the headers of the table.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Sets the headers of the table.
     *
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Gets the data of the table.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Sets the data of the Table.
     *
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }
}
