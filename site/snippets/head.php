<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>thesis.digitale-grafik.com</title>
    <meta name="description" content="<?php if ($site->ogDescription()->isNotEmpty()):?> <?= $site->ogDescription()?> <?php endif ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= $site->title()?>" />
    <meta property="og:type" content="Website" />
    <meta property="og:url" content="https://thesis.digitale-grafik.com" />
    <meta property="og:description" content="<?php if ($site->ogDescription()->isNotEmpty()):?> <?= $site->ogDescription()?> <?php endif ?>">
    <meta property="og:image" content="<?php if ($site->ogImage()->isNotEmpty()): ?> <?= $site->ogImage()->toFile()->url()?> <?php endif ?>" />


    <!-- 

    ––––––––––––
    ✦ About this CSS ✦
    ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾

    ✶ This site has multiple CSS files. They will be loaded when activated. 
      You can find the main CSS over at css/style.css

    ✶ All current themes are located in modules/devmode/...

    ✶ Additionaly your custom CSS will be found here as well. 
      It will be the following element: <style id="devModeCSS"></style>
      For more information about the custom CSS to Chapter ③ DevMode. 
      
    -->


    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="../css/style.css">

    <!-- All relevant scripts are loaded at </body> -->

</head>
<body>

 