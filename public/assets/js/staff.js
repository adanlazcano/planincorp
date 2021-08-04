import GetURL from './handlers/GetURL.js';
import { alertModalPlanincorp, modalTitle } from './handlers/Elements.js';
import Validation from './handlers/Validation.js';
import { Create, Delete } from './handlers/Crud.js';


// LOCAL CONSTANTS
const CONTROLLER = 'staff';
const METHOD_CREATE = 'create';
const METHOD_DELETE = 'delete';
const staffTitleIcon = '<i class="fas fa-user"></i>';
const staffNombre = document.getElementById('staffNombre');
const $staffTable = $('#staffTable');
const $staffAddModal = $('#staffAddModal');
const $staffDeleteModal = $('#staffDeleteModal');
const staffArea = document.getElementById('staffArea');
const staffAddForm = document.querySelector('.staffAddForm');
const staffValidate = staffAddForm.querySelectorAll('.formValidate');
const staffDeleteId = document.getElementById('staffDeleteId');
const staffDeleteBtn = document.getElementById('staffDeleteBtn');

let objStaff = {};
let objDeleteStaff = {};

// TABLE EVENTS
window.operateEvents = {
    'click .staffUpdateIcon': (e, value, row, _) => {
        drawStaff(row);
    },
    'click .staffDeleteIcon': function(e, value, row, _) {
        drawStaffDeleteModal(row.staffId, row.nombreCompleto);
    }
}

//DRAW BUTTONS ON TABLE
const operateFormatter = _ => {
    return [
        '<i title="Actualizar" class="fas fa-edit updateIcon staffUpdateIcon"></i>&nbsp;&nbsp;&nbsp;&nbsp;',
        '<i title="Eliminar" class="fas fa-trash deleteIcon staffDeleteIcon"></i>',

    ].join('');
}

// STAFF TABLE
$staffTable.bootstrapTable('destroy');
$staffTable.bootstrapTable({

    url: GetURL(CONTROLLER, 'getAll'),
    method: 'GET',
    queryParams: function(p) {
        return {
            limit: p.limit,
            offset: p.offset,
            search: p.search,

        };
    },
    pageList: [10, 25, 50, 100, 200, 500, "Todo"],
    rowStyle: "rowStyle",

    columns: [{

            field: "staffId",
            title: "Id"
        },

        {
            field: "nombreCompleto",
            title: "Nombre"
        },

        {
            field: "staffMail",
            title: "Email"
        },

        {
            field: "staffPuesto",
            title: "Puesto"
        },

        {
            field: "nombreArea",
            title: "Área"
        },

        {
            field: "createdAt",
            title: "Fecha"
        },

        {
            field: 'operate',
            title: 'Acción',
            align: 'center',
            events: window.operateEvents,
            formatter: operateFormatter
        }
    ]
});

// FILL SELECT WITH AREA LIST
const getAreas = (idArea = '') => {

    staffArea.innerHTML = '<option value="">Selecciona...</option>';

    $.ajax({
        url: GetURL(CONTROLLER, 'getArea'),
        method: 'GET',
        dataType: 'json',
        success: resp => {

            resp.map(item => {

                const sel = item.areaId === idArea ? ' selected' : '';

                staffArea.innerHTML += `<option ${sel} value="${item.areaId}">${item.areaNombre}</option>`;
            })
        }
    })
}

// DRAW STAFF
const drawStaff = data => {

    objStaff = data;

    $staffAddModal.modal('show');
}

// CREATE MODAL EVENTS
$staffAddModal.on('shown.bs.modal', _ => {

    staffNombre.focus();

    const staffAreaOption = objStaff.staffArea;

    getAreas(staffAreaOption);

    objStaff && Object.keys(objStaff).filter(item => item !== 'createdAt' && item !== 'nombreCompleto' && item !== 'nombreArea' && item !== 'staffId').map((item) => {

        document.getElementById(item).value = objStaff[item];
    })

    const textTitle = objStaff.staffId ? "Actualizar" : "Agregar";

    modalTitle.innerHTML = `${staffTitleIcon} ${textTitle}`;

});

$staffAddModal.on('hidden.bs.modal', _ => {

    objStaff = {};
    staffAddForm.classList.remove('was-validated');
    staffArea.innerHTML = "";
    staffAddForm.reset();
    alertModalPlanincorp.classList.remove('show');
    alertModalPlanincorp.innerHTML = '';
});

/* END CREATE MODAL EVENTS */

// STAFF CREATE
staffAddForm.addEventListener('submit', e => {

    e.preventDefault();

    e.target.classList.remove('was-validated');

    Validation(staffValidate, e.target);

    const idStaff = objStaff.staffId;
    const compareField = objStaff.staffMail;

    !e.target.classList.contains('was-validated') && Create(CONTROLLER, METHOD_CREATE, idStaff, compareField, e.target, $staffAddModal, $staffTable);

});

// DRAW DELETE STAFF MODAL
const drawStaffDeleteModal = (id, name) => {

    objDeleteStaff = { id, name };
    $staffDeleteModal.modal('show');
}

// DELETE MODAL EVENTS
$staffDeleteModal.on('shown.bs.modal', _ => {

    staffDeleteId.innerText = objDeleteStaff.name;

});

$staffDeleteModal.on('hidden.bs.modal', _ => {

    staffDeleteId.innerText = '';
    objDeleteStaff = {};
});

// END DELETE MODAL EVENTS

//STAFF DELETE
staffDeleteBtn.addEventListener('click', _ => {

    const { id, name } = objDeleteStaff;
    Delete(CONTROLLER, METHOD_DELETE, id, name, $staffDeleteModal, $staffTable);
});