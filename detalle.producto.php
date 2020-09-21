<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/EntornosGraficos_TP-Final/rutas.php');
include_once(DAO_PATH."db.php");

include(DAO_PATH."dao.usuario.php");
include(DAO_PATH."dao.zapatilla.php");

// Iniciar/Retomar sesion
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<!-- Cabeceras -->
<?php include(INCLUDES_PATH."header.php") ?>

<body>
    <!-- NavBar -->
    <?php include(INCLUDES_PATH."navbar.php") ?>

    <!-- Validar entrada de datos -->
    <?php 
        // Validar que se haya enviado ID
        if(isset($_GET['id'])) {
            // Guardar
            $id = $_GET['id'];
            // Service
            $zapatillaService = new ZapatillaDataService();
            // Buscar producto en la DB
            $existe = $zapatillaService->validarExistenciaDeZapatilla($id);
            // Si encontro el registro
            if ($existe) {
                $data = $zapatillaService->getZapatilla($id); 
                // Si hay datos devueltos
                if($data != null) {
                    // print_r($data);  
    ?>

    <!-- Migas de pan -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">
                <a href="index.php">
                    Inicio
                </a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a href="tienda.php">
                    Tienda
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Detalle Producto '<?= $data['nombre'] ?>'
            </li>
        </ol>
    </nav>

    <!-- Content -->
    <div class="container-fluid">

        <!-- Media del producto -->
        <div class="media">
            <!-- Imagen -->
            <img 
                src="<?= $data['img_path'] ?>" 
                class="img-fluid w-50 mr-3" 
                alt="Imagen Zapatilla Modelo <?= $data['nombre'] ?>"
            >
            <!-- Detalles -->
            <div class="media-body">
                <h1 class="mt-0">
                    <?= $data['nombre'] ?>
                </h1>
                <p>
                    <?php if(isset($data['precio'])) echo '<b>$ ' . $data['precio'] .'</b>'; else { ?>    
                    <b>$ 00.00</b>
                    <?php } ?>
                </p>
                <p>
                    <?php if(isset($data['descripcion'])) $data['descripcion']; ?>
                </p>
                <hr />
                <!-- Form -->
                <form action="#" method="">
                    <div class="form-group">
                        <label for="colorSelect">Color</label>
                        <select class="form-control form-control-sm" id="colorSelect" required>
                            <option value="">Seleccione color..</option>
                            <option value="">Blanco</option>
                            <option value="">Negro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="talleSelect">Talle</label>
                        <select class="form-control form-control-sm" id="talleSelect" required>
                            <option value="0" <?php if($data['talle'] == 0) echo 'selected'?>>Seleccione talle..</option>
                            <option value="36" <?php if($data['talle'] == 36) echo 'selected'?>>36</option>
                            <option value="37" <?php if($data['talle'] == 37) echo 'selected'?>>37</option>
                            <option value="38" <?php if($data['talle'] == 38) echo 'selected'?>>38</option>
                            <option value="39" <?php if($data['talle'] == 39) echo 'selected'?>>39</option>
                            <option value="40" <?php if($data['talle'] == 40) echo 'selected'?>>40</option>
                            <option value="41" <?php if($data['talle'] == 41) echo 'selected'?>>41</option>
                            <option value="42" <?php if($data['talle'] == 42) echo 'selected'?>>42</option>
                            <option value="43" <?php if($data['talle'] == 43) echo 'selected'?>>43</option>
                            <option value="44" <?php if($data['talle'] == 44) echo 'selected'?>>44</option>
                            <option value="45" <?php if($data['talle'] == 45) echo 'selected'?>>45</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="col col-sm-3">
                            <input type="text" name="" id="inputCantidad" class="form-control form-control" value="1">
                        </div>
                        <dov class="col col-sm-9">
                            <button role="button" name="btnAddCarro" class="btn btn-info btn-block" value="Comprar">
                                <i class="fas fa-cart-arrow-down"></i>
                            </button>
                        </dov>
                    </div>
                </form>
            </div>
        </div>

        <hr />

        <h3>Mas Detalles</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo, exercitationem nam corrupti ad vitae nulla dignissimos atque sit aut, quisquam officiis sint velit aperiam magnam consequatur, optio saepe esse vel?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo, exercitationem nam corrupti ad vitae nulla dignissimos atque sit aut, quisquam officiis sint velit aperiam magnam consequatur, optio saepe esse vel?</p>

        <?php } } else { ?>
            <div class="alert alert-warning" role="alert">
                Lo sentimos, ha ocurrido un error al recuperar datos de la DB. Intente mas tarde.
            </div>            
        <?php } ?>

        <!-- Footer -->
        <?php include(INCLUDES_PATH."footer.html") ?>
    </div>

    <!-- Sin ID no hay contenido -->
    <?php } else { ?>

        <div class="alert alert-warning" role="alert">
            Lo sentimos, ha ocurrido un error. Intente mas tarde.
        </div>

    <?php } ?>

    <!-- Scripts -->
    <?php include(INCLUDES_PATH."scripts.php") ?>

</body>

</html>