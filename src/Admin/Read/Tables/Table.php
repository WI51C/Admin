<?php

namespace Admin\Read\Tables;

use Admin\Crud;
use Admin\Read\Process\Extractor;
use Admin\Read\Process\Renderer;
use Admin\Read\Relations\RelationBinder;

class Table
{

    /**
     * Name of table to select from.
     *
     * @var string
     */
    public $table;

    /**
     * Instance of CRUD.
     *
     * @var Crud
     */
    protected $crud;

    /**
     * Configuration of the presentation of the Table.
     *
     * @var Presentation
     */
    public $presentation;

    /**
     * Instance of select for limiting the SQL-query.
     *
     * @var Select
     */
    public $select;

    /**
     * Table constructor.
     *
     * @param Crud $crud
     */
    public function __construct(Crud $crud)
    {
        $this->crud         = $crud;
        $this->presentation = new Presentation();
        $this->select       = new Select(new RelationBinder(
                                             $this->crud,
                                             $this
                                         ));
    }

    /**
     * Renders the table as HTML.
     *
     * @return string
     */
    public function render()
    {
        $data      = $this->getData();
        $extractor = new Extractor($this, $data);
        $data      = $extractor->extract();
        $renderer  = new Renderer($this, $data);

        return $renderer->render();
    }

    /**
     * Gets the data of the table.
     *
     * @return array
     */
    public function getData()
    {
        $query = $this->crud->query();
        foreach ($this->select->relations->getOneToOneRelations() as $oto) {
            $query->join($oto->table, $oto->condition, $oto->type);
        }

        if ($this->select->offset !== 0) {
            return $query->get($this->select->table, $this->select->limit);
        }

        return $query->get($this->select->table, [$this->select->offset, $this->select->limit]);
    }
}
