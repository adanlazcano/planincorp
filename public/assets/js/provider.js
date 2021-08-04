import GetURL from './handlers/GetURL.js';
import { alertModalPlanincorp, modalTitle } from './handlers/Elements.js';
import Validation from './handlers/Validation.js';
import { Create, Delete } from './handlers/Crud.js';


// LOCAL CONSTANTS
const CONTROLLER = 'provider';
const METHOD_CREATE = 'create';
const METHOD_DELETE = 'delete';
const provTitleIcon = '<i class="fas fa-address-card"></i>';
const provNombre = document.getElementById('provNombre');
const $provTable = $('#provTable');
const $provAddModal = $('#provAddModal');
const $provDeleteModal = $('#provDeleteModal');
const provAddForm = document.querySelector('.provAddForm');
const provValidate = provAddForm.querySelectorAll('.formValidate');
const provDeleteId = document.getElementById('provDeleteId');
const provDeleteBtn = document.getElementById('provDeleteBtn');

let objProv = {};
let objDeleteProv = {};

// TABLE EVENTS
window.operateEvents = {
    'click .provUpdateIcon': (e, value, row, _) => {
        drawProv(row);

    },
    'click .provDeleteIcon': function(e, value, row, _) {
        drawProvDeleteModal(row.provId, row.provNombre);
    }
}

//DRAW BUTTONS ON TABLE
const operateFormatter = _ => {
    return [
        '<i title="Actualizar" class="fas fa-edit updateIcon provUpdateIcon"></i>&nbsp;&nbsp;&nbsp;&nbsp;',
        '<i title="Eliminar" class="fas fa-trash deleteIcon provDeleteIcon"></i>',

    ].join('');
}

// PROVIDERS TABLE
$provTable.bootstrapTable('destroy');
$provTable.bootstrapTable({

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

            field: "provId",
            title: "Id"
        },

        {
            field: "provNombre",
            title: "Nombre"
        },
        {
            field: "provDescripcion",
            title: "Descripción"
        },
        {
            field: "provDireccion",
            title: "Dirección"
        },
        {
            field: "provTelefono",
            title: "Teléfono"
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


// DRAW PROVIDER
const drawProv = data => {

    objProv = data;

    $provAddModal.modal('show');
}

// CREATE MODAL EVENTS
$provAddModal.on('shown.bs.modal', _ => {

    provNombre.focus();

    objProv && Object.keys(objProv).filter(item => item !== 'provId' && item !== 'createdAt').map((item) => {

        document.getElementById(item).value = objProv[item];
    })

    const textTitle = objProv.provId ? "Actualizar" : "Agregar";

    modalTitle.innerHTML = `${provTitleIcon} ${textTitle}`;

});

$provAddModal.on('hidden.bs.modal', _ => {

    objProv = {};
    provAddForm.classList.remove('was-validated');
    provAddForm.reset();
    alertModalPlanincorp.classList.remove('show');
    alertModalPlanincorp.innerHTML = '';
});

/* END CREATE MODAL EVENTS */

// PROVIDER CREATE
provAddForm.addEventListener('submit', e => {

    e.preventDefault();

    e.target.classList.remove('was-validated');

    Validation(provValidate, e.target);

    const idProv = objProv.provId;
    const compareField = objProv.provNombre;

    !e.target.classList.contains('was-validated') && Create(CONTROLLER, METHOD_CREATE, idProv, compareField, e.target, $provAddModal, $provTable);

});

// DRAW DELETE PROVIDER MODAL
const drawProvDeleteModal = (id, name) => {

    objDeleteProv = { id, name };
    $provDeleteModal.modal('show');
}

// DELETE MODAL EVENTS
$provDeleteModal.on('shown.bs.modal', _ => {

    provDeleteId.innerText = objDeleteProv.name;

});

$provDeleteModal.on('hidden.bs.modal', _ => {

    provDeleteId.innerText = '';
    objDeleteProv = {};
});

// END DELETE MODAL EVENTS

//PROVIDER DELETE
provDeleteBtn.addEventListener('click', _ => {

    const { id, name } = objDeleteProv;
    Delete(CONTROLLER, METHOD_DELETE, id, name, $provDeleteModal, $provTable);
});