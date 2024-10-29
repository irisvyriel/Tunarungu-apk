const ajaxCall = (url, method, data, successCallback, errorCallback) => {
    $.ajax({
        type: method,
        enctype: "multipart/form-data",
        url,
        cache: false,
        data,
        contentType: false,
        processData: false,
        headers: {
            Accept: "application/json",
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
        },
        dataType: "json",
        success: function (response) {
            successCallback(response);
        },
        error: function (error) {
            errorCallback(error);
        },
    });
};

const handleSuccess = (response, redirect = null) => {
    const showAlert = () => {
        Swal.fire({
            title: "Berhasil",
            icon: "success",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
        });
    };

    if (redirect) {
        Swal.fire({
            title: "Berhasil",
            icon: "success",
            text: response.message,
            timer: 2000,
            showConfirmButton: false,
        }).then(() => {
            window.location.href = redirect;
        });
    } else if (redirect === "no") {
        showAlert();
    }
};

const handleValidationErrors = (error, formId = null, fields = null) => {
    if (error.responseJSON && error.responseJSON.data && fields) {
        fields.forEach((field) => {
            const errorElement = $(`#${formId} #error${field}`);
            if (error.responseJSON.data[field]) {
                errorElement.html(error.responseJSON.data[field][0]);
            } else {
                errorElement.html("");
            }
        });
    } else {
        Swal.fire({
            title: "Gagal",
            icon: "error",
            text:
                error.responseJSON?.message ||
                "An error occurred. Please try again.",
            timer: 2000,
            showConfirmButton: false,
        });
    }
};

const handleSimpleError = (error) => {
    Swal.fire({
        title: "Gagal",
        icon: "error",
        text: error,
        timer: 2000,
        showConfirmButton: false,
    });
};

const setButtonLoadingState = (buttonSelector, isLoading, title = "Simpan") => {
    const buttonText = isLoading
        ? `<i class="fas fa-spinner fa-spin mr-1"></i> ${title}`
        : title;
    $(buttonSelector).prop("disabled", isLoading).html(buttonText);
};
