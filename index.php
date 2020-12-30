<?php include_once 'includes/templates/header.php';?>

<!-----------------------------Primera Sección----------------------------------------->

    <section class="seccion contenedor">
        <h2>La mejor conferencia de Criptomonedas en español</h2>
        <p>El trading de criptomonedas, también conocidas como criptodivisas, supone invertir en torno a los movimientos de sus precios mediante una cuenta de trading de CFD, o comprar y vender las criptodivisas subyacentes en un mercado de negociación.
        </p>
    </section><!---Sección--->

<!-----------------------------Segunda Sección----------------------------------------->

    <section class="programa">
        <div class="contenedor-video">
            <video autoplay loop poster="img/bg-talleres.jpg">
                <source src="video/video.mp4" type="video/mp4">
                <source src="video/video.webm" type="video/webm">
                <source src="video/video.ogv" type="video/ogg">
            </video>
        </div><!---Contenedor Video--->
        <div class="contenido-programa">
            <div class="contenedor">
                <div class="programa-evento ">
                    <h2>Programa del evento</h2>

                    <?php
                        try {
                            require_once('includes/funciones/bd_conexion.php');
                            $sql   = "SELECT * FROM `categoria_evento` ";
                            $resultado = $conn->query($sql);
                            }catch(\Exception $e){
                                $error = $e->getMessage();
                            }
                        ?>

                    <nav class="menu-programa">
                        <?php while($cat = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                            <?php $categoria = $cat['cat_evento']; ?>
                            <a href="#<?php echo strtolower($categoria) ?>">
                                <i class="fa <?php echo $cat['icono'] ?>" aria-hidden="true"></i><?php echo $categoria; ?>
                            </a>
                        <?php } ?>
                    </nav>

                    <?php
                        try {                                                       //Realizamos la conección
                            require_once('includes/funciones/bd_conexion.php');
                            $sql   = "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`, `nombre_invitado`, `apellido_invitado` ";
                            $sql  .= "  FROM `eventos` ";
                            $sql  .= "  INNER JOIN `categoria_evento` ";
                            $sql  .= "  ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                            $sql  .= "  INNER JOIN `invitados` ";
                            $sql  .= "  ON eventos.id_inv = invitados.invitado_id ";
                            $sql  .= "  AND eventos.id_cat_evento = 1 ";
                            $sql  .= "  ORDER BY `evento_id` LIMIT 2; ";
                            $sql  .= "  SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`, `nombre_invitado`, `apellido_invitado` ";
                            $sql  .= "  FROM `eventos` ";
                            $sql  .= "  INNER JOIN `categoria_evento` ";
                            $sql  .= "  ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                            $sql  .= "  INNER JOIN `invitados` ";
                            $sql  .= "  ON eventos.id_inv = invitados.invitado_id ";
                            $sql  .= "  AND eventos.id_cat_evento = 2 ";
                            $sql  .= "  ORDER BY `evento_id` LIMIT 2; ";
                            $sql  .= "  SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`, `nombre_invitado`, `apellido_invitado` ";
                            $sql  .= "  FROM `eventos` ";
                            $sql  .= "  INNER JOIN `categoria_evento` ";
                            $sql  .= "  ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                            $sql  .= "  INNER JOIN `invitados` ";
                            $sql  .= "  ON eventos.id_inv = invitados.invitado_id ";
                            $sql  .= "  AND eventos.id_cat_evento = 3 ";
                            $sql  .= "  ORDER BY `evento_id` LIMIT 2; ";
                            }catch(\Exception $e){
                                $error = $e->getMessage();
                            }
                        ?>

                    <?php $conn->multi_query($sql); ?>

                    <?php
                        do{
                            $resultado=$conn->store_result();
                            $row = $resultado->fetch_all(MYSQLI_ASSOC); ?>

                                <?php $i = 0; ?>
                                    <?php foreach($row as $evento): ?>
                                        <?php if ($i % 2 == 0) { ?>
                                        <div id="<?php echo strtolower($evento['cat_evento']); ?>" class="info-curso ocultar clearfix">
                                        <?php } ?>
                                            <div class="detalle-evento">
                                                <h3><?php echo htmlentities(($evento['nombre_evento'])); //<?php echo utf8-encode(($evento['nombre_evento'])); ?> ?></h3>
                                                <p><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $evento['hora_evento']; ?></p>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $evento['fecha_evento'] ;?></p>
                                                <p><i class="fa fa-user" aria-hidden="true"></i><?php echo $evento['nombre_invitado'] ;?></p>
                                            </div>


                                        <?php if ($i % 2 == 1) { ?>
                                            <a href="calendario.php" class="button float-right">Ver Todos</a>
                                            </div><!---talleres--->
                                        <?php } ;?>

                                        <?php $i++; ?>
                                <?php  endforeach;  ?>
                            <?php  $resultado->free();  ?>

                    <?php
                        }while($conn->more_results() && $conn->next_result());
                    ?>
                </div><!---Programa Evento--->
            </div><!---Contenedor--->
        </div><!---Contenido del programa--->
    </section><!---programa--->
<!-------------------------------Tercera Sección--------------------------------------->

    <?php include_once 'includes/templates/invitados.php'; ?>


<!-------------------------------Cuarta Sección---------------------------------------->

    <div class="contador parallax">
        <div class="contenedor">
            <ul class="resumen-evento clearfix">
                <li><p class="numero"></p>Invitados</li>
                <li><p class="numero"></p>Talleres</li>
                <li><p class="numero"></p>Días</li>
                <li><p class="numero"></p>Conferencia</li>
            </ul>
        </div>
    </div>

<!-------------------------------Quinta Sección---------------------------------------->

    <section class="precios seccion">
        <h2>Precios</h2>
        <div class="contenedor">
            <ul class="lista-precios clearfix">
                <li>
                    <div class="tabla-precio">
                        <h3>Pase por día</h3>
                        <p class="numero">$30</p>
                        <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas Las conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <a href="#" class="button hollow">Comprar</a>
                    </div>
                </li>

                <li>
                    <div class="tabla-precio">
                        <h3>Todos los días</h3>
                        <p class="numero">$50</p>
                        <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas Las conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <a href="#" class="button hollow">Comprar</a>
                    </div>
                </li>

                <li>
                    <div class="tabla-precio">
                        <h3>Pase por 2 dias</h3>
                        <p class="numero">$45</p>
                        <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas Las conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <a href="#" class="button hollow">Comprar</a>
                    </div>
                </li>
            </ul>
        </div>
    </section>

<!--------------------------------sexta Sección---------------------------------------->

    <div id="mapa" class="mapa">

    </div>

<!--------------------------------Septima Sección-------------------------------------->

    <section class="seccion">
        <h2>Testimoniales</h2>
        <div class="testimoniales contenedor clearfix" >
            <div class="testimonial">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas efficitur, leo in ultricies congue, mauris elit ultricies elit, vel ultricies nibh turpis quis eros.</p>
                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg" alt="Imagen testimonial">
                        <cite>Oswaldo Aponte Escovedo <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div><!--Testimonia-->

            <div class="testimonial">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas efficitur, leo in ultricies congue, mauris elit ultricies elit, vel ultricies nibh turpis quis eros.</p>
                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg" alt="Imagen testimonial">
                        <cite>Oswaldo Aponte Escovedo <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div><!--Testimonia-->

            <div class="testimonial">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas efficitur, leo in ultricies congue, mauris elit ultricies elit, vel ultricies nibh turpis quis eros.</p>
                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg" alt="Imagen testimonial">
                        <cite>Oswaldo Aponte Escovedo <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div><!--Testimonia-->
        </div>
    </section>
<!--------------------------------Octava Sección-------------------------------------->

    <div class="newsletter parallax">
        <div class="contenido contenedor">
            <p>regístrate al newsletter</p>
            <h3>gdlwebcan</h3>
            <a href="#" class="button transparente">Registro</a>
        </div><!--Contenido-->
    </div><!--Newsletter-->

<!--------------------------------Novena Sección-------------------------------------->

    <section class="seccion">
        <h2>Faltan</h2>
        <div class="cuenta-regresiva contenedor">
            <ul class="clearfix">
                <li><p id="dias" class="numero"></p>días</li>
                <li><p id="horas" class="numero"></p>Horas</li>
                <li><p id="minutos" class="numero"></p>Minutos</li>
                <li><p id="segundos" class="numero"></p>Segundos</li>
            </ul>
        </div>
    </section>

<?php include_once 'includes/templates/footer.php'; ?>