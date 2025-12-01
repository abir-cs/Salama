const mapCon = document.getElementById('map');
if (mapCon) {
    var map = L.map('map').setView([36.36848772408414, 6.551323181538929], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        // attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    L.marker([36.36848772408414, 6.551323181538929]).addTo(map)
        .bindPopup('Salama Clinic')
        .openPopup();
} gi