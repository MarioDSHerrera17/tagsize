<<<<<<< HEAD
/* ==========================================================
   scanner.js
   Control de cámara + QuaggaJS + consulta al backend
   ========================================================== */

let videoStream = null;

/* ---------- Abrir cámara ---------- */
function abrirCamara(facing = "environment") {
    const constraints = { video: { facingMode: { exact: facing } } };

    navigator.mediaDevices.getUserMedia(constraints)
        .then(stream => {
            const video = document.getElementById("video");
            video.srcObject = stream;
            videoStream = stream;
            iniciarEscaneo();     // ⇒  QuaggaJS
        })
        .catch(err => {
            console.error("Error al acceder a la cámara:", err);
            alert("No se pudo acceder a la cámara.");
        });
}

/* ---------- Cerrar cámara ---------- */
function cerrarCamara() {
    if (videoStream) {
        videoStream.getTracks().forEach(t => t.stop());
        document.getElementById("video").srcObject = null;
        videoStream = null;
    }
    Quagga.stop(); // detiene Quagga si está corriendo
}

/* ---------- Configurar QuaggaJS ---------- */
function iniciarEscaneo() {
    Quagga.init(
        {
            inputStream: {
                type      : "LiveStream",
                target    : document.querySelector("#video"),
                constraints: { facingMode: "environment" }
            },
            decoder: {
                readers: ["code_128_reader", "ean_reader", "ean_8_reader", "upc_reader", "upc_e_reader"]
            },
            locate: true // ayuda a encontrar el código en la imagen
        },
        err => {
            if (err) {
                console.error(err);
                alert("Error iniciando el lector: " + err.message);
                return;
            }
            Quagga.start();
        }
    );
}
/* ---------- Evento de detección ---------- */
Quagga.onDetected(async function onDetected({ codeResult }) {
    if (!codeResult || !codeResult.code) return;

    const codigo = codeResult.code;

    // Pausar detección mientras procesamos
    Quagga.offDetected(onDetected);

    // Mostrar que se está buscando
    document.getElementById("resultado").innerHTML =
        `<p>Buscando producto con código <strong>${codigo}</strong>…</p>`;

    try {
        const res  = await fetch(`../http/controllers/buscar_producto.php?codigo=${encodeURIComponent(codigo)}`);
        const data = await res.json();

        if (data.ok) {
            mostrarProducto(data.producto);
        } else {
            document.getElementById("resultado").innerHTML =
                `<p style="color:red;">${data.mensaje || "Producto no encontrado"}</p>`;
        }
    } catch (e) {
        console.error(e);
        document.getElementById("resultado").innerHTML =
            `<p style="color:red;">Error al consultar el producto.</p>`;
    } finally {
        // Reactivar detección después de un breve retraso
        setTimeout(() => {
            Quagga.onDetected(onDetected);
        }, 2000); // Espera 2 segundos antes de reactivar
    }
});


/* ---------- Mostrar la info en pantalla ---------- */
function mostrarProducto(p) {
    const div = document.getElementById("resultado");
    div.innerHTML = `
        <h3>Producto encontrado</h3>
        ${p.imagen_producto ? `<img src="${p.imagen_producto}" alt="${p.nombre_producto}" style="max-width:150px;margin-bottom:0.5rem">` : ''}
        <ul>
            <li><strong>Nombre:</strong> ${p.nombre_producto}</li>
            <li><strong>Marca:</strong> ${p.marca_producto}</li>
            <li><strong>Precio:</strong> $${p.precio_producto}</li>
            <li><strong>Stock:</strong> ${p.stock_del_producto}</li>
            <li><strong>Descripción:</strong> ${p.descripcion_producto}</li>
            <li><strong>Fecha de creación:</strong> ${p.fecha_creacion_producto}</li>
            <li><strong>Código de barras:</strong> ${p.codigo_barras}</li>
        </ul>
    `;
}
=======
/* ==========================================================
   scanner.js
   Control de cámara + QuaggaJS + consulta al backend
   ========================================================== */

let videoStream = null;

/* ---------- Abrir cámara ---------- */
function abrirCamara(facing = "environment") {
    const constraints = { video: { facingMode: { exact: facing } } };

    navigator.mediaDevices.getUserMedia(constraints)
        .then(stream => {
            const video = document.getElementById("video");
            video.srcObject = stream;
            videoStream = stream;
            iniciarEscaneo();     // ⇒  QuaggaJS
        })
        .catch(err => {
            console.error("Error al acceder a la cámara:", err);
            alert("No se pudo acceder a la cámara.");
        });
}

/* ---------- Cerrar cámara ---------- */
function cerrarCamara() {
    if (videoStream) {
        videoStream.getTracks().forEach(t => t.stop());
        document.getElementById("video").srcObject = null;
        videoStream = null;
    }
    Quagga.stop(); // detiene Quagga si está corriendo
}

/* ---------- Configurar QuaggaJS ---------- */
function iniciarEscaneo() {
    Quagga.init(
        {
            inputStream: {
                type      : "LiveStream",
                target    : document.querySelector("#video"),
                constraints: { facingMode: "environment" }
            },
            decoder: {
                readers: ["code_128_reader", "ean_reader", "ean_8_reader", "upc_reader", "upc_e_reader"]
            },
            locate: true // ayuda a encontrar el código en la imagen
        },
        err => {
            if (err) {
                console.error(err);
                alert("Error iniciando el lector: " + err.message);
                return;
            }
            Quagga.start();
        }
    );
}
/* ---------- Evento de detección ---------- */
Quagga.onDetected(async function onDetected({ codeResult }) {
    if (!codeResult || !codeResult.code) return;

    const codigo = codeResult.code;

    // Pausar detección mientras procesamos
    Quagga.offDetected(onDetected);

    // Mostrar que se está buscando
    document.getElementById("resultado").innerHTML =
        `<p>Buscando producto con código <strong>${codigo}</strong>…</p>`;

    try {
        const res  = await fetch(`../http/controllers/buscar_producto.php?codigo=${encodeURIComponent(codigo)}`);
        const data = await res.json();

        if (data.ok) {
            mostrarProducto(data.producto);
        } else {
            document.getElementById("resultado").innerHTML =
                `<p style="color:red;">${data.mensaje || "Producto no encontrado"}</p>`;
        }
    } catch (e) {
        console.error(e);
        document.getElementById("resultado").innerHTML =
            `<p style="color:red;">Error al consultar el producto.</p>`;
    } finally {
        // Reactivar detección después de un breve retraso
        setTimeout(() => {
            Quagga.onDetected(onDetected);
        }, 2000); // Espera 2 segundos antes de reactivar
    }
});


/* ---------- Mostrar la info en pantalla ---------- */
function mostrarProducto(p) {
    const div = document.getElementById("resultado");
    div.innerHTML = `
        <h3>Producto encontrado</h3>
        ${p.imagen_producto ? `<img src="${p.imagen_producto}" alt="${p.nombre_producto}" style="max-width:150px;margin-bottom:0.5rem">` : ''}
        <ul>
            <li><strong>Nombre:</strong> ${p.nombre_producto}</li>
            <li><strong>Marca:</strong> ${p.marca_producto}</li>
            <li><strong>Precio:</strong> $${p.precio_producto}</li>
            <li><strong>Stock:</strong> ${p.stock_del_producto}</li>
            <li><strong>Descripción:</strong> ${p.descripcion_producto}</li>
            <li><strong>Fecha de creación:</strong> ${p.fecha_creacion_producto}</li>
            <li><strong>Código de barras:</strong> ${p.codigo_barras}</li>
        </ul>
    `;
}
>>>>>>> 6e6044f0db3f2e69cd53519e0f16e656b79f9463
