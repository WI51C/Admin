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
                    <th <?= $column->stringifyAttributes() ?>><?= $column->header ?></th>
                <?php endforeach ?>
            </tr>
            </thead>
        <?php endif ?>
        <?php if (!empty($this->data)): ?>
            <tbody>
            <?php foreach ($this->data as $position => $row): ?>
                <tr>
                    <?php foreach ($this->columns as $column): ?>
                        <?php if ($column->custom): ?>
                            <td><?= call_user_func($column->callable, $row, $position) ?></td>
                        <?php else: ?>
                            <td><?= $column->modifier ? call_user_func($column->modifier, $row[$column->name]) : $row[$column->name] ?></td>
                        <?php endif ?>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
            </tbody>
        <?php endif ?>
    </table>
</div>
