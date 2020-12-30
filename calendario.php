<?php include_once 'includes/templates/header.php';?>

<style>/*------------------calendario------------------Solución por no ejecución en el main*/

div.calendario h3{
    background-color: #fe4918;
    clear: both;
    color: white;
    text-align: center;
    padding: 10px 0;
    font-family: 'Oswald', sans-serif;
}
div.calendario::after{
    clear: both;
    display: block;
    content: '';
}
div.dia {
    width: 50%;
    float: left;
    border: 2px solid #e1e1e1;
    text-align: center;
    transition: all .3s ease;
}
@media only screen and (min-width:768px){
    div.dia {
        width: 33.3%;
        min-height: 240px;
        padding-top: 20px;
        text-align: center;
    }
}
div.dia:hover{
    background-color: #e1e1e1;
    -webkit-transform: scale(1.1);
}
div.dia p.titulo{
    font-family: 'Oswald', sans-serif;
    color: #fe4918!important;
    text-transform: uppercase;
    font-weight: bold;
}
div.dia p {
    font-family: 'Oswald', sans-serif;
    font-size: 1em;
    text-align: center;
}
div.dia i {
    color: #fe4918;
    font-size: 1.6em;
}


</style>
<!----------------------------------3.1----------------------------------------->
<section class="seccion contenedor">
    <h2>Calendario de Eventos</h2>

    <?php
        try {                                                       //Realizamos la conección
            require_once('includes/funciones/bd_conexion.php');
            $sql   = "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`, `nombre_invitado`, `apellido_invitado` ";
            $sql  .= "  FROM eventos ";
            $sql  .= "  INNER JOIN categoria_evento ";
            $sql  .= "  ON eventos.id_cat_evento = categoria_evento.id_categoria ";
            $sql  .= "  INNER JOIN invitados ";
            $sql  .= "  ON eventos.id_inv = invitados.invitado_id ";
            $sql  .= "  ORDER BY `evento_id` ";
            $resultado = $conn->query($sql);
        }catch(\Exception $e){
            $error = $e->getMessage();
        }
    ?>

        <div class="calendario">
            <?php
                $calendario = array();
                //echo $sql;                                       //Imprimir los resultados
                
                while ($eventos = $resultado->fetch_assoc()){

                    //Obtiene la fecha del evento
                    $fecha = $eventos['fecha_evento'];

                    $evento = array (
                        'titulo' => $eventos['nombre_evento'],
                        'fecha' => $eventos['fecha_evento'],
                        'hora' => $eventos['hora_evento'],
                        'categoria' => $eventos['cat_evento'],
                        'icono'=> 'fa'. " " . $eventos['icono'],
                        'invitado' => $eventos['nombre_invitado'] . " " . $eventos['apellido_invitado']
                    );
                   
                    $calendario[$fecha][]= $evento;
            ?>
                <?php }    //while de fetch_assoc() ?>

            <?php
                          //Imprime todos los eventos
                foreach($calendario as  $dia => $lista_eventos) {?>
                    <h3>
                        <i class="fa fa-calendar " ></i>
                        <?php
                            //Unix
                            setlocale(LC_TIME, 'es_ES.UTF-8');
                            //windows
                            setlocale(LC_TIME, 'english');

                            echo strftime ("%A, %B  %d %Y", strtotime($dia));
                        ?>
                    </h3>

                    <?php
                        foreach($lista_eventos as $evento) { ?>
                            <div class="dia">
                                <p class="titulo"><?php echo $evento['titulo'];?></p>
                                <p class="hora">
                                    <i class="far fa-clock" aria-hidden="true"></i>
                                    <?php echo $evento['fecha'] . " " . $evento['hora'];?>
                                </p>
                                <p>
                                    <i class="<?php echo $evento['icono'    ]; ?>" aria-hidden="true"></i>
                                    <?php echo $evento['categoria'];?>
                                </p>
                                <p>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <?php echo $evento['invitado'];?></p>
                                </p>

                            </div>
                        <?php } //fin foreach de evento ?>
                <?php } //fin foreach de dias?>
                </div>
    <?php
        $conn->close();                                           //Cerramos conección con BD
    ?>
</section><!---Sección--->



<?php include_once 'includes/templates/footer.php'; ?>

