export function handlePhotoUpload(event, callback) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();

    reader.onload = ({ target }) => {
        callback({
            file,
            style: `background-image: url(${target.result}); background-size: cover; background-position: center;`
        });
    };

    reader.readAsDataURL(file);
}
