// Frontend
window.addEventListener("load", () => {
    const productPreviewBtn = document.querySelectorAll("#productPreviewBtn");
    productPreviewBtn.forEach((btn) => {
        btn.addEventListener("click", async () => {
            try {
                const response = await fetch(
                    "/product/view/modal/" + btn.dataset.productId
                );
                const data = await response.json();

                if (data) {
                    document.querySelector("#modalPTitle").innerHTML =
                        btn.dataset.language === "bangla"
                            ? data.product.product_name_bn
                            : data.product.product_name_en;
                    document
                        .querySelector("#modalPImage")
                        .setAttribute(
                            "src",
                            `http://${location.host}/storage/${data.product.product_thumbnail}`
                        );
                    document.querySelector("#modalPPrice").innerHTML = data
                        .product.discount_price
                        ? "৳ " +
                          Math.round(
                              data.product.selling_price -
                                  data.product.selling_price *
                                      (data.product.discount_price / 100)
                          )
                        : "৳ " + data.product.selling_price;
                    document.querySelector("#modalPCode").innerHTML =
                        data.product.product_code;
                    document.querySelector("#modalPCategory").innerHTML =
                        btn.dataset.language === "bangla"
                            ? data.categoryBan
                            : data.categoryEng;
                    document.querySelector("#modalPBrand").innerHTML =
                        btn.dataset.language === "bangla"
                            ? data.brandBan
                            : data.brandEng;
                    if (data.product.product_qty > 0) {
                        document.querySelector("#modalPStock").innerHTML =
                            "Available";

                        document.querySelector(
                            "#modalPStock"
                        ).style.backgroundColor = "green";
                        document.querySelector("#modalPStock").style.color =
                            "white";
                    } else {
                        document.querySelector("#modalPStock").innerHTML =
                            "Out of Stock";
                        document.querySelector(
                            "#modalPStock"
                        ).style.backgroundColor = "red";
                        document.querySelector("#modalPStock").style.color =
                            "white";
                    }

                    if (
                        data.productSizeEng.length === 0 ||
                        data.productSizeBan.length === 0
                    ) {
                        document.querySelector(
                            "#modalPSizeSection"
                        ).style.display = "none";
                    } else {
                        document.querySelector("#modalPSize").innerHTML = "";

                        if (btn.dataset.language === "bangla") {
                            data.productSizeBan.forEach((size) => {
                                document.querySelector(
                                    "#modalPSize"
                                ).innerHTML += `<option value=${size}>${size}</option>`;
                            });
                        } else {
                            data.productSizeEng.forEach((size) => {
                                document.querySelector(
                                    "#modalPSize"
                                ).innerHTML += `<option value=${size}>${size}</option>`;
                            });
                        }
                    }

                    document.querySelector("#modalPColor").innerHTML = "";

                    if (btn.dataset.language === "bangla") {
                        data.productColorsBan.forEach((color) => {
                            document.querySelector(
                                "#modalPColor"
                            ).innerHTML += `<option value=${color}>${color}</option>`;
                        });
                    } else {
                        data.productColorsEng.forEach((color) => {
                            document.querySelector(
                                "#modalPColor"
                            ).innerHTML += `<option value=${color}>${color}</option>`;
                        });
                    }
                }
            } catch (error) {
                console.log(error);
            }
        });
    });
});
