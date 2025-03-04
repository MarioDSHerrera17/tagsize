document.addEventListener("DOMContentLoaded", function () {
    fetch("../http/Controllers/ver_productos.php")
        .then(response => response.json())
        .then(data => {
            const tabla = document.getElementById("tabla-productos");
            data.forEach(producto => {
                let fila = `
                    <tr>
                        <td>${producto.id}</td>
                        <td>${producto.nombre}</td>
                        <td>$${producto.precio}</td>
                        <td>${producto.stock}</td>
                    </tr>
                `;
                tabla.innerHTML += fila;
            });
        })
        .catch(error => console.error("Error cargando productos:", error));
});
