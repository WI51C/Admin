<?php

namespace Admin\Read\Tables;

use Admin\Crud;
use Admin\Read\Relations\RelationBinder;
use Admin\Read\Renderer\Renderer;

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
     * Configuration of the HTML of the Table.
     *
     * @var Html
     */
    public $html;

    /**
     * Configuration of the presentation of the Table.
     *
     * @var Presentation
     */
    public $presenter;

    /**
     * Table constructor.
     *
     * @param Crud $crud
     */
    public function __construct(Crud $crud)
    {
        $this->crud      = $crud;
        $this->html      = new Html();
        $this->presenter = new Presenter();
        $this->sql       = new SQL(new RelationBinder(
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
        $data = $this->getData();

        foreach ($this->sql->relations->getOtmRelations() as $otm) {
            $otmData = $otm->getData();
            foreach ($data as $key => $value) {
                $subData = [];
                foreach ($otmData as $otmKey => $otmRow) {
                    if ($value[$otm->parentColumn] == $otmRow[$otm->childColumn]) {
                        $subData[] = $otmRow;
                    }
                }

                $subRenderer = new Renderer($otm->presenter, $subData);
                $this->presenter->addColumn(sprintf('_%s_', $otm->sql->table), $otm->presenter->alias ?? $otm->sql->table);
                $data[$key][sprintf('_%s_', $otm->sql->table)] = $subRenderer->render();
            }
        }

        $renderer = new Renderer($this->presenter, $data);

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
        foreach ($this->sql->relations->getOneToOneRelations() as $oto) {
            $query->join($oto->table, $oto->condition, $oto->type);
        }

        if ($this->sql->offset !== 0) {
            return $query->get($this->sql->table, $this->sql->limit);
        }

        return $query->get($this->sql->table, [$this->sql->offset, $this->sql->limit]);
    }
}
