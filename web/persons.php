<?php

require "../vendor/autoload.php";

$db = new MysqliDb('127.0.0.1', 'root', 'password', 'compo');
$pages = $db->get('user');

include "includes/top.phtml";
?>


<div class="">
    <div class="row">
        <div class="col s10 offset-s2">
            <table class="striped">
                <thead>
                <tr>
                    <th data-field="id">Side</th>
                    <th data-field="name">Title</th>

                    <th data-field="edit">Ret</th>
                    <th data-field="del">Slet</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($pages as $page) { ?>
                    <tr>
                        <td><?= $page['number'] ?></td>
                        <td><?= $page['title'] ?></td>

                        <td><a href="person.php?method=edit&id=<?= $page['id'] ?>"><i class="material-icons edit">create</i></a></td>
                        <td><a class="waves-effect waves-light modal-trigger" href="#modal<?= $page['id'] ?>"><i
                                    class="material-icons delete">not_interested</i></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Tilføjelses knap-->
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large addbtn" href="add.php">
        <i class="large material-icons">add</i>
    </a>
</div>

<!--MODALS HERE-->
<?php foreach ($pages as $item) { ?>
    <div id="modal<?= $item['id'] ?>" class="modal">
        <div class="modal-content">
            <h4>Delete <?= $item['title'] ?></h4>
            <p>Er du sikker på du vil slette denne side?</p>
        </div>
        <div class="modal-footer">
            <a href="slet.php?id=<?= $item['id'] ?>"
               class=" modal-action modal-close waves-effect waves-green btn-flat">Ja</a>
            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Nej</a>
        </div>
    </div>
<?php }

include "includes\\bot.phtml";
?>


