document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('loginForm');

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(form);

    fetch('../controllers/LoginController.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        window.location.href = '../index.php';
      } else {
        document.getElementById('error-message').textContent = data.error;
      }
    })
    .catch(error => {
      console.error("Error en la solicitud:", error);
      document.getElementById('error-message').textContent = "Error de conexión con el servidor.";
    });
  });
});
