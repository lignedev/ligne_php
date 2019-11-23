<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?= Assets::setAssets('favicon.ico') ?>" type="image/x-icon" />
    <title><?= $pageTitle ?></title>
</head>
<body>
<?=
/**
 * Por defecto aquí se renderizan las vistas, se puede
 * personalizar hasta el punto de no remover la variable $viewContent si
 * esta no existe cuando renderize una vista el contenido de esta no se
 * visualizara en la pagina.
 **/
$viewContent;
?>
</body>
</html>