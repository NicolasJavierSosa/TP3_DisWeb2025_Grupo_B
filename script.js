document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('tracking-form');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const trackingNumber = document.getElementById('tracking-number').value.trim();
        const resultDiv = document.getElementById('tracking-result');

        const estados = {
            "1234567890": "En tránsito - Salió del centro logístico.",
            "9876543210": "Entregado - Recibido por el destinatario.",
            "5555555555": "Pendiente de retiro en sucursal.",
        };

        if (trackingNumber in estados) {
            resultDiv.innerHTML = `<div class="tracking-status success">Estado: ${estados[trackingNumber]}</div>`;
        } else {
            resultDiv.innerHTML = `<div class="tracking-status error">No se encontró información para el número ingresado.</div>`;
        }
    });
});