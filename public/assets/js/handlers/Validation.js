const Validation = (classValidate, formValidate) => {

    classValidate.forEach(item => {

        if (!item.checkValidity()) {

            formValidate.classList.add('was-validated');
            return;
        }
    });
};

export default Validation;