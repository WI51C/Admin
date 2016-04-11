<table>
    <?php if ($this->table->presentation->getCaption() !== null): ?>
        <caption><?= $this->table->presentation->getCaption() ?></caption>
    <?php endif ?>
    <?php if ($this->table->presentation->getHead()): ?>
        <thead>
        <tr>
            <?php foreach ($this->table->presentation->getColumns() as $column => $header): ?>
                <th><?= $header ?></th>
            <?php endforeach ?>
        </tr>
        </thead>
    <?php endif ?>
    <tbody>
    <?php foreach ($this->data as $key => $row): ?>
        <tr>
            <?php foreach ($this->table->presentation->getColumns() as $column => $header): ?>
                <td><?= $row[$column] ?></td>
            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
