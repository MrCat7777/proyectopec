    document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("form-pronostico");
    const errorDiv = document.getElementById("error-js");

    form.addEventListener("submit", function(e) {
        let errores = [];
        
        const nombre = document.getElementById("nombre").value.trim();
        const correo = document.getElementById("correo").value.trim();
        const local = document.getElementById("local").value.trim();
        const visitante = document.getElementById("visitante").value.trim();
        const golesL = parseInt(document.getElementById("goles_local").value, 10);
        const golesV = parseInt(document.getElementById("goles_visitante").value, 10);
        const jugador = document.getElementById("jugador").value.trim();
        const comentario = document.getElementById("comentario").value.trim();

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (nombre === "") errores.push("El nombre no puede estar vacío.");
        if (!emailRegex.test(correo)) errores.push("El correo debe tener un formato válido.");
        if (local === "" || visitante === "") errores.push("Ambas selecciones son obligatorias.");
        if (local !== "" && local.toLowerCase() === visitante.toLowerCase()) {
            errores.push("Las selecciones local y visitante no pueden ser iguales.");
        }
        if (isNaN(golesL) || golesL < 0 || golesL > 20) errores.push("Goles del local deben estar entre 0 y 20.");
        if (isNaN(golesV) || golesV < 0 || golesV > 20) errores.push("Goles del visitante deben estar entre 0 y 20.");
        if (jugador === "") errores.push("El jugador destacado no puede estar vacío.");
        if (comentario.length > 200) errores.push("El comentario no debe superar los 200 caracteres.");

        if (errores.length > 0) {
            e.preventDefault();
            errorDiv.innerHTML = "<ul>" + errores.map(err => "<li>" + err + "</li>").join("") + "</ul>";
            errorDiv.style.display = "block";
        } else {
            errorDiv.style.display = "none";
        }
    });
});

