<html>
<head>
    <title>500 Error</title>
    <style>
        * {
            font-family: sans-serif;
        }
        body {
            background: #EEEEEE;
            font-family: 'Lato', serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .page-wrap {
            margin: 0 auto;
            width: 100%;
            text-align: center;
        }

        p, a {
            font-size: 1em;
        }

        h2, a {
            text-transform: uppercase;
        }

        a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            width: 88px;
            height: 44px;
            line-height: 44px;
            border-radius: 5px;
            border: 2px solid #fff;
            transition: all .5s ease;
        }

        a:hover {
            background: #64B5F6;
            border: 2px solid #64B5F6;
            width: 132px;
        }

        /* MEDIA QUERIES
        ================================================== */

        /* smartphones, portrait iPhone, portrait 480x320 phones (Android) */
        @media (min-width:320px) {
            h1 {font-size: 2em; }
            h2 {font-size: 1.5em; }
        }

        /* smartphones, Android phones, landscape iPhone */
        @media (min-width:480px) {
            h1 {font-size: 3em; }
            h2 {font-size: 1.75em; }
        }

        /* portrait tablets, portrait iPad, e-readers (Nook/Kindle), landscape 800x480 phones (Android) */
        @media (min-width:600px) {
            h1 {font-size: 4em; }
            h2 {font-size: 2em; }
        }

        /* tablet, landscape iPad, lo-res laptops ands desktops */
        @media (min-width:801px) {
            h1 {font-size: 5em; }
            h2 {font-size: 3em; }
        }


        /* big landscape tablets, laptops, and desktops */
        @media (min-width:1025px) {
            h1 {font-size: 6em; }
            h2 {font-size: 4em; }
        }


        /* hi-res laptops and desktops */
        @media (min-width:1281px) {
            h1 {font-size: 7em; }
            h2 {font-size: 5em; }
        }
        .special_name_element{
            font-weight: bold;
            font-size: 25px;
        }

        div.header{
            margin: auto auto 1px auto;
            background-color: #f44336;
            width: 80%;
            height: auto;
            color:white;
            text-align: left;
            font-size: 38px;
            padding: 70px 10px 20px 10px;
            border-radius: 4px 4px 0 0;
        }
        div.header .header_text{
            margin-top: -38px;
        }
        div.description{
            width: 80%;
            border: 4px solid rgba(31, 99, 172, 0.35);
            margin: auto;
            min-height: 500px;
            padding: 6px;
            text-align: left;
            background-color: white;
            border-radius: 0 0 10px 10px;
            box-shadow: 4px 4px 6px -2px rgba(128, 128, 128, 0.45);
        }
        div.description .text{
            color: #000;
            background-color: #03A9F4;
            width: 70%;
            margin-top: 20px;
            padding: 15px;
            border-radius: 4px;
            color: white;
        }


    </style>
</head>
<bory>
    <div class="page-wrap">
        <div class="header">
            <div class="header_text">
                <?= $header ?>
            </div>
        </div>
        <div class="description">
            <div class="text">
                <?= $description ?>
            </div>
            <?php if ($route != null): ?>
            <div class="text route">
                    <h3>Route:</h3>
                    <?= $route; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</bory>
</html>