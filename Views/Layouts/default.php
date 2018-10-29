<!doctype html>
<head>
    <meta charset="utf-8">
    <title><?= $page_title ?></title>
    <link href="<?= Assets::setAssets('css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        body {
            padding-top: 5rem;
        }
        .starter-template {
            padding: 3rem 1.5rem;
            text-align: center;
        }
        .margin-med{
            margin: 6px 0;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Ligne PHP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= Assets::href("tasks/index")?>">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<main role="main" class="container">

    <div class="starter-template">

        <?=
        /**
         * Aqui se renderizan todas las vistas
        **/
        $content_for_layout;
        ?>

    </div>
</main>
<script src="<?= Assets::setAssets('js/bootstrap.min.js') ?>"></script>
</body>
</html>
