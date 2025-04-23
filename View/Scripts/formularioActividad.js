document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('frmActividad');
    const btn  = document.getElementById('btnGuardar');

    btn.addEventListener('click', function() {
      if (!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
      }
      form.submit();
    });
  });