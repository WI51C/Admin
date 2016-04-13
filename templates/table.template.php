<?php if ($this->table->isInline()): ?>
    <a class="waves-effect waves-light btn-large btn-medium red table-inspect-trigger"><?= $this->table->getMessage() ?></a>
<?php endif ?>
<div class="table-container">
    <?php if ($this->table->isInline()): ?>
        <div class="inline-controls">
            <a class="waves-effect waves-light btn-large btn-medium red table-inspect-exit">Exit</a>
        </div>
    <?php endif ?>
    <table <?= $this->table->htmlAttributes() ?>>
        <?php if ($this->table->getCaption() !== null): ?>
            <caption><?= $this->table->getCaption() ?></caption>
        <?php endif ?>
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
</div>
