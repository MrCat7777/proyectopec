<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Pronóstico</title>
    <link rel="stylesheet" href="assets/css/estilos.css?v=3.0">
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn-back">← Volver al Menú</a>
        <h2>Registrar Pronóstico</h2>

        <?php if (!empty($errores)): ?>
            <div class="alert alert-error">
                <ul style="margin-left: 20px;">
                    <?php foreach ($errores as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="registrar_pronostico.php" method="POST" id="form-pronostico" class="card">
            <div id="error-js" class="alert alert-error" style="display:none; margin-bottom: 20px;"></div>

            <div class="grid-2">
                <div class="form-group">
                    <label>Tu Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($datos['nombre'] ?? '') ?>" placeholder="Ej: Juan Pérez">
                </div>
                <div class="form-group">
                    <label>Tu Correo:</label>
                    <input type="email" name="correo" id="correo" value="<?= htmlspecialchars($datos['correo'] ?? '') ?>" placeholder="correo@ejemplo.com">
                </div>
            </div>

            <div style="border-top: 1px solid rgba(255,255,255,0.1); margin: 20px 0; padding-top: 20px;">
                <div class="grid-2">
                    <div class="form-group">
                        <label>Selección Local:</label>
                        <input type="text" name="local" id="local" value="<?= htmlspecialchars($datos['local'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Goles Local:</label>
                        <input type="number" name="goles_local" id="goles_local" min="0" max="20" value="<?= htmlspecialchars($datos['goles_local'] ?? '0') ?>">
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Selección Visitante:</label>
                        <input type="text" name="visitante" id="visitante" value="<?= htmlspecialchars($datos['visitante'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Goles Visitante:</label>
                        <input type="number" name="goles_visitante" id="goles_visitante" min="0" max="20" value="<?= htmlspecialchars($datos['goles_visitante'] ?? '0') ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Jugador Destacado (MVP):</label>
                <input type="text" name="jugador" id="jugador" value="<?= htmlspecialchars($datos['jugador'] ?? '') ?>" placeholder="Ej: Enner Valencia">
            </div>

            <div class="form-group">
                <label>Comentario / Análisis:</label>
                <textarea name="comentario" id="comentario" rows="3" placeholder="¿Cómo crees que será el partido?"><?= htmlspecialchars($datos['comentario'] ?? '') ?></textarea>
            </div>

            <button type="submit">Enviar Pronóstico Final</button>
        </form>
    </div>
    
    <script src="assets/js/validaciones.js"></script>
</body>
</html>