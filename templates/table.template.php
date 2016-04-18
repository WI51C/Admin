<?php if ($this->table->inline): ?>
    <a class="waves-effect waves-light btn-large btn-medium red table-inspect-trigger"><?= $this->table->openMessage ?></a>
<?php endif ?>
<div class="table-container">
    <?php if ($this->table->inline): ?>
        <div class="inline-controls">
            <a class="waves-effect waves-light btn-large btn-medium red table-inspect-exit"><?= $this->table->closeMessage ?></a>
        </div>
    <?php endif ?>
    <table class="table">
        <?php if ($this->table->caption !== null): ?>
            <caption class="table-caption"><?= $this->table->caption ?></caption>
        <?php endif ?>
        <?php if ($this->table->head): ?>
            <thead class="table-head">
            <tr class="table-head-row">
                <?php foreach ($this->columns as $column): ?>
                    <th <?= $column->attributes ?>><?= $column->header ?></th>
                <?php endforeach ?>
            </tr>
            </thead>
        <?php endif ?>
        <?php if (!empty($this->data)): ?>
            <tbody>
            <?php foreach ($this->data as $position => $row): ?>
                <tr>
                    <?php foreach ($this->columns as $column): ?>
                        <td>
                            <?= empty($column->modifiers) ? $row[$column->name] : $column->modify($row[$column->name], $row, $position) ?>
                        </td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
            </tbody>
        <?php endif ?>
    </table>
</div>
