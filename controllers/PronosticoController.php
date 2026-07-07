<?php
require_once 'models/Pronostico.php';
require_once 'libraries/PronosticoHelper.php';

class PronosticoController {
    
    public function buscarPartidos() {
        $seleccion = isset($_GET['seleccion']) ? trim(htmlspecialchars($_GET['seleccion'])) : '';
        $fase = isset($_GET['fase']) ? htmlspecialchars($_GET['fase']) : '';

        $busquedaActiva = (!empty($seleccion) || (!empty($fase) && $fase !== 'todas'));
        $partidos_encontrados = [];

        if ($busquedaActiva) {
            
            $apiKey = 'c233b825f26844a8ba3858b6bbb4c40a'; 
            $urlAPI = 'https://api.football-data.org/v4/competitions/WC/matches';
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlAPI);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-Auth-Token: $apiKey"]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            $respuestaAPI = curl_exec($ch);
            $codigoEstado = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            $diccionarioPaises = [
                'Argentina' => 'Argentina', 'Brazil' => 'Brasil', 'England' => 'Inglaterra',
                'France' => 'Francia', 'Spain' => 'España', 'Germany' => 'Alemania',
                'Netherlands' => 'Países Bajos', 'Portugal' => 'Portugal', 'Belgium' => 'Bélgica',
                'Italy' => 'Italia', 'Croatia' => 'Croacia', 'Uruguay' => 'Uruguay',
                'Colombia' => 'Colombia', 'Ecuador' => 'Ecuador', 'Mexico' => 'México',
                'United States' => 'Estados Unidos', 'USA' => 'Estados Unidos', 'Canada' => 'Canadá',
                'Japan' => 'Japón', 'South Korea' => 'Corea del Sur', 'Morocco' => 'Marruecos',
                'Senegal' => 'Senegal', 'Switzerland' => 'Suiza', 'Poland' => 'Polonia'
            ];

            $diccionarioBanderas = [
                'Argentina' => 'ar', 'Brasil' => 'br', 'Inglaterra' => 'gb-eng', 'Francia' => 'fr',
                'España' => 'es', 'Alemania' => 'de', 'Países Bajos' => 'nl', 'Portugal' => 'pt',
                'Bélgica' => 'be', 'Italia' => 'it', 'Croacia' => 'hr', 'Uruguay' => 'uy',
                'Colombia' => 'co', 'Ecuador' => 'ec', 'México' => 'mx', 'Estados Unidos' => 'us',
                'Canadá' => 'ca', 'Japón' => 'jp', 'Corea del Sur' => 'kr', 'Marruecos' => 'ma',
                'Senegal' => 'sn', 'Suiza' => 'ch', 'Polonia' => 'pl', 'Qatar' => 'qa', 'Gales' => 'gb-wls'
            ];

            $fasesTraducidas = [
                'GROUP_STAGE' => 'grupos', 'LAST_16' => 'octavos', 'QUARTER_FINALS' => 'cuartos',
                'SEMI_FINALS' => 'semifinal', 'FINAL' => 'final', 'THIRD_PLACE' => 'Tercer Lugar'
            ];

            $mesesEspanol = ['Jan'=>'Ene','Feb'=>'Feb','Mar'=>'Mar','Apr'=>'Abr','May'=>'May','Jun'=>'Jun','Jul'=>'Jul','Aug'=>'Ago','Sep'=>'Sep','Oct'=>'Oct','Nov'=>'Nov','Dec'=>'Dic'];

            $zonaHoraria = new DateTimeZone('America/Guayaquil');
            $fechaActualObj = new DateTime('now', $zonaHoraria);
            $timestampActual = $fechaActualObj->getTimestamp();

            $calendarioPartidos = [];

            if ($codigoEstado == 200 && $respuestaAPI) {
                $datosJson = json_decode($respuestaAPI, true);
                
                foreach ($datosJson['matches'] as $partido) {
                    $localEn = $partido['homeTeam']['name'] ?? 'Por definir';
                    $visitanteEn = $partido['awayTeam']['name'] ?? 'Por definir';
                    $localEs = $diccionarioPaises[$localEn] ?? $localEn;
                    $visitanteEs = $diccionarioPaises[$visitanteEn] ?? $visitanteEn;

                    $faseAPI = $partido['stage'] ?? '';
                    $faseEs = $fasesTraducidas[$faseAPI] ?? strtolower($faseAPI);

                    $fechaAPI = new DateTime($partido['utcDate']);
                    $fechaAPI->setTimezone($zonaHoraria);
                    $timestampPartido = $fechaAPI->getTimestamp();
                    
                    $mesEn = $fechaAPI->format('M');
                    $fechaFormateada = $fechaAPI->format('d') . ' ' . $mesesEspanol[$mesEn] . ' - ' . $fechaAPI->format('h:i A');

                    $codigoLocal = $diccionarioBanderas[$localEs] ?? 'un';
                    $codigoVisitante = $diccionarioBanderas[$visitanteEs] ?? 'un';

                    $calendarioPartidos[] = [
                        'local' => $localEs,
                        'visitante' => $visitanteEs,
                        'bandera_local' => "https://flagcdn.com/w40/" . $codigoLocal . ".png",
                        'bandera_visitante' => "https://flagcdn.com/w40/" . $codigoVisitante . ".png",
                        'fase' => $faseEs,
                        'fecha' => $fechaFormateada,
                        'ya_paso' => ($timestampPartido < $timestampActual)
                    ];
                }
            } else {
                $calendarioPartidos = [
                    ['local' => 'Ecuador', 'visitante' => 'Senegal', 'fase' => 'grupos', 'fecha_iso' => '2022-11-29T10:00:00Z'],
                    ['local' => 'Argentina', 'visitante' => 'Francia', 'fase' => 'final', 'fecha_iso' => '2022-12-18T10:00:00Z'],
                    ['local' => 'México', 'visitante' => 'Polonia', 'fase' => 'octavos', 'fecha_iso' => '2026-07-15T15:00:00Z'],
                    ['local' => 'Brasil', 'visitante' => 'Alemania', 'fase' => 'semifinal', 'fecha_iso' => '2026-07-18T20:00:00Z']
                ];

                $tempAjustado = [];
                foreach($calendarioPartidos as $p) {
                    $fechaAPI = new DateTime($p['fecha_iso']);
                    $fechaAPI->setTimezone($zonaHoraria);
                    $timestampPartido = $fechaAPI->getTimestamp();
                    $mesEn = $fechaAPI->format('M');
                    $p['fecha'] = $fechaAPI->format('d') . ' ' . $mesesEspanol[$mesEn] . ' - ' . $fechaAPI->format('h:i A');
                    $p['ya_paso'] = ($timestampPartido < $timestampActual);
                    
                    $codigoLocal = $diccionarioBanderas[$p['local']] ?? 'un';
                    $codigoVisitante = $diccionarioBanderas[$p['visitante']] ?? 'un';
                    $p['bandera_local'] = "https://flagcdn.com/w40/" . $codigoLocal . ".png";
                    $p['bandera_visitante'] = "https://flagcdn.com/w40/" . $codigoVisitante . ".png";
                    
                    $tempAjustado[] = $p;
                }
                $calendarioPartidos = $tempAjustado;
            }

            foreach ($calendarioPartidos as $partido) {
                $coincideSeleccion = true;
                $coincideFase = true;

                if (!empty($seleccion)) {
                    $busqueda = strtolower($seleccion);
                    $local = strtolower($partido['local']);
                    $visitante = strtolower($partido['visitante']);
                    
                    if (strpos($local, $busqueda) === false && strpos($visitante, $busqueda) === false) {
                        $coincideSeleccion = false;
                    }
                }

                if (!empty($fase) && $fase !== 'todas') {
                    if (strpos($partido['fase'], $fase) === false) {
                        $coincideFase = false;
                    }
                }

                if ($coincideSeleccion && $coincideFase) {
                    $partidos_encontrados[] = $partido;
                }
            }
        }

        require_once 'views/formulario_busqueda.php';
    }

    public function mostrarFormularioPronostico($errores = [], $datos = []) {
        if (empty($datos) && !empty($_GET)) {
            $datos['local'] = $_GET['local'] ?? '';
            $datos['visitante'] = $_GET['visitante'] ?? '';
        }
        require_once 'views/formulario_pronostico.php';
    }

    public function guardarPronostico($postData) {
        $errores = [];
        
        $nombre = trim($postData['nombre'] ?? '');
        $correo = trim($postData['correo'] ?? '');
        $local = trim($postData['local'] ?? '');
        $visitante = trim($postData['visitante'] ?? '');
        $golesL = $postData['goles_local'] ?? '';
        $golesV = $postData['goles_visitante'] ?? '';
        $jugador = trim($postData['jugador'] ?? '');
        $comentario = trim($postData['comentario'] ?? '');

        if (empty($nombre)) $errores[] = "El nombre es obligatorio.";
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = "El correo no es válido.";
        if (empty($local) || empty($visitante)) $errores[] = "Las selecciones son obligatorias.";
        if ($local === $visitante && !empty($local)) $errores[] = "La selección local y visitante no pueden ser iguales.";
        if (!is_numeric($golesL) || $golesL < 0 || $golesL > 20) $errores[] = "Goles del local inválidos (0-20).";
        if (!is_numeric($golesV) || $golesV < 0 || $golesV > 20) $errores[] = "Goles del visitante inválidos (0-20).";
        if (empty($jugador)) $errores[] = "El jugador destacado es obligatorio.";
        if (strlen($comentario) > 200) $errores[] = "El comentario no debe exceder 200 caracteres.";

        if (!empty($errores)) {
            $this->mostrarFormularioPronostico($errores, $postData);
            return;
        }

        $helper = new PronosticoHelper();
        $analisis = $helper->calcularGanador($local, $golesL, $visitante, $golesV);

        $modelo = new Pronostico();
        $pronostico = [
            'nombre' => $nombre,
            'correo' => $correo,
            'local' => $local,
            'visitante' => $visitante,
            'goles_local' => $golesL,
            'goles_visitante' => $golesV,
            'jugador' => $jugador,
            'comentario' => $comentario,
            'analisis' => $analisis,
            'fecha' => date('Y-m-d H:i:s')
        ];
        $modelo->guardar($pronostico);

        require_once 'views/resumen_pronostico.php';
    }

    public function listarPronosticos() {
        $modelo = new Pronostico();
        $pronosticos = $modelo->obtenerTodos();
        require_once 'views/listado_pronosticos.php';
    }
}
?>