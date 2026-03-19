// PREVIEW IMAGEN
document.getElementById('fotoInput').addEventListener('change', function(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const img = document.getElementById('previewImg');
      const text = document.getElementById('previewText');
      img.src = e.target.result;
      img.classList.remove('hidden');
      text.style.display = 'none';
    }
    reader.readAsDataURL(file);
  }
});

// LIMPIAR FORM
function limpiarFormulario(idForm) {
  const form = document.getElementById(idForm);
  form.reset();
  const img = document.getElementById('previewImg');
  const text = document.getElementById('previewText');
  img.src = "";
  img.classList.add('hidden');
  text.style.display = 'block';
}