<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pronóstico Guardado</title>
    <link rel="stylesheet" href="assets/css/estilos.css?v=3.0">
</head>
<body>
    <div class="container">
        <h2 style="color: #10b981;">¡Pronóstico Registrado!</h2>
        
        <div class="card summary">
            <p>El usuario <strong><?= htmlspecialchars($pronostico['nombre']) ?></strong> ha pronosticado:</p>
            
            <h3>
                <?= htmlspecialchars($pronostico['local']) ?> 
                <span style="color: #fff; padding: 0 15px;"><?= htmlspecialchars($pronostico['goles_local']) ?> - <?= htmlspecialchars($pronostico['goles_visitante']) ?></span> 
                <?= htmlspecialchars($pronostico['visitante']) ?>
            </h3>
            
            <div style="background: rgba(0,0,0,0.3); padding: 15px; border-radius: 10px; margin: 20px 0;">
                <p style="color: #38bdf8; font-size: 1.2rem; font-weight: bold; margin-bottom: 5px;">🤖 Análisis del Sistema:</p>
                <p style="color: #fff;"><?= htmlspecialchars($pronostico['analisis']) ?></p>
            </div>

            <p><strong>⭐ Jugador MVP:</strong> <?= htmlspecialchars($pronostico['jugador']) ?></p>
            
            <?php if (!empty($pronostico['comentario'])): ?>
                <p class="mt-2" style="font-style: italic;">"<?= htmlspecialchars($pronostico['comentario']) ?>"</p>
            <?php endif; ?>
        </div>
        
        <div class="grid-2">
            <a href="registrar_pronostico.php" class="btn-pronosticar" style="margin-top:0;">Hacer otro pronóstico</a>
            <a href="ver_pronosticos.php" class="btn-pronosticar" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9); margin-top:0;">Ver Ranking Global</a>
        </div>
    </div>
</body>
</html>