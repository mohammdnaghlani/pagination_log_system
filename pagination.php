<?php
require_once('init.php');
$view_log = pagination(get_view_log(), 1, $total_page);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?= link_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= link_url('assets/css/bootstrap-rtl.min.css') ?>" rel="stylesheet">
    <link href="<?= link_url('assets/css/fontiran.css') ?>" rel="stylesheet">
    <link href="<?= link_url('assets/css/styles.css') ?>" rel="stylesheet">
    <title>Mini CMS</title>
</head>

<body>
    <div class="container mt-2 ">
        <div class="col-12">
            <ul class="breadcrumb ">
                <li class="breadcrumb-item"><a href="<?= link_url('panel'); ?>">پنل مدیریتی</a></li>
                <li class="breadcrumb-item"><a href="<?= link_url('posts.php'); ?>"> مطالب</a></li>
                <li class="breadcrumb-item"><a href="<?= link_url('temp.php'); ?>"> تست </a></li>
            </ul>
        </div>
        <div class="row justify-content-center">
            <div class="col-10 mt-2 mb-2 bg-light shadow-sm rounded border post-container p-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ip</th>
                            <th>localtion</th>
                            <th>referer</th>
                            <th>date and time</th>
                            <th>browser</th>
                        </tr>
                    </thead>
                    <tbody id="output">
                        <?php foreach ($view_log as $key => $val) : ?>
                            <tr>
                                <th><?= $val['ip']; ?></th>
                                <th><?= $val['location']; ?></th>
                                <th><?= $val['referer']; ?></th>
                                <th><?= $val['date_time']; ?></th>
                                <th><?= $val['browser']; ?></th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="javascript:"><?= $i ?></a></li>
                    <?php endfor; ?>
                </ul>
            </div>

        </div>
    </div>
    <script src="<?= link_url('assets/js/jquery.js'); ?>"></script>
    <script src="<?= link_url('assets/js/bootstrap.min.js'); ?>"></script>

    <script>
        $(document).ready(function() {
            $('.page-item a').on('click', function() {
                var page_number = $(this).html();
                $.ajax({
                    url: '<?= BASE_URL; ?>ajax.php',
                    method: 'POST',
                    data: {
                        'page_num': page_number
                    },
                    success: function(res) {
                        $('#output').html(res);
                    }
                });
            });
        });
    </script>
</body>

</html>