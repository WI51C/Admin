<?php

namespace Admin\Relations\Instances;

class MTMRelation extends OTMRelation
{

    /**
     * Name of the linking table.
     *
     * @var string
     */
    protected $linkTable;

    /**
     * The condition to join on the link table.
     *
     * @var string
     */
    protected $linkCondition;

    /**
     * The type of join to perform on the link table.
     *
     * @var string
     */
    protected $linkType;

    /**
     * Sets the link table of the sql.
     *
     * @param string $table
     *
     * @return $this
     */
    public function linkTable(string $table)
    {
        $this->linkTable = $table;

        return $this;
    }

    /**
     * Sets the type of the join on the link table.
     *
     * @param string $type
     *
     * @return $this
     */
    public function linkType(string $type)
    {
        $this->linkType = $type;

        return $this;
    }

    /**
     * Sets condition of the join on the link table.
     *
     * @param string $condition
     *
     * @return $this
     */
    public function linkCondition(string $condition)
    {
        $this->linkCondition = $condition;

        return $this;
    }

    /**
     * Gets the data of the tabular relation table.
     *
     * @return array
     */
    public function getData()
    {
        // TODO: Implement getData() method.
    }
}
