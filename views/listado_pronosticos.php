<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Pronósticos</title>
    <link rel="stylesheet" href="assets/css/estilos.css?v=7.0">
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn-back seq-1">← Volver al Menú</a>
        <h2 class="seq-2">Historial de Pronósticos</h2>
        
        <?php if (empty($pronosticos)): ?>
            <div class="alert alert-info seq-3">
                Aún no hay pronósticos registrados en la base de datos MySQL. ¡Sé el primero!
            </div>
        <?php else: ?>
            <div class="grid-2">
                <?php $s = 3; foreach ($pronosticos as $p): ?>
                    <div class="card seq-<?= $s > 7 ? 7 : $s; ?>" style="padding: 25px; margin-bottom: 0;">
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px; margin-bottom: 15px;">
                            <strong style="color: #ccff00;"><?= htmlspecialchars($p['nombre']) ?></strong>
                            <span style="font-size: 0.8rem; color: #64748b;"><?= htmlspecialchars(date('d M Y', strtotime($p['fecha']))) ?></span>
                        </div>
                        
                        <h3 style="text-align: center; margin-bottom: 15px; font-size: 1.5rem;">
                            <?= htmlspecialchars($p['local']) ?> <span style="color:#ccff00;"><?= htmlspecialchars($p['goles_local']) ?> - <?= htmlspecialchars($p['goles_visitante']) ?></span> <?= htmlspecialchars($p['visitante']) ?>
                        </h3>
                        
                        <p style="font-size: 0.9rem;"><strong>MVP:</strong> <?= htmlspecialchars($p['jugador']) ?></p>
                        <p style="font-size: 0.9rem;"><strong>Predicción:</strong> <?= htmlspecialchars($p['analisis']) ?></p>
                    </div>
                <?php $s++; endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>