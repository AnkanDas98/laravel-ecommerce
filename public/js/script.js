// In Admin Profile Edit
const image_input = document.querySelector("#image");
if (image_input) {
    image_input.addEventListener("change", function () {
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            const uploadImage = reader.result;
            document
                .querySelector("#showImage")
                .setAttribute("src", uploadImage);
        });
        reader.readAsDataURL(this.files[0]);
    });
}
