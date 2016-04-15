<?php if ($this->table->inline): ?>
    <a class="waves-effect waves-light btn-large btn-medium red table-inspect-trigger"><?= $this->table->open ?></a>
<?php endif ?>
<div class="table-container">
    <?php if ($this->table->inline): ?>
        <div class="inline-controls">
            <a class="waves-effect waves-light btn-large btn-medium red table-inspect-exit">Exit</a>
        </div>
    <?php endif ?>
    <table <?= $this->table->stringifyAttributes() ?>>
        <?php if ($this->table->caption !== null): ?>
            <caption><?= $this->table->caption ?></caption>
        <?php endif ?>
        <?php if ($this->table->head): ?>
            <thead>
            <tr>
                <?php foreach ($this->columns as $column): ?>
                    <th <?= $column->stringifyAttributes() ?>><?= $column->alias ?></th>
                <?php endforeach ?>
            </tr>
            </thead>
        <?php endif ?>
        <?php if (!empty($this->data)): ?>
            <tbody>
            <?php foreach ($this->data as $key => $row): ?>
                <tr>
                    <?php foreach ($this->columns as $column): ?>
                        <td><?= $column->content($row[$column->name], $row) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
            </tbody>
        <?php endif ?>
    </table>
</div>
