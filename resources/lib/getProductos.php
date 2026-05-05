<?php

function getservicios($id, $palabra, $logeado) {

    if ($id == 0) {
        $servicios = ServicioDB::getServicios();

    } else {
        $servicios = ServicioDB::getServiciosPorCategoriaId($id);
    }

    foreach ($servicios as $servicio) {
        if (!$palabra=="") {
            $arr = explode(" ", $servicio['nombre']);
            if (in_array($palabra, $arr)){
                ?>
                <div class="card m-2" style="width: 15rem;">
                    <img src="../resources/uploads/<?= $servicio['imagen'] ?>" class="card-img-top mt-3" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $servicio['fk_habitacion'] ?></h5>
                        <p class="card-text "><?= substr($servicio['detalles'], 0, 150) . '...' ?></p>
                        <p class="card-text ">$<?= $servicio['precio'] ?></p>
                        <a href="<?php $logeado?print('vista_previa.php?id='.$servicio['id']):print('login.php')?>" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            <?php }
        } else {
            ?>
            <div class="card m-2" style="width: 15rem;">
                <img src="../resources/uploads/<?= $servicio['imagen'] ?>" class="card-img-top mt-3" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $servicio['fk_habitacion'] ?></h5>
                    <p class="card-text "><?= substr($servicio['detalles'], 0, 150) . '...' ?></p>
                    <p class="card-text ">$<?= $servicio['precio'] ?></p>
                    <a href="<?php $logeado?print('vista_previa.php?id='.$servicio['id']):print('login.php')?>" class="btn btn-primary">Comprar</a>
                </div>
            </div>
            <?php
        }
    }
}
