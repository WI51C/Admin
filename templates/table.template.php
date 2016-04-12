<?php if ($this->table->isInline()): ?>
    <a class="waves-effect waves-light btn-large red table-inspect-trigger"><?= $this->table->getMessage() ?></a>
<?php endif ?>
<table class="striped data-table">
    <div>
        <?php if ($this->table->isInline()): ?>
        <?php endif ?>
        <?php if ($this->table->getCaption() !== null): ?>
            <caption><?= $this->table->getCaption() ?></caption>
        <?php endif ?>
    </div>
    <?php if ($this->table->getHead()): ?>
        <thead>
        <tr>
            <?php foreach ($this->table->getColumns() as $column => $header): ?>
                <th><?= $header ?></th>
            <?php endforeach ?>
        </tr>
        </thead>
    <?php endif ?>
    <?php if (!empty($this->data)): ?>
        <tbody>
        <?php foreach ($this->data as $key => $row): ?>
            <tr>
                <?php foreach ($this->table->getColumns() as $column => $header): ?>
                    <td><?= $row[$column] ?></td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
        </tbody>
    <?php endif ?>
</table>