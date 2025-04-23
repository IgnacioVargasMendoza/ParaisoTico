document.addEventListener('DOMContentLoaded', function() {
    const form       = document.getElementById('frmCategoria');
    const errorDiv   = document.getElementById('errorCategoria');
    form.addEventListener('submit', function(e) {
      if (!form.querySelector('input[name="opcionesCategoria"]:checked')) {
        e.preventDefault();
        errorDiv.style.display = 'block';
      }
    });
  });