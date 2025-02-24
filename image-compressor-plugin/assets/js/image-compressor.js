document.getElementById('image-compressor-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const fileInput = document.getElementById('image-upload');
    const file = fileInput.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(event) {
        const img = new Image();
        img.src = event.target.result;

        img.onload = function() {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            
            // Use the original dimensions of the image
            const width = img.width;
            const height = img.height;
            canvas.width = width;
            canvas.height = height;

            ctx.drawImage(img, 0, 0, width, height);

            // Compress the image without changing its dimensions
            canvas.toBlob(function(blob) {
                const compressedImageUrl = URL.createObjectURL(blob);
                document.getElementById('compressed-image').innerHTML = '<img src="' + compressedImageUrl + '">';
                document.getElementById('download-link').href = compressedImageUrl;
                document.getElementById('output').style.display = 'block';
            }, 'image/jpeg', 0.7); // Compression quality set to 70%
        }
    };
    reader.readAsDataURL(file);
});
