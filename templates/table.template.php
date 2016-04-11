<table>
    <?php if ($this->table->presentation->caption !== null): ?>
        <caption><?= $this->table->presentation->caption ?></caption>
    <?php endif ?>
    <thead>
    <tr>
        <?php foreach ($this->table->presentation->columns as $column => $header): ?>
            <th><?= $header ?></th>
        <?php endforeach ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->data as $key => $row): ?>
        <tr>
            <?php foreach ($this->table->presentation->columns as $column => $header): ?>
                <td><?= $row[$column] ?></td>
            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
