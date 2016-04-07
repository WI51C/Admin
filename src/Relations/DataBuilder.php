<?php

namespace CRUDL\Relations;

class DataBuilder
{

    /**
     * Base headers of the table.
     *
     * @var array
     */
    protected $baseHeaders = [];

    /**
     * Base data of the table.
     *
     * @var array
     */
    protected $baseData = [];

    /**
     * Extensions made to the table.
     *
     * @var array
     */
    protected $extensions = [];

    /**
     * Sub-tables of the data.
     *
     * @var array
     */
    protected $subTables = [];

    /**
     * DataBuilder constructor.
     *
     * @param array $baseHeaders
     * @param array $baseData
     */
    public function __construct(array $baseHeaders = [], array $baseData = [])
    {
        $this->baseHeaders = $baseHeaders;
        $this->baseData    = $baseData;
    }

    /**
     * Extends the data and headers of the data.
     *
     * @param array $header
     * @param array $data
     *
     * @return $this
     */
    public function extend(array $header, array $data)
    {
        $this->extensions[] = [
            $header,
            $data,
        ];

        return $this;
    }

    /**
     * Adds a sub-table to the data.
     *
     * @param array $header
     * @param array $tableData
     *
     * @return $this
     */
    public function subTable(array $header, array $tableData)
    {
        $this->subTables[] = [
            $header,
            $tableData,
        ];

        return $this;
    }

    /**
     * Builds and returns the resulting array.
     *
     * @return array
     */
    public function build()
    {
        return [
            'headers' => $this->getHeaders(),
            'data'    => $this->getData(),
        ];
    }

    /**
     * Gets the headers of the current DataBuilder instance.
     *
     * @return array
     */
    public function getHeaders()
    {
        $headers = $this->baseHeaders;
        foreach ($this->extensions as $extension)
            $headers = array_merge($headers, $extension[0]);
        foreach ($this->subTables as $table)
            $headers = array_merge($headers, $table[0]);

        return $headers;
    }

    public function getData()
    {
        $data = $this->baseData;
        foreach ($this->extensions as $extension)
            foreach ($extension[1] as $position => $dataset)
                foreach ($dataset as $key => $value)
                    $data[$position][$key] = $value;

        foreach ($this->subTables as $tableNum => $tables) {
            foreach ($tables[1] as $position => $table) {
                $data[$position][$this->getColumn($table[0])] = $table;
            }
        }

        return $data;
    }

    /**
     * Returns the column value from a header array.
     *
     * @param array $header
     *
     * @return string
     */
    protected function getColumn(array $header)
    {
        return is_int($key = array_keys($header)[0]) ? array_values($header)[0] : $key . '_inline_table';
    }
}