<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Partidos</title>
    <link rel="stylesheet" href="assets/css/estilos.css?v=4.0">
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn-back">← Volver al Menú</a>
        
        <form action="buscar_partidos.php" method="GET" class="card">
            <div style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
                <div class="form-group" style="flex: 2; margin-bottom: 0;">
                    <label>Buscar País:</label>
                    <input type="text" name="seleccion" value="<?= $seleccion ?? '' ?>" placeholder="Ej: Ecuador">
                </div>
                <div class="form-group" style="flex: 2; margin-bottom: 0;">
                    <label>Fase:</label>
                    <select name="fase">
                        <option value="todas" <?= (isset($fase) && $fase == 'todas') ? 'selected' : '' ?>>Todas</option>
                        <option value="grupos" <?= (isset($fase) && $fase == 'grupos') ? 'selected' : '' ?>>Grupos</option>
                        <option value="octavos" <?= (isset($fase) && $fase == 'octavos') ? 'selected' : '' ?>>Octavos</option>
                        <option value="cuartos" <?= (isset($fase) && $fase == 'cuartos') ? 'selected' : '' ?>>Cuartos</option>
                        <option value="semifinal" <?= (isset($fase) && $fase == 'semifinal') ? 'selected' : '' ?>>Semifinal</option>
                        <option value="final" <?= (isset($fase) && $fase == 'final') ? 'selected' : '' ?>>Final</option>
                    </select>
                </div>
                <div style="flex: 1;">
                    <button type="submit" style="margin-top: 0; padding: 14px;">Buscar</button>
                </div>
            </div>
        </form>

        <?php if (isset($busquedaActiva) && $busquedaActiva): ?>
            
            <?php if (empty($partidos_encontrados)): ?>
                <div class="alert alert-error">No se encontraron partidos para tu búsqueda.</div>
            <?php else: ?>
                <div class="bracket-container">
                    <?php foreach ($partidos_encontrados as $p): ?>
                        <div class="bracket-node">
                            <!-- Lado Izquierdo (Local) -->
                            <div class="bracket-team">
                                <img src="<?= $p['bandera_local'] ?>" alt="Bandera">
                                <span><?= $p['local'] ?></span>
                            </div>

                            <!-- Centro (Info y Botón) -->
                            <div class="bracket-center">
                                <span class="neon-tag"><?= $p['fase'] ?></span>
                                <span class="bracket-date"><?= $p['fecha'] ?></span>
                                
                                <!-- VALIDACIÓN DE TIEMPO AQUÍ -->
                                <?php if ($p['ya_paso']): ?>
                                    <span class="btn-disabled">FINALIZADO</span>
                                <?php else: ?>
                                    <a href="registrar_pronostico.php?local=<?= urlencode($p['local']) ?>&visitante=<?= urlencode($p['visitante']) ?>" class="btn-pronosticar">PRONOSTICAR</a>
                                <?php endif; ?>
                            </div>

                            <!-- Lado Derecho (Visitante) -->
                            <div class="bracket-team team-right">
                                <img src="<?= $p['bandera_visitante'] ?>" alt="Bandera">
                                <span><?= $p['visitante'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>