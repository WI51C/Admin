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
                    <th class="table-header"><?= $column->header ?></th>
                <?php endforeach ?>
            </tr>
            </thead>
        <?php endif ?>
        <?php if (!empty($this->data)): ?>
            <tbody class="table-body">
            <?php foreach ($this->data as $position => $row): ?>
                <tr class="table-row">
                    <?php foreach ($this->columns as $column): ?>
                        <td class="table-data">
                            <?= $row[$column->name] ?>
                        </td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
            </tbody>
        <?php endif ?>
    </table>
</div>
