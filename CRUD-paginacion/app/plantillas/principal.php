<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for better icons -->
    <style>
        .icon-delete {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid red;
            color: red;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            line-height: 16px;
            border-radius: 4px;
        }

        .icon-edit {
            display: inline-block;
            width: 24px;
            height: 24px;
            background-color: orange;
            color: white;
            font-size: 14px;
            text-align: center;
            line-height: 22px;
            border-radius: 4px;
        }

        .icon-details {
            display: inline-block;
            width: 24px;
            height: 24px;
            background-color: blue;
            color: white;
            font-size: 14px;
            text-align: center;
            line-height: 22px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <header class="mb-4 text-center">
            <h1 class="display-5">Listado de Clientes</h1>
        </header>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div class="toast align-items-center text-bg-<?= $_SESSION['tipo_mensaje'] ?> border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <?= $_SESSION['mensaje'] ?>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <?php unset($_SESSION['mensaje']); unset($_SESSION['tipo_mensaje']); ?>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>IP Address</th>
                        <th>Teléfono</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tclientes as $cli): ?>
                        <tr>
                            <td><?= $cli->id ?></td>
                            <td><?= $cli->first_name ?></td>
                            <td><?= $cli->email ?></td>
                            <td><?= $cli->gender ?></td>
                            <td><?= $cli->ip_address ?></td>
                            <td><?= $cli->telefono ?></td>
                            <td class="text-center">
                                <!-- Icon for Delete -->
                                <a href="index.php?orden=Borrar&id=<?= $cli->id ?>"
                                    onclick="return confirmDelete(<?= $cli->id ?>)"
                                    class="icon-delete" title="Borrar">X</a>
                                <!-- Icon for Edit -->
                                <a href="index.php?orden=Modificar&id=<?= $cli->id ?>" class="icon-edit ms-2" title="Modificar">
                                    ✏
                                </a>
                                <!-- Icon for Details -->
                                <a href="index.php?orden=Detalles&id=<?= $cli->id ?>" class="icon-details ms-2" title="Detalles">
                                    👁
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center my-4">
            <form class="btn-group">
                <button name="orden" value="Primero" class="btn btn-primary">&laquo; Primero</button>
                <button name="orden" value="Anterior" class="btn btn-secondary">&lsaquo; Anterior</button>
                <button name="orden" value="Siguiente" class="btn btn-secondary">Siguiente &rsaquo;</button>
                <button name="orden" value="Ultimo" class="btn btn-primary">Último &raquo;</button>
                <button name="orden" value="Nuevo" class="btn btn-success">Nuevo</button>
                <button name="orden" value="Terminar" class="btn btn-danger">Terminar</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="web/script.js"></script>
</body>

</html>