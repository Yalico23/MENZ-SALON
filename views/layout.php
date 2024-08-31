<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>barber</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="icon" href="build/img/logo.webp">
</head>

<body>
    <header class="navegador">
        <div class="container">
            <a href="/">
                <picture>
                    <source srcset="build/img/logo.webp" type="image/webp">
                    <img src="build/img/logo.png" alt="logo">
                </picture>
            </a>
            <div class="mobile">
                <picture>
                    <source srcset="/build/img/menus.webp" type="image/webp">
                <img  src="/build/img/menus.png" alt="">
                </picture>
            </div>
            <nav id="nav">
                <a href="/">Inicio</a>
                <a href="/services">Servicios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
                <?php if($_SESSION != []): ?>
                <a href="/logout">Salir</a>
                <?php endif; ?>
                <a href="/login">reserva Ahora</a>
            </nav>
        </div>
    </header>

    <?php echo $contenido; ?>
    <footer>
        <div class="f-1">
            <picture>
                <source srcset="/build/img/footer-logo.webp" type="image/webp">
                <img src="/build/img/footer-logo.png" alt="footer logo">
            </picture>
            <div class="f-1-footer">
                <div class="contact-info">
                    <a href="tel:+51941077834"><p>Phone: +51 941077834</p></a>
                    <a href="mailto: jeanpiero_23_01@hotmail.com"><p>E-mail: jeanpiero_23_01@hotmail.com</p></a>
                </div>
                <picture>
                    <source srcset="/build/img/foot.webp" type="image/webp">
                    <img src="/build/img/foot.png" alt="foot">
                </picture>
                <div class="address-info">
                    <p>SJL Caja de Agua</p>
                    <p>Lima, Perú</p>
                </div>
            </div>
            <div class="social">
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="#BD9254" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                    </svg>
                </a>
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-x" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="#BD9254" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                        <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                    </svg>
                </a>
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-pinterest" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="#BD9254" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 20l4 -9" />
                        <path d="M10.7 14c.437 1.263 1.43 2 2.55 2c2.071 0 3.75 -1.554 3.75 -4a5 5 0 1 0 -9.7 1.7" />
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    </svg>
                </a>
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="#BD9254" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M16.5 7.5l0 .01" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="f-2">
            <p>Copyright &copy; by : Oscar Yalico Espinoza</p>
        </div>
    </footer>
    
    <script src='/build/js/app.js'></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <?php
    echo $script ?? '';
    ?>
</body>

</html>