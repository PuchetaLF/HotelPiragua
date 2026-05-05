<?php 

 

session_start(); 

if (isset($_SESSION['usuario'])) { 

 

    $PageTitle = "Administrador"; 

 

    include '../resources/templates/head.html'; 

    include '../resources/templates/header.html'; 

    include '../resources/templates/administrador_navegacion.html'; 

    ?> 

    <main> 

    <div class="container"> 

        <div class="text-center my-5"> 
            <img src="../public/assets/img/admin.jpg"> 
        </div> 

        <div class="px-4 text-secondary"> 
            <h5 class="display-6 mb-5">Políticas del Hotel Piragua</h5> 

            <ul class="fs-5"> 
                <li> 
                    Garantizar una atención de calidad a todos los huéspedes, asegurando una experiencia cómoda, segura y satisfactoria durante su estancia. 
                </li> 
                <li> 
                    Ofrecer servicios de hospedaje que cumplan con los estándares de limpieza, comodidad y funcionalidad establecidos por el hotel. 
                </li> 
                <li> 
                    Mantener un ambiente agradable, respetuoso y profesional tanto para los clientes como para el personal del hotel. 
                </li> 
                <li> 
                    Cumplir con los procesos de capacitación continua del personal para asegurar un servicio eficiente y actualizado. 
                </li> 
                <li> 
                    Rechazar cualquier acto de corrupción o conducta inapropiada dentro de la administración y operación del hotel. 
                </li> 
                <li> 
                    Promover el respeto mutuo entre huéspedes y empleados, fomentando una convivencia armoniosa dentro de las instalaciones. 
                </li> 
                <li> 
                    Proteger la seguridad y privacidad de los huéspedes, así como el correcto uso de las instalaciones del hotel. 
                </li> 
                <li> 
                    Establecer y hacer cumplir políticas de reservación, cancelación y uso de servicios para garantizar una operación ordenada. 
                </li> 
            </ul> 
        </div> 

    </div> 

</main>

 

    <?php 

    include '../resources/templates/footer.html'; 

    include '../resources/templates/scripts.html'; 

    include '../resources/templates/fin.html'; 

 

} else { 

    header("Location:login_error.php"); 

    exit(); 

} 

 