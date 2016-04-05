<?php
require "../vendor/autoload.php";

$method = $_GET['method'] ?? 'add';

if ($method == 'edit') {
    $data = new Crud\Product();

    $id = $_GET['id'] ?? 1;

    $data->getData($id);

    if (isset($data['error'])) {
        $errorMsg = "<h3>Item not found</h3>";
    } else {
        $edit['title'] = $data['productName'];
    }
}

//Switch case for add, edit and remove.
$action = $_GET['action'] ?? FALSE;
switch ($action) {
    case 'edit':
        $errors = [];
        $data;

        $db = new Crud\Product();
        $v = new Crud\Validate($errors);

        (isset($_POST['name'])) ? $data['productName'] = $_POST['name'] : $errors[] = 'Name was not filled out';

        break;
    case 'add':


        break;
    case 'remove':


        break;

}

include "includes\\top.phtml"; ?>
    <div class="">
        <div class="row">
            <div class="col s10 offset-s2">
                <form action="" method="post">
                    <?php echo $errorMsg ?? FALSE; ?>
                    <div class="row">
                        <div class="col s10 m7 l6">
                            <label for="title">Title</label>
                            <input id="title" type="text" name="title" class="validate"
                                   value="<?= $edit['title'] ?? FALSE ?>">
                        </div>
                        <div class="col l2 m3 s2">
                            <label for="number">Side nummer</label>
                            <input id="number" type="number" name="number" class="validate" min="0"
                                   value="<?= $edit['number'] ?? FALSE ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l8 m10 s12">
                            <textarea name="content" id="content"
                                      style="min-height: 500px;"><?= $edit['content'] ?? FALSE ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l8 m10 s12">
                            <input type="submit" name="submit" value="Tilføj" class="btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--TinyMCE-->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 500,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ],
            content_css: [
                '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>
<?php include "includes\\bot.phtml"; ?>