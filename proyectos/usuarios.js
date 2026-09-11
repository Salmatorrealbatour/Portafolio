document.addEventListener('DOMContentLoaded', () => {
  const botonesEliminar = document.querySelectorAll('.btn.eliminar');

  botonesEliminar.forEach(boton => {
    boton.addEventListener('click', function (e) {
      e.preventDefault();
      const id = this.dataset.id;

      if (confirm('¿Eliminar este usuario?')) {
        const formData = new FormData();
        formData.append('id', id);

        fetch('../controllers/EliminarUsuarioController.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            this.closest('tr').remove();
          } else {
            alert('❌ ' + (data.message || 'Error desconocido'));
          }
        })
        .catch(error => {
          alert('❌ Error de conexión: ' + error);
        });
      }
    });
  });
});
