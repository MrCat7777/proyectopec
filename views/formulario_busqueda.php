<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Partidos</title>
    <link rel="stylesheet" href="assets/css/estilos.css?v=7.0">
    <style>
        .grid-busqueda {
            display: grid;
            grid-template-columns: 2fr 2fr 1.2fr;
            gap: 20px;
            align-items: end;
        }
        .alto-fijo {
            height: 52px !important;
            margin-top: 0 !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @media (max-width: 768px) {
            .grid-busqueda {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn-back seq-1">← Volver al Menú</a>
        
        <form action="buscar_partidos.php" method="GET" class="card seq-2">
            <div class="grid-busqueda">
                <div class="form-group" style="margin-bottom: 0;">
                    <label>Buscar País:</label>
                    <input type="text" name="seleccion" value="<?= $seleccion ?? '' ?>" placeholder="Ej: Ecuador" class="alto-fijo">
                </div>
                
                <div class="form-group" style="margin-bottom: 0;">
                    <label>Fase:</label>
                    <select name="fase" class="alto-fijo">
                        <option value="todas" <?= (isset($fase) && $fase == 'todas') ? 'selected' : '' ?>>Todas</option>
                        <option value="grupos" <?= (isset($fase) && $fase == 'grupos') ? 'selected' : '' ?>>Grupos</option>
                        <option value="octavos" <?= (isset($fase) && $fase == 'octavos') ? 'selected' : '' ?>>Octavos</option>
                        <option value="cuartos" <?= (isset($fase) && $fase == 'cuartos') ? 'selected' : '' ?>>Cuartos</option>
                        <option value="semifinal" <?= (isset($fase) && $fase == 'semifinal') ? 'selected' : '' ?>>Semifinal</option>
                        <option value="final" <?= (isset($fase) && $fase == 'final') ? 'selected' : '' ?>>Final</option>
                    </select>
                </div>
                
                <div>
                    <button type="submit" class="alto-fijo" style="width: 100%;">Buscar</button>
                </div>
            </div>
        </form>

        <?php if (isset($busquedaActiva) && $busquedaActiva): ?>
            
            <?php if (empty($partidos_encontrados)): ?>
                <div class="alert alert-error seq-3">No se encontraron partidos para tu búsqueda.</div>
            <?php else: ?>
                <div class="bracket-container seq-3">
                    <?php foreach ($partidos_encontrados as $p): ?>
                        <div class="bracket-node">
                            <div class="bracket-team">
                                <img src="<?= $p['bandera_local'] ?>" alt="Bandera">
                                <span><?= $p['local'] ?></span>
                            </div>

                            <div class="bracket-center">
                                <span class="neon-tag"><?= $p['fase'] ?></span>
                                <span class="bracket-date"><?= $p['fecha'] ?></span>
                                
                                <?php if ($p['ya_paso']): ?>
                                    <span class="btn-disabled">FINALIZADO</span>
                                <?php else: ?>
                                    <a href="registrar_pronostico.php?local=<?= urlencode($p['local']) ?>&visitante=<?= urlencode($p['visitante']) ?>" class="btn-pronosticar">PRONOSTICAR</a>
                                <?php endif; ?>
                            </div>

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