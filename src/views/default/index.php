
<div class="container">
    <div class="header">

    </div>
    <div>
        <img src="<?= Assets::setAssets('img/launch.png') ?>" alt="launch icon">
    </div>
    <h1 class="title"><?= $framework_name ?></h1>
    <div>
        <h4>Version: <?= $version ?></h4>
    </div>
    <div>
        <h4>Environment: <?= $environment ?></h4>
    </div>
    <div>
        <h4>Date: <?= $date ?></h4>
    </div>
    <div class="dependencies">
        <h4>Required dependencies:</h4>
        <ul>
            <?php foreach($externalComponentsIncluded as $value): ?>
                <li><?= $value ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div>
        <em><strong>Autor:</strong> <?= $autor ?></em>
        <a href="https://github.com/itsalb3rt">https://github.com/itsalb3rt</a>
    </div>
</div>
<style>
    :root {
        /*Root colors*/
        --white:#fff;
        --black:#000;
        --grey:grey;
        --semi-light-grey:#ddd;
        --light-grey:#f5f5f5;
        --tomato:tomato;
        /*Elements colors*/
        --primary-blue: #03A9F4;
        --primary-blue-hover:#0396dc;

        --secondary-grey:#607D8B;
        --secondary-grey-hover:#536c7a;

        --success-green:#4CAF50;
        --success-green-hover:#4b9a4d;

        --danger-red:#d32f2f;
        --danger-red-hover:#b71c1c;

        --warning-yellow:#FFB300;
        --warning-yellow-hover:#e0a800;

        --info-cyan:#17a2b8;
        --info-cyan-hover: #1791a8;

    }
    html {
        line-height: 1.15;
        -webkit-text-size-adjust: 100%;
    }

    body {
        margin: 0;
        background-color: var(--light-grey);
    }

    h1 {
        font-size: 2em;
        margin: 0.67em 0;
    }

    hr {
        box-sizing: content-box;
        height: 0;
        overflow: visible;
    }

    pre {
        font-family: monospace, monospace;
        font-size: 1em;
    }

    a {
        background-color: transparent;
    }

    abbr[title] {
        border-bottom: none;
        text-decoration: underline;
        text-decoration: underline dotted;
    }

    b, strong {
        font-weight: bolder;
    }

    code, kbd, samp {
        font-family: monospace, monospace;
        font-size: 1em;
    }
    .container{
        margin: 40px;
        text-align: center;
        font-family: sans-serif;
        box-shadow: 0px 0px 10px 6px rgba(128, 128, 128, 0.24);
        padding: 20px;
        border-radius: 4px;
        background-color: white;
    }
    li{
        list-style-position: inside;
    }
    .dependencies{
        width: 240px;
        margin: auto;
        text-align: left;
    }
    .dependencies ul > li{
        margin: 10px auto;
    }
    .container h1.title{
        font-size: 40px;
        color: var(--primary-blue)
    }
    .container .header{
        height: 60px;
        background-color: var(--primary-blue-hover);
        margin: -20px -20px -40px -20px;
        box-shadow: 0px 5px 10px 0px rgba(128, 128, 128, 0.24);
        border-radius: 4px 4px 0px 0px;
    }
    a{
        text-decoration: none;
    }
    a:active,a:visited{
        color: var(--primary-blue);
        font-weight: bold;
    }
</style>