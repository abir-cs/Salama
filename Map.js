const mapCon = document.getElementById('map');
if (mapCon) {
    var map = L.map('map').setView([36.486592451438696, 6.822039510391554], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        // attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    L.marker([37.38322999945196, -2.040267971827429]).addTo(map)
        .bindPopup('Salama Clinic')
        .openPopup();
}

