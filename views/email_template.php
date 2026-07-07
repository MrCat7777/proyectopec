<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body style="margin: 0; padding: 0; background-color: #0c152d; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #0c152d; padding: 40px 10px;">
        <tr>
            <td align="center">
                
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #15244d; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                    
                    <!-- Cabecera con Logo Oficial -->
                    <tr>
                        <td align="center" style="padding: 40px 20px 20px 20px;">
                            <img src="https://cdn.prod.website-files.com/68f550992570ca0322737dc2/69f4a666ff876f5a52a1b7ab_fifa-world-cup-2026-official-logo-footylogos.webp" width="160" alt="Mundial 2026" style="display: block; margin-bottom: 25px; filter: drop-shadow(0 0 10px rgba(255,255,255,0.2));">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; letter-spacing: 1px; text-transform: uppercase;">Confirmación de Pronóstico</h1>
                        </td>
                    </tr>
                    
                    <!-- Línea Neón Amarilla -->
                    <tr>
                        <td height="4" style="background-color: #ccff00; font-size: 0; line-height: 0;">&nbsp;</td>
                    </tr>
                    
                    <!-- Cuerpo del mensaje -->
                    <tr>
                        <td style="padding: 40px 30px; color: #ffffff;">
                            <p style="margin: 0 0 15px 0; font-size: 16px;">Hola <strong><?php echo htmlspecialchars($nombre); ?></strong>,</p>
                            
                            <p style="margin: 0 0 25px 0; font-size: 16px; line-height: 1.5; color: #cbd5e1;">
                                Tu pronóstico ha sido registrado exitosamente en el sistema. Aquí tienes el detalle de tu predicción:
                            </p>
                            
                            <div style="background-color: rgba(255,255,255,0.05); padding: 20px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); margin-bottom: 25px;">
                                <p style="margin: 0; font-size: 18px; text-align: center;">
                                    <strong><?php echo htmlspecialchars($local); ?></strong> 
                                    <span style="color: #ccff00; font-size: 20px; padding: 0 10px;"><?php echo htmlspecialchars($golesL); ?> - <?php echo htmlspecialchars($golesV); ?></span> 
                                    <strong><?php echo htmlspecialchars($visitante); ?></strong>
                                </p>
                            </div>
                            
                            <p style="margin: 0 0 5px 0; font-size: 16px;">
                                <strong>Jugador MVP:</strong> <?php echo htmlspecialchars($jugador); ?>
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 20px; background-color: #080e1e; color: #64748b; font-size: 12px;">
                            Proyecto realizado by Reinaldo Jordan - Julio 2026
                        </td>
                    </tr>
                </table>
                
            </td>
        </tr>
    </table>

</body>
</html>