<?php

namespace Admin\Table;

use DOMDocument;

class TableRenderer
{

    /**
     * Headers to display in the table.
     *
     * @var array
     */
    protected $headers = [];

    /**
     * Data to display in the table.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Columns to out without escaping.
     *
     * @var array
     */
    protected $escape = [];

    /**
     * The dom instance for creating.
     *
     * @var DOMDocument
     */
    protected $dom;

    /**
     * Sets the headers of the table.
     *
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Sets the data of the table.
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

    /**
     * Sets the data of the table.
     *
     * @param array $escape
     *
     * @return $this
     */
    public function setEscape(array $escape)
    {
        $this->escape = $escape;

        return $this;
    }

    /**
     * Constructs and returns the html for the table.
     *
     * @return string
     */
    public function render()
    {
        $this->dom = new DOMDocument();
        $this->dom->loadHTML(
            '<table>
                <thead>
                    <tr></tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            ');

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
}
