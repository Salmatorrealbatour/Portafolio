document.addEventListener('DOMContentLoaded', function() {
    fetch('controllers/EstadisticasController.php')
        .then(res => res.json())
        .then(data => {
            const tabla = document.getElementById('tabla-estadisticas');
            tabla.innerHTML = '<tr><th>Entidad</th><th>Total</th></tr>';
            for (const entidad in data) {
                tabla.innerHTML += `<tr><td>${entidad}</td><td>${data[entidad]}</td></tr>`;
            }
        });
});
