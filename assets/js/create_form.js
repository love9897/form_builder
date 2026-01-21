function validateForm() {
    const formName = document.getElementById("form_name").value.trim();
    const error = document.getElementById("nameError");

    // Reset error
    error.innerText = "";

    if (formName === "") {
        error.innerText = "Form name is required";
        return false;
    }

    if (formName.length < 3) {
        error.innerText = "Form name must be at least 3 characters";
        return false;
    }

    return true; 

}