// Frontend

// Handle Product Preview Button Event

function productPreview() {
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
}

async function loadMiniCart() {
    const cart = document.getElementById("headerCart");
    try {
        const response = await fetch("/cart/data/get");
        const data = await response.json();
        document.getElementById("miniCartDropdownItems").innerHTML = "";
        // document.getElementById("minicartCount").innerHTML = "";

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
                                                <div class="price">৳ ${contents.price} X ${contents.qty}</div>
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
            document.getElementById("cartPage") && getCart();
            calculateCoupon();
        }
    } catch (error) {
        console.log(error);
    }
}

async function addToWishList(id) {
    const productId = id;

    try {
        const response = await fetch("/wishlist/add", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ productId }),
        });
        const data = await response.json();
        if (response.ok) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
            });
            if (!data.error) {
                Toast.fire({
                    icon: "success",
                    title: data.success,
                });
            } else {
                Toast.fire({
                    icon: "error",
                    title: data.error,
                });
            }
            // End Message
        }
        // const data = await response.json(productId);
    } catch (error) {
        console.log(error);
    }
}

async function getWishList() {
    const wishlist = document.getElementById("wishlist");
    try {
        const response = await fetch("/user/get/wishlist");
        const data = await response.json();
        wishlist.innerHTML = "";
        // document.getElementById("minicartCount").innerHTML = "";

        if (data.wishlists.length > 0) {
            data.wishlists.forEach((item) => {
                wishlist.innerHTML += `
                <tr>
                <td class="col-md-2"><img
                        src="/storage/${
                            item.product.product_thumbnail
                        }" alt="imga">
                </td>
                <td class="col-md-7">
                    <div class="product-name"><a
                            href="#">${
                                wishlist.dataset.language === "bangla"
                                    ? item.product.product_name_bn
                                    : item.product.product_name_en
                            }</a>
                    </div>

        
                            <span class="price">
                                ${
                                    item.product.discount_price
                                        ? Math.round(
                                              item.product.selling_price -
                                                  item.product.selling_price *
                                                      (item.product
                                                          .discount_price /
                                                          100)
                                          )
                                        : item.product.selling_price
                                }
                            </span>
                        
                 
                </td>
                <td class="col-md-2">
                    <button id="productPreviewBtn" class="btn btn-primary icon" title="Add to Cart"
                        type="button" data-toggle="modal" data-target="#productModal"
                        data-product-id = "${item.product_id}"
                        data-language = "${wishlist.dataset.language}">
                        <i class="fa fa-shopping-cart"></i> </button>
                </td>
                <td class="col-md-1 close-btn">
                    <button class="btn btn-danger" id="wishlistRemoveBtn" onclick="wishlistRemove(${
                        item.product_id
                    })" class=""><i class="fa fa-times"></i></button>
                </td>
            </tr>

                `;
            });
        } else {
            wishlist.innerHTML = `
            <h3 class = 'text-info'>You don't have any wishlist</h>

            `;
        }
        productPreview();
    } catch (error) {
        console.log(error);
    }
}

async function cartDcrement(id) {
    try {
        const response = await fetch("/cart/" + id + "?type=decrement");
        if (response.ok) {
            getCart();
            loadMiniCart();
            calculateCoupon();
        }
    } catch (error) {
        console.log(error);
    }
}

async function cartIncrement(id) {
    try {
        const response = await fetch("/cart/" + id + "?type=increment");
        if (response.ok) {
            getCart();
            loadMiniCart();
            calculateCoupon();
        }
    } catch (error) {
        console.log(error);
    }
}

async function getCart() {
    const cart = document.getElementById("cartPage");
    try {
        const response = await fetch("/get/cart");
        const data = await response.json();
        cart.innerHTML = "";
        if (data) {
            for (let item in data.carts) {
                let contents = data.carts[item];
                cart.innerHTML += `
            <tr>
                <td class="col-md-2"><img
                        src="/storage/${contents.options.image}" alt="${
                    contents.name
                }" style="width:90px;height:90px">
                </td>
                <td class="col-md-2">
                    <div class="product-name"><a
                            href="#">${contents.name}</a>
                    </div>                                     
                </td>

                <td class="col-md-2">
                    <strong>${
                        contents.options.color
                    }</strong>                       
                </td>

                <td class="col-md-2">
                    <strong>${
                        contents.options.size ? contents.options.size : "...."
                    }</strong>                       
                </td>

                <td class="col-md-2">
                <button data-cart-id = "${
                    contents.rowId
                }" id="decrementBtn" class="btn btn-danger btn-sm" ${
                    contents.qty <= 1 ? "disabled" : ""
                }>-</button>                      
                <input type="text" value="${
                    contents.qty
                }" min="1" max="100" style="width:25px">
                <button data-cart-id = "${
                    contents.rowId
                }" id="incrementBtn"  class="btn btn-success btn-sm">+</button>
                 </td>

                 <td class="col-md-2">
                    <strong>৳ ${
                        contents.subtotal
                    }</strong>                       
                </td>
                
                <td class="col-md-1 close-btn">
                    <button id="cartRemoveBtn" class="btn btn-danger" data-cart-id = "${
                        contents.rowId
                    }"  style="width:24px;height:26px;"><i class="fa fa-times" style="display: flex;
                    align-items: center;
                    justify-content: center;"></i></button>
                </td>
            </tr>

                `;
            }
            document.querySelectorAll("#cartRemoveBtn").forEach((cart) => {
                cart.addEventListener("click", () =>
                    removeMiniCartItem(cart.dataset.cartId)
                );
            });

            document.querySelectorAll("#decrementBtn").forEach((cart) => {
                cart.addEventListener("click", () =>
                    cartDcrement(cart.dataset.cartId)
                );
            });

            document.querySelectorAll("#incrementBtn").forEach((cart) => {
                cart.addEventListener("click", () =>
                    cartIncrement(cart.dataset.cartId)
                );
            });
        } else {
            cart.innerHTML = `
            <h3 class = 'text-info'>You don't have any wishlist</h>

            `;
        }
    } catch (error) {
        console.log(error);
    }
}

async function wishlistRemove(proId) {
    try {
        const response = await fetch("/user/remove/wishlist/" + proId);
        // const data = await response.json();
        if (response.ok) {
            getWishList();
        }
    } catch (error) {
        console.log(error);
    }
}

async function applyCoupon() {
    document.getElementById("couponError").style.display = "none";
    if (couponInput.value === "") {
        document.getElementById("couponError").style.display = "inline";
        return;
    }
    const coupon = couponInput.value;
    couponInput.value = "";
    try {
        const response = await fetch("/coupon-apply", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ coupon }),
        });
        const data = await response.json();
        if (response.ok) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
            });
            if (!data.error) {
                document.getElementById("couponForm").style.display = "none";
                calculateCoupon();
                Toast.fire({
                    icon: "success",
                    title: data.success,
                });
            } else {
                document.getElementById("couponError").style.display = "inline";
                document.getElementById("couponError").innerHTML =
                    "Please Enter a Valid Coupon";

                Toast.fire({
                    icon: "error",
                    title: data.error,
                });
            }
            // End Message
        }
    } catch (error) {
        console.log(error);
    }
}

async function calculateCoupon() {
    document.getElementById("applyCoupon").innerHTML = "";

    try {
        const response = await fetch("/coupon/calculation");
        const data = await response.json();
        if (response.ok) {
            if (data.total) {
                document
                    .getElementById("checkoutBtn")
                    .removeAttribute("disabled");
                if (+data.total === 0) {
                    document
                        .getElementById("checkoutBtn")
                        .setAttribute("disabled", "disabled");
                }
                document.getElementById("couponForm").style.display = "block";
                document.getElementById("applyCoupon").innerHTML = `
                        <tr>
                            <th>
                                <div class="cart-sub-total">
                                    Subtotal<span class="inner-left-md">৳ ${data.total}</span>
                                </div>
                                <div class="cart-grand-total">
                                    Grand Total<span class="inner-left-md">৳ ${data.total}</span>
                                </div>
                            </th>
                        </tr>
                `;
            } else {
                document.getElementById("couponForm").style.display = "none";
                document.getElementById("applyCoupon").innerHTML = `

                <tr>
                    <th>
                    <button type='submit' onclick="couponRemove()" class='btn btn-info btn-sm'>Remove Coupon</button
                    </th>
                </tr>

                <tr>
                <th>

                   <div class="cart-sub-total">
                        Coupon<span class="inner-left-md"> ${data.coupon_name}</span>
                        
                   </div>

                    <div class="cart-sub-total">
                        Subtotal<span class="inner-left-md">৳ ${data.subTotal}</span>
                    </div>

                    <div class="cart-sub-total">
                    Discount Amount<span class="inner-left-md">৳ ${data.discount_amount}</span>
                </div>

                    <div class="cart-grand-total">
                        Grand Total<span class="inner-left-md">৳ ${data.total_amount}</span>
                    </div>
                </th>
            </tr>  
                `;
            }
        }
    } catch (error) {
        console.log(error);
    }
}

async function couponRemove() {
    try {
        const response = await fetch("/coupon/remove");
        const data = await response.json();
        if (response.ok) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
            });

            Toast.fire({
                icon: "success",
                title: data.success,
            });
            document.getElementById("couponForm").style.display = "block";
            calculateCoupon();
        }
    } catch (error) {
        console.log(error);
    }
}

async function getDistricts(e) {
    if (e && !e.target.value) {
        document.querySelector("#selectDistrict").innerHTML = "";
    }
    const divisonId = e.target.value;
    try {
        const response = await fetch("/shipping/get/district/" + divisonId);
        const data = await response.json();

        document.querySelector("#selectDistrict").innerHTML = "";

        data.districts.forEach((district) => {
            if (document.querySelector("#selectDistrict").dataset.need) {
                document.querySelector("#selectDistrict").innerHTML += `
            <option value="${district.id}" ${
                    district.id ===
                    +document.querySelector("#selectDistrict").dataset
                        .stateDistrictId
                        ? "selected"
                        : ""
                } >${district.district_name}</option> 
            `;
            }
            document.querySelector("#selectDistrict").innerHTML += `
            <option value="${district.id}" >${district.district_name}</option>
            `;
        });
        document.querySelector("#selectDistrict").value &&
            getState(document.querySelector("#selectDistrict").value);
    } catch (error) {
        console.log(error);
    }
}

async function getState(divisonId) {
    if (!divisonId) {
        document.querySelector("#selectState").innerHTML = "";
    }
    const stateId = divisonId;
    try {
        const response = await fetch("/shipping/get/state/" + stateId);
        const data = await response.json();
        document.querySelector("#selectState").innerHTML = "";

        if (data.states.length > 0) {
            data.states.forEach((state) => {
                document.querySelector("#selectState").innerHTML += `
            <option value="${state.id}" >${state.state_name}</option> 
            `;
            });
        } else {
            document.querySelector("#selectState").innerHTML += `
        <option value = "">No state found</option> 
        `;
        }
    } catch (error) {
        console.log(error);
    }
}

async function getStripForm() {
    try {
        const response = await fetch("/user/stripe/key");
        const { stripe_key, stripeData } = await response.json();
        stripe = Stripe(stripe_key);
        const appearance = {
            theme: "stripe",

            variables: {
                colorPrimary: "#0570de",
                colorBackground: "#ffffff",
                colorText: "#30313d",
                colorDanger: "#df1b41",
                fontFamily: "Ideal Sans, system-ui, sans-serif",
                spacingUnit: "2px",
                borderRadius: "4px",
                // See all possible variables below
            },
        };
        const clientSecret = stripeData.client_secret;
        stripeElements = stripe.elements({ clientSecret, appearance });
        const paymentElement = stripeElements.create("payment");
        paymentElement.mount("#payment-element");
    } catch (error) {
        console.log(error);
    }
}

async function stripeSubmitHandler(e) {
    e.preventDefault();
    const { paymentIntent } = await stripe.confirmPayment({
        //`Elements` instance that was used to create the Payment Element
        elements: stripeElements,

        confirmParams: {
            return_url: "https://example.com/order/123/complete",
        },

        redirect: "if_required",
    });

    if (paymentIntent) {
        try {
            const name = document.getElementById("shipName").value;
            const email = document.getElementById("shipEmail").value;
            const phone = document.getElementById("shipPhone").value;
            const postCode = document.getElementById("shipPostCode").value;
            const divisonId = document.getElementById("shipDivisonCode").value;
            const districtId =
                document.getElementById("shipDistrictCode").value;
            const stateId = document.getElementById("shipStateCode").value;
            const note = document.getElementById("shipNotes").value;
            const paymentIntentId = paymentIntent.id;

            const response = await fetch("/user/stripe/order", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    name,
                    email,
                    phone,
                    postCode,
                    divisonId,
                    districtId,
                    stateId,
                    note,
                    paymentIntentId,
                }),
            });
            const data = await response.json();

            if (data.success) {
                // const Toast = Swal.mixin({
                //     toast: true,
                //     showConfirmButton: false,
                //     timer: 10000,
                // });

                Swal.fire({
                    title: "Order is Sucessfull",
                    width: 600,
                    html: "Wait For Redirection.",
                    timer: 6000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    willClose: () => {
                        window.location.href = "/dashboard";
                    },
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer");
                    }
                });
            }
        } catch (error) {
            console.log(error);
        }
    }
}

const couponInput = document.getElementById("couponInput");
const couponBtn = document.getElementById("couponBtn");

//Mini Cart Functionality
loadMiniCart();

// load wishlist items
document.getElementById("wishlist") && getWishList();

//load cart items
document.getElementById("cartPage") && getCart();

document.getElementById("applyCoupon") && calculateCoupon();

//------------------------Stripe Part------------------------//

var stripe;
var stripeElements;
const form = document.getElementById("payment-form");

form && getStripForm();

form && form.addEventListener("submit", (e) => stripeSubmitHandler(e));

//-----------------------End Stripe Part----------------------//

window.addEventListener("load", async () => {
    productPreview();

    document
        .querySelectorAll("#addToWishListBtn")
        .forEach((element) =>
            element.addEventListener("click", () =>
                addToWishList(element.dataset.productId)
            )
        );

    couponBtn && couponBtn.addEventListener("click", () => applyCoupon());
    document.querySelector("#selectDivison") &&
        document
            .querySelector("#selectDivison")
            .addEventListener("change", (e) => getDistricts(e));

    document.querySelector("#selectDistrict") &&
        document
            .querySelector("#selectDistrict")
            .addEventListener("change", (e) => getState(e.target.value));
});
