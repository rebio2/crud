<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD DE USUARIOS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="web/default.css" rel="stylesheet" type="text/css" />
    <style>
        #volver {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        #volver:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h1>GESTIÓN DE USUARIOS - Solución Control</h1>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?orden=<?= $orden == 'Nuevo' ? 'PostAlta' : 'PostModificar' ?>">
                    <div class="mb-3 row">
                        <label for="first_name" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $cliente->first_name ?>" <?= ($orden == "Detalles") ? "readonly" : "" ?>>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="<?= $cliente->email ?>" <?= ($orden == "Detalles") ? "readonly" : "" ?>>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gender" class="col-sm-2 col-form-label">Género</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="gender" name="gender" <?= ($orden == "Detalles") ? "disabled" : "" ?>>
                                <option value="M" <?= ($cliente->gender == "M") ? "selected" : "" ?>>Masculino</option>
                                <option value="F" <?= ($cliente->gender == "F") ? "selected" : "" ?>>Femenino</option>
                                <option value="O" <?= ($cliente->gender == "O") ? "selected" : "" ?>>Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ip_address" class="col-sm-2 col-form-label">IP Dirección</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ip_address" name="ip_address" value="<?= $cliente->ip_address ?>" <?= ($orden == "Detalles") ? "readonly" : "" ?>>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $cliente->telefono ?>" <?= ($orden == "Detalles") ? "readonly" : "" ?>>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary"><?= $orden ?></button>
                        <a href="index.php" id="volver" class="btn btn-light">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>