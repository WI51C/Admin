<table>
    <thead>
    <tr>
        <?php foreach ($this->headers as $header): ?>
            <th><?= $header ?></th>
        <?php endforeach ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->data as $row): ?>
        <tr>
            <?php foreach ($row as $value): ?>
                <td><?= $value ?></td>
            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
