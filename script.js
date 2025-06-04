document.addEventListener('DOMContentLoaded', function(){
    const form = document.getElementById('');
    if(!form) return;

    form.addEventListener('submit', function(e){
        e.preventDefault();
        fetch("index.php", {
            method: "POST",
        })
        .then(res => res.text())
        .then(respuesta => {
            alert(respuesta);
        });
    });

});

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('tracking-form');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const trackingNumber = document.getElementById('tracking-number').value.trim();

        fetch("index.php?trackingNumber=" + encodeURIComponent(trackingNumber), {
            method: "GET"
        })
        .then(res => res.text())
        .then(respuesta => {
            document.getElementById('tracking-result').innerHTML = respuesta;
        });
        
    });
});