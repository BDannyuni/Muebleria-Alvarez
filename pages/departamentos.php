<?php
//traemos la sesion del usuario
include "../controllers/user_session.php";
// Consulta SQL para obtener todos los registros de la tabla "productos"
$sql = "SELECT * FROM departamentos";
$stmt = $conn->query($sql);
$departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../plantilla/quixlab-master/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="../plantilla/quixlab-master/css/style.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="../plantilla/quixlab-master/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Agregar jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Agregar DataTables y el archivo de idioma en español -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"></script>

    <!-- Custom CSS for the "agregar" card -->
    <style>
        #agregar {
            background-color: #7571F9;
            /* Fondo de la tarjeta */
            border: 1px solid #ddd;
            /* Borde de la tarjeta */
            border-radius: 8px;
            /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra */
            padding: 15px;
            /* Espacio interno */
        }

        #agregar .card-title {
            font-size: 18px;
            /* Tamaño de la fuente del título */
            font-weight: bold;
            /* Grosor de la fuente del título */
            color: #333;
            /* Color del título */
            margin-bottom: 20px;
            /* Margen inferior */
        }

        #agregar label {
            display: block;
            /* Mostrar etiquetas como bloque */
            margin-bottom: 10px;
            /* Margen inferior */
            font-weight: bold;
            /* Grosor de la fuente de la etiqueta */
            color: #555;
            /* Color de la etiqueta */
        }

        #agregar input[type="number"],
        #agregar input[type="text"] {
            width: 100%;
            /* Ancho completo */
            padding: 10px;
            /* Espacio interno */
            margin-bottom: 15px;
            /* Margen inferior */
            border: 1px solid #ccc;
            /* Borde */
            border-radius: 4px;
            /* Bordes redondeados */
            box-sizing: border-box;
            /* Incluye padding y borde en el ancho total */
        }

        #agregar input[type="submit"] {
            background-color: #4CAF50;
            /* Color de fondo del botón */
            color: white;
            /* Color del texto del botón */
            padding: 10px 20px;
            /* Espacio interno */
            border: none;
            /* Sin borde */
            border-radius: 4px;
            /* Bordes redondeados */
            cursor: pointer;
            /* Cursor de puntero */
        }

        #agregar input[type="submit"]:hover {
            background-color: #45a049;
            /* Color de fondo del botón al pasar el ratón */
        }

        #agregar2 {
            padding: 30px;
            /* Espacio interno */
        }

        .edit-btn {
            margin-right: 5px;
            /* Ajusta el espacio entre los botones */
            background-color: #28a745;
            /* Verde */
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            /* Añade el cursor de puntero */
        }

        .delete-btn {
            background-color: #dc3545;
            /* Rojo */
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            /* Añade el cursor de puntero */
        }

        .edit-btn:hover,
        .delete-btn:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start and sidebar 
        ***********************************-->
       <?php include('layouts/all.php'); ?>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->

            <div class="container-fluid">
                <div class="row">

                    <!-- Card para Categorías Más Usadas -->
                    <div class="col-lg-6">
                        <div class="card" id="categoriasUsadas">
                            <div class="card-body">
                                <h4 class="card-title">Departamentos Más Usados</h4>
                                <canvas id="categoriasUsadasChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Card para Categorías Más Vendidas -->
                    <div class="col-lg-6">
                        <div class="card" id="categoriasVendidas">
                            <div class="card-body">
                                <h4 class="card-title">Departamentos Más Vendidos</h4>
                                <canvas id="categoriasVendidasChart"></canvas>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Departamentos</h4>
                                <div class="table-responsive">
                                    <table id="productos" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Departamento</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($departamentos as $departamento) : ?>
                                                <tr>
                                                    <td><?php echo $departamento['id_departamento']; ?></td>
                                                    <td><?php echo $departamento['departamento_nom']; ?></td>
                                                    <td>
                                                        <a href="editardepartamento.php?id=<?php echo $departamento['id_departamento']; ?>" class="edit-btn"><i class="fas fa-edit"></i></a>
                                                        <a href="editar_eliminar/eliminar_departamento.php?id=<?php echo $departamento['id_departamento']; ?>" class="delete-btn"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Departamento</th>
                                                <th>Estado</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-4">
                        <div class="card" id="agregar">
                            <div class="card-body">
                                <div class="card" id="agregar2">
                                    <div class="text-center"> <!-- Contenedor para centrar el botón -->
                                        <h4 class="card-tittle">Agregar un nuevo Departamento</h4>
                                    </div><br>
                                    <form id="agregardepartamento" action="editar_eliminar/agregardepartamento.php" method="post" enctype="multipart/form-data">
                                        <label for="nombre_departamento">Nombre del Departamento:</label>
                                        <input type="text" name="nombre_departamento" id="nombre_departamento" required><br>
                                        <label for="estado_departamento">Estado del Departamento:</label>
                                        <input type="text" name="estado_departamento" id="estado_departamento"><br><br>
                                        <div class="text-center"> <!-- Contenedor para centrar el botón -->
                                            <button type="submit" class="btn mb-1 btn-outline-primary  btn-lg">Agregar Departamento</button>
                                        </div>
                                        <br><br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->



        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a>
                    2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->

    <script src="../plantilla/quixlab-master/plugins/common/common.min.js"></script>
    <script src="../plantilla/quixlab-master/js/custom.min.js"></script>
    <script src="../plantilla/quixlab-master/js/settings.js"></script>
    <script src="../plantilla/quixlab-master/js/gleek.js"></script>
    <script src="../plantilla/quixlab-master/js/styleSwitcher.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"></script>
    <script src="../plantilla/quixlab-master/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    <!-- ChartistJS -->
    <script src="../plantilla/quixlab-master/plugins/chartist/js/chartist.min.js"></script>
    <script src="../plantilla/quixlab-master/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js">
    </script>

    <!-- Chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Una vez que el documento esté cargado, ejecuta esta función
        $(document).ready(function() {
            // Inicializa DataTables en la tabla con id "productos"
            $('#productos').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            });
        });
    </script>
    <script>
        // Una vez que el documento esté cargado, ejecuta esta función
        $(document).ready(function() {
            // Inicializa DataTables en la tabla con id "productos"
            $('#productos').DataTable();
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Gráfico de Categorías Más Usadas
            fetch('getCategoriasUsadasData.php')
                .then(response => response.json())
                .then(data => {
                    const categorias = data.map(item => item.categoria_nom);
                    const counts = data.map(item => item.count);

                    const ctx = document.getElementById('categoriasUsadasChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: categorias,
                            datasets: [{
                                label: 'Cantidad de Productos',
                                data: counts,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ], // Colores de fondo para cada segmento del gráfico de polarArea
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ], // Colores del borde para cada segmento del gráfico de polarArea
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching categories data:', error));

            // Gráfico de Categorías Más Vendidas
            fetch('getCategoriasVendidasData.php')
                .then(response => response.json())
                .then(data => {
                    const categorias = data.map(item => item.categoria_nom);
                    const totalVendido = data.map(item => item.total_vendido);

                    const ctx = document.getElementById('categoriasVendidasChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: categorias,
                            datasets: [{
                                label: 'Total Vendido',
                                data: totalVendido,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ], // Colores de fondo para cada segmento del gráfico de polarArea
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ], // Colores del borde para cada segmento del gráfico de polarArea
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching sales data:', error));
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Manejar el clic en los botones de editar
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    // Redirigir a una página de edición con el ID de la categoría
                    window.location.href = 'editar_eliminar/editarcategoria.php?id=' + id;
                });
            });

            // Manejar el clic en los botones de eliminar
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) {
                        // Realizar una solicitud AJAX para eliminar la categoría
                        fetch('editar_eliminar/eliminarcategoria.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: 'id=' + id
                            })
                            .then(response => response.text())
                            .then(data => {
                                if (data === 'success') {
                                    // Recargar la página para ver los cambios
                                    window.location.reload();
                                } else {
                                    alert('Error al eliminar la categoría.');
                                }
                            });
                    }
                });
            });
        });
    </script>
</body>

</html>