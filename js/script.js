let videoStream;

function abrirCamara(facing = "environment") {
    const constraints = {
        video: { facingMode: { exact: facing } }  // "environment" o "user"
    };

    navigator.mediaDevices.getUserMedia(constraints)
        .then(function(stream) {
            let video = document.getElementById("video");
            video.srcObject = stream;
            videoStream = stream;
        })
        .catch(function(error) {
            console.error("Error al acceder a la cámara: ", error);
            alert("No se pudo acceder a la cámara.");
        });
}

function cerrarCamara() {
    if (videoStream) {
        let tracks = videoStream.getTracks();
        tracks.forEach(track => track.stop());
        document.getElementById("video").srcObject = null;
        videoStream = null;
    }
}
