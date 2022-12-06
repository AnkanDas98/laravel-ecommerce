// For Admin

const getDistricts = async (id = null, e = null) => {
    if (!e && !id) {
        document.querySelector("#selectDistrict").innerHTML = "";
    }
    if (e && !e.target.value) {
        document.querySelector("#selectDistrict").innerHTML = "";
    }
    const divisonId = e ? e.target.value : id;
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
            } else {
                document.querySelector("#selectDistrict").innerHTML += `
            <option value="${district.id}" >${district.district_name}</option> 
            `;
            }
        });
    } catch (error) {
        console.log(error);
    }
};

window.addEventListener("load", () => {
    // For Single Image
    const image_input = document.querySelector("#image");

    if (image_input) {
        image_input.addEventListener("change", function () {
            const reader = new FileReader();
            reader.addEventListener("load", () => {
                const uploadImage = reader.result;

                document.querySelector("#showImage").style.display === "none"
                    ? (document.querySelector("#showImage").style.display =
                          "block")
                    : "";

                document
                    .querySelector("#showImage")
                    .setAttribute("src", uploadImage);
                if (document.querySelector("#image_thumbnail_lebel")) {
                    document.querySelector(
                        "#image_thumbnail_lebel"
                    ).style.display = "none";
                    document.querySelector(
                        "#image_thumbnail_button"
                    ).style.display = "block";
                }
            });
            reader.readAsDataURL(this.files[0]);
        });
    }

    // For Multi Image
    const multiImageInput = document.querySelector("#multiImage");
    if (multiImageInput) {
        multiImageInput.addEventListener("change", function (e) {
            // console.log(Object.values(e.target.files));
            const data = Object.values(e.target.files);
            data.forEach((item) => {
                const reader = new FileReader();
                reader.addEventListener("load", (e) => {
                    const uploadImage = e.target;
                    console.log(uploadImage);
                    document.querySelector(
                        "#showMultiImage"
                    ).innerHTML += `<img 
                    src="${uploadImage.result}" title="${uploadImage.name}"
                    alt="No photo available image" class="mt-3 mr-2 img-thumbnail"
                    style="width: 120px; height: 120px;">`;
                });
                reader.readAsDataURL(item);
            });
        });
    }

    // const multiImageInput = document.querySelector("#multiImage");
    // if (multiImageInput) {
    //     multiImageInput.addEventListener("change", function () {
    //         const reader = new FileReader();
    //         reader.addEventListener("load", () => {
    //             const uploadImage = reader.result;
    //             document.querySelector("#showMultiImage").style.display = "block";
    //             document
    //                 .querySelector("#showMultiImage")
    //                 .setAttribute("src", uploadImage);
    //         });
    //         reader.readAsDataURL(this.files[0]);
    //     });
    // }

    // Sweet Alert
    const forms = document.querySelectorAll("#deleteForm");
    const deletBtn = document.querySelectorAll(".deleteBtn");

    forms.forEach((form) => {
        form.lastElementChild.addEventListener("click", (e) => {
            e.preventDefault();
            swal.fire({
                title: "Are you sure?",
                text: "Delete This Data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    swal.fire("Deleted Succesfully!");
                    form.submit();
                } else {
                    swal.fire("Your File is safe!");
                }
            });
        });
    });

    // Get Sub Category based on Category
    const category = document.querySelector("#category");
    const subCategory = document.querySelector("#sub_category");
    const subsubcategory = document.querySelector("#subsubcategory");

    const getSubSubCategory = async function (
        subCategoryvalue = null,
        e = null
    ) {
        const subCategoryId = e ? e.target.value : subCategoryvalue;
        if (subCategoryId) {
            try {
                const response = await fetch(
                    "/product/subsubCategory/fetch/" + subCategoryId
                );
                const data = await response.json();

                if (data.length > 0) {
                    subsubcategory.innerHTML = "";
                    data.forEach((item) => {
                        if (category.dataset.need) {
                            subsubcategory.innerHTML += `<option value="${
                                item.id
                            }" ${
                                item.id ===
                                +subsubcategory.dataset.productsubsubid
                                    ? "selected"
                                    : ""
                            }>${item.sub_sub_category_name_eng}</option>`;
                        } else {
                            subsubcategory.innerHTML += `<option value="${item.id}" >${item.sub_sub_category_name_eng}</option>`;
                        }
                    });
                } else {
                    subsubcategory.innerHTML = `<option value="" >No Sub Subcategory Found</option>`;
                }
            } catch (error) {
                console.log(error);
            }
        } else {
            alert("danger");
        }
    };

    const categoryChange = async function (categoryvalue = null, e = null) {
        const categoryId = e ? e.target.value : categoryvalue;

        if (categoryId) {
            try {
                const response = await fetch(
                    "/category/subCategory/fetch/" + categoryId
                );
                const data = await response.json();

                if (data.length > 0) {
                    subCategory.innerHTML = "";
                    data.forEach((item) => {
                        if (category.dataset.need) {
                            subCategory.innerHTML += `<option value="${
                                item.id
                            }" ${
                                item.id ===
                                    +subCategory.dataset.subsubcategoryid ||
                                item.id === +subCategory.dataset.productsubcatid
                                    ? "selected"
                                    : ""
                            }>${item.sub_category_name_eng}</option>`;
                        } else {
                            subCategory.innerHTML += `<option value="${item.id}" >${item.sub_category_name_eng}</option>`;
                        }
                    });
                    subsubcategory &&
                        subCategory.value &&
                        getSubSubCategory(subCategory.value, "");
                } else {
                    subCategory.innerHTML += `<option value="" >No Sub Category Found!</option>`;
                }
            } catch (error) {
                console.log(error);
            }
        } else {
            alert("danger");
        }
    };

    category && category.value && categoryChange(category.value, "");

    category &&
        category.addEventListener("change", (e) => categoryChange("", e));

    //add produts

    // subCategory.value && getSubSubCategory(subCategory.value, "");
    subCategory &&
        subCategory.addEventListener("change", (e) => getSubSubCategory("", e));

    // get districts

    document.querySelector("#selectDivison") &&
        document.querySelector("#selectDivison").value &&
        getDistricts(document.querySelector("#selectDivison").value, "");

    document
        .querySelector("#selectDivison")
        .addEventListener("change", (e) => getDistricts("", e));
    document.querySelector("#selectDivison") &&
        document
            .querySelector("#selectDivison")
            .addEventListener("change", (e) => getDistricts("", e));

    //Add multiImage
    document.querySelector("#add_image") &&
        document
            .querySelector("#add_image")
            .addEventListener("change", function () {
                this.form.submit();
            });
});
