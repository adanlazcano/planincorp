import GetURL from './GetURL.js';
import { alertPlanincorp, alertModalPlanincorp, btnModal } from './Elements.js';

//LOCAL VARIABLES
let timeOut = '';
let showAlert = '';

// SET PLANINCORP ALERT (DRAW CLASS & ICON), SHOW ALERT WITH TIMEOUT, REFRESH TABLE & HIDE MODAL
const setResponse = (showAlert, message, status, table, modalId = '') => {

    clearTimeout(timeOut);

    showAlert.classList.add('show');
    showAlert.innerHTML = message;

    status && $(modalId).modal('hide');

    table.bootstrapTable('refresh', { silent: true });

    window.scroll(0, 0);

    btnModal.removeAttribute('disabled');

    timeOut = setTimeout(_ => {

        showAlert.classList.remove('show');
        showAlert.innerHTML = '';

    }, 6000);

}

// CREATE & UPDATE
export const Create = (CONTROLLER, METHOD, id = '', compareField = '', formClass, modalId = '', table) => {

    const formData = new FormData(formClass);

    formData.append('id', id);
    formData.append('compareField', compareField);

    const values = Object.fromEntries(formData.entries());


    $.ajax({
        url: GetURL(CONTROLLER, METHOD),
        method: 'POST',
        data: JSON.stringify(values),
        beforeSend: _ => {
            btnModal.setAttribute('disabled', true);
            btnModal.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardando';
        },
        success: resp => {

            const { message, status } = JSON.parse(resp);

            showAlert = status ? alertPlanincorp : alertModalPlanincorp;

            status && formClass.reset();

            btnModal.innerHTML = 'Guardar';

            setResponse(showAlert, message, status, table, modalId);
        },
    });
}

// DELETE
export const Delete = (CONTROLLER, METHOD, id, name, modalId = '', table) => {

    $.ajax({
        url: GetURL(CONTROLLER, METHOD),
        method: 'POST',
        data: { id },
        beforeSend: _ => {
            btnModal.setAttribute('disabled', true);
        },
        success: resp => {

            let { message, status } = JSON.parse(resp);

            message = `<i class='fas fa-check-circle'></i><b> ${name} </b> ${message}`
            showAlert = alertPlanincorp;

            setResponse(showAlert, message, status, table, modalId);
        },
    });
}

//CREATE PURCHASE

export const CreateBuy = (CONTROLLER, METHOD, obj, modal, table) => {


    btnModal.setAttribute('disabled', true);
    btnModal.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardando';

    $.ajax({
        url: GetURL(CONTROLLER, METHOD),
        method: 'POST',
        data: JSON.stringify(obj),
        success: resp => {
            let { message, status } = JSON.parse(resp);

            message = `<i class='fas fa-check-circle'></i> ${message}`
            showAlert = alertPlanincorp;

            setTimeout(_ => {
                btnModal.innerHTML = 'Comprar';
                setResponse(showAlert, message, status, table, modal);
            }, 1500);

        },
    });
}

export const CreateDelivery = (CONTROLLER, METHOD, id, nameStaff, table) => {

    $.ajax({
        url: GetURL(CONTROLLER, METHOD),
        method: "POST",
        data: { id, nameStaff },
        success: resp => {

            let { message, status } = JSON.parse(resp);

            message = `<i class='fas fa-check-circle'></i> ${message}`
            showAlert = alertPlanincorp;


            setResponse(showAlert, message, status, table, 0);

        },
    })

}