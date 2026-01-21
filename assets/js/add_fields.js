document.addEventListener("DOMContentLoaded", function () {

    const addBtn = document.getElementById("addFieldBtn");
    const wrapper = document.getElementById("fieldsWrapper");

    // ADD NEW FIELD
    addBtn.addEventListener("click", function () {
        const firstField = wrapper.querySelector(".field-row");
        const clone = firstField.cloneNode(true);

        // Clear values
        clone.querySelectorAll("input, textarea").forEach(el => el.value = "");
        clone.querySelectorAll("select").forEach(el => el.selectedIndex = 0);

        clone.querySelector(".option-box").style.display = "none";

        wrapper.appendChild(clone);
    });

    // REMOVE FIELD & TOGGLE OPTIONS
    wrapper.addEventListener("click", function (e) {

        // Remove field
        if (e.target.classList.contains("btn-remove")) {
            if (wrapper.querySelectorAll(".field-row").length > 1) {
                e.target.closest(".field-row").remove();
            }
        }

        // Toggle options box
        if (e.target.classList.contains("field-type")) {
            const fieldRow = e.target.closest(".field-row");
            const optionBox = fieldRow.querySelector(".option-box");

            if (["dropdown", "radio", "checkbox"].includes(e.target.value)) {
                optionBox.style.display = "block";
            } else {
                optionBox.style.display = "none";
            }
        }
    });

});

