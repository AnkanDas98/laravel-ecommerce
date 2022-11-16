// Frontend

async function loadMiniCart() {
    const cart = document.getElementById("headerCart");
    try {
        const response = await fetch("/cart/data/get");
        const data = await response.json();
        document.getElementById("miniCartDropdownItems").innerHTML = "";
        // document.getElementById("minicartCount").innerHTML = "";
        console.log(data);
        if (data) {
            document.getElementById("minicartCount").innerHTML = data.cartQty;
            document
                .querySelectorAll("#cartSubTotal")
                .forEach((element) => (element.innerHTML = data.cartTotal));
            for (let item in data.carts) {
                let contents = data.carts[item];
                document.getElementById("miniCartDropdownItems").innerHTML += `
                   <div class="cart-item product-summary">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div class="image"> <a href="detail.html"><img
                                                            src="http://${location.host}/storage/${contents.options.image}" alt=""></a> </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <h3 class="name"><a href="index.php?page-detail">${contents.name}</a></h3>
                                                <div class="price">৳ ${contents.price}</div>
                                            </div>
                                            <div class="col-xs-1 action" data-cart-id = "${contents.rowId}" id='miniCartRemove'> <a href="#"><i
                                                        class="fa fa-trash"></i></a> </div>
                                        </div>
                    </div>
                    <!-- /.cart-item -->
                    <div class="clearfix"></div>
                    <hr>
                `;

                document.querySelectorAll("#miniCartRemove").forEach((cart) => {
                    cart.addEventListener("click", () =>
                        removeMiniCartItem(cart.dataset.cartId)
                    );
                });
            }
        } else {
            document.getElementById("miniCartDropdownItems").innerHTML += `
           <div class="cart-item product-summary">
                     <p class='text-danger'>No item added to cart</p>           
            </div>      
        `;
            document.getElementById("minicartCount").innerHTML = 0;
            document
                .querySelectorAll("#cartSubTotal")
                .forEach((element) => (element.innerHTML = 0));
        }
    } catch (error) {
        console.log(error);
    }
}

async function removeMiniCartItem(rowId) {
    try {
        const response = await fetch("/cart/remove/" + rowId);
        // const data = await response.json();
        if (response.ok) {
            loadMiniCart();
        }
    } catch (error) {
        console.log(error);
    }
}

window.addEventListener("load", async () => {
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
                        document.querySelector(
                            "#modalPSizeSection"
                        ).style.display = "block";
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

                    document.querySelector("#modalPId").value = data.product.id;

                    if (+data.product.product_qty === 0) {
                        document.querySelector("#modalPBtn").disabled = true;
                    } else {
                        document.querySelector("#modalPBtn").disabled = false;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        });
    });

    loadMiniCart();
});
