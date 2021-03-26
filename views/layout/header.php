<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Tienda de camisetas</title>
        <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css" />
        <link rel="stylesheet" href="../vendor/stefangabos/zebra_pagination/public/css/zebra_pagination.css" type="text/css">
    </head>
    <body>
        <div id="container">

            <!-- CABECERA -->
            <header id="header">
                <div id="logo">
                    <img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta Logo" />
                    <a href="<?= base_url ?>">
                        Tienda de camisetas
                    </a>
                </div>
            </header>
            <!-- MENÚ -->
            <?php $categorias = Utils::showCategorias(); ?>
            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?= base_url ?>">Inicio</a>
                    </li>
                    <?php while ($cat = $categorias->fetch_object()): ?>
                        <li>
                            <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                        </li> 
                    <?php endwhile; ?>
                </ul>                
            </nav>
            <div id="content"> 

