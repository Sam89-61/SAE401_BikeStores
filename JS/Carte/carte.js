document.addEventListener('DOMContentLoaded', function () {
    let lat = null;
    let long = null;
    async function getPublicIP() {
        try {
            const response = await fetch('https://api.bigdatacloud.net/data/client-ip');
            if (!response.ok) {
                throw new Error('Network error');
            }
            const data = await response.json();
            return data.ipString;
        } catch (error) {
            console.error("Error while retrieving the IP address:", error);
        }

    }

    getPublicIP().then((ip) => {
        if (ip) {
            console.log(ip);
            getCoordonnees(ip);
        }
        else {
            carte(null, null);
            console.log("Error while retrieving the IP address");

        }
    });



    async function getCoordonnees(ip) {
        try {
            const response = await fetch(`https://api.apibundle.io/ip-lookup?apikey=f9fe188eff6648ea8d03353376d7a2c7&ip=${ip}`);
            if (!response.ok) {
                throw new Error('Network error');
            }
            const data = await response.json();
            lat = data.latitude;
            long = data.longitude;

            carte(lat, long);

        } catch (error) {
            console.error("Error while retrieving the IP address:", error);        }
    }


    let map;

    function carte(lat, long) {
        if (map !== undefined) {
            map.remove();
        }
        if (lat == null || long == null) {
            map = L.map('map').setView([38.4819612, -100.467084], 4);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

        } else {
            map = L.map('map').setView([lat, long], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([lat, long]).addTo(map);
            marker.bindPopup('You are here').openPopup();
        }
        magasin();
    }

    async function magasin() {
        try {
            const reponse = await fetch("https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=stores");
            if (!reponse.ok) {
                throw new Error("Network error");
            }
            const data = await reponse.json();
            for (let magasin of data) {
                villeMagasin(magasin.city, magasin.street, magasin.zip_code,magasin.state).then((data) => {
                    const marker = L.marker([data.lat, data.lon]).addTo(map);
                    marker.bindPopup(`<b>${magasin.store_name}</b><br> ${magasin.city}`);
                });
            }
        } catch (error) {
            console.error("Error while retrieving the stores:", error);
        }
    }
    async function villeMagasin(ville, street, zip,state) {
        try {
            console.log("city "+ville+" street: "+street+" zip: "+zip+" state: "+state);

            const reponse = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(street)},${encodeURIComponent(zip)}`);
            if (!reponse.ok) {
                throw new Error("Network error");
            }
            const data = await reponse.json();
            return data[0];


        }
        catch (error) {
            console.error("Error while retrieving the cities of the stores:", error);
        }
    }


});