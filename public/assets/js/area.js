import GetURL from './handlers/GetURL.js';
import { alertModalPlanincorp, modalTitle } from './handlers/Elements.js';
import Validation from './handlers/Validation.js';
import { Create, Delete } from './handlers/Crud.js';


// LOCAL CONSTANTS
const CONTROLLER = 'area';
const METHOD_CREATE = 'create';
const METHOD_DELETE = 'delete';
const areaTitleIcon = '<i class="fas fa-building"></i>';
const areaNombre = document.getElementById('areaNombre');
const $areaTable = $('#areaTable');
const $areaAddModal = $('#areaAddModal');
const $areaDeleteModal = $('#areaDeleteModal');
const areaAddForm = document.querySelector('.areaAddForm');
const areaValidate = areaAddForm.querySelectorAll('.formValidate');
const areaDeleteId = document.getElementById('areaDeleteId');
const areaDeleteBtn = document.getElementById('areaDeleteBtn');

let objArea = {};
let objDeleteArea = {};

// TABLE EVENTS
window.operateEvents = {
    'click .areaUpdateIcon': (e, value, row, _) => {
        drawArea(row);

    },
    'click .areaDeleteIcon': function(e, value, row, _) {
        drawAreaDeleteModal(row.areaId, row.areaNombre);
    }
}

//DRAW BUTTONS ON TABLE
const operateFormatter = _ => {
    return [
        '<i title="Actualizar" class="fas fa-edit updateIcon areaUpdateIcon"></i>&nbsp;&nbsp;&nbsp;&nbsp;',
        '<i title="Eliminar" class="fas fa-trash deleteIcon areaDeleteIcon"></i>',

    ].join('');
}

// AREA TABLE
$areaTable.bootstrapTable('destroy');
$areaTable.bootstrapTable({

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

            field: "areaId",
            title: "Id"
        },

        {
            field: "areaNombre",
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


// DRAW AREA
const drawArea = data => {

    objArea = data;

    $areaAddModal.modal('show');
}

// CREATE MODAL EVENTS
$areaAddModal.on('shown.bs.modal', _ => {

    areaNombre.focus();

    objArea && Object.keys(objArea).filter(item => item !== 'areaId' && item !== 'createdAt').map((item) => {

        document.getElementById(item).value = objArea[item];
    })

    const textTitle = objArea.areaId ? "Actualizar" : "Agregar";

    modalTitle.innerHTML = `${areaTitleIcon} ${textTitle}`;

});

$areaAddModal.on('hidden.bs.modal', _ => {

    objArea = {};
    areaAddForm.classList.remove('was-validated');
    areaAddForm.reset();
    alertModalPlanincorp.classList.remove('show');
    alertModalPlanincorp.innerHTML = '';
});

/* END CREATE MODAL EVENTS */

// AREA CREATE
areaAddForm.addEventListener('submit', e => {

    e.preventDefault();

    e.target.classList.remove('was-validated');

    Validation(areaValidate, e.target);

    const idArea = objArea.areaId;
    const compareField = objArea.areaNombre;

    !e.target.classList.contains('was-validated') && Create(CONTROLLER, METHOD_CREATE, idArea, compareField, e.target, $areaAddModal, $areaTable);

});

// DRAW DELETE AREA MODAL
const drawAreaDeleteModal = (id, name) => {

    objDeleteArea = { id, name };
    $areaDeleteModal.modal('show');
}

// DELETE MODAL EVENTS
$areaDeleteModal.on('shown.bs.modal', _ => {

    areaDeleteId.innerText = objDeleteArea.name;

});

$areaDeleteModal.on('hidden.bs.modal', _ => {

    areaDeleteId.innerText = '';
    objDeleteArea = {};
});

// END DELETE MODAL EVENTS

//AREA DELETE
areaDeleteBtn.addEventListener('click', _ => {

    const { id, name } = objDeleteArea;
    Delete(CONTROLLER, METHOD_DELETE, id, name, $areaDeleteModal, $areaTable);
});