<table>
    <?php if ($this->presenter->caption !== null): ?>
        <caption><?= $this->presenter->caption ?></caption>
    <?php endif ?>
    <thead>
    <tr>
        <?php foreach ($this->presenter->columns as $column => $header): ?>
            <th><?= $header ?></th>
        <?php endforeach ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->data as $key => $row): ?>
        <tr>
            <?php foreach ($this->presenter->columns as $column => $header): ?>
                <td><?= $row[$column] ?></td>
            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
