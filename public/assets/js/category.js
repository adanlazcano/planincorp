import GetURL from './handlers/GetURL.js';
import { alertModalPlanincorp, modalTitle } from './handlers/Elements.js';
import Validation from './handlers/Validation.js';
import { Create, Delete } from './handlers/Crud.js';


// LOCAL CONSTANTS
const CONTROLLER = 'category';
const METHOD_CREATE = 'create';
const METHOD_DELETE = 'delete';
const catTitleIcon = '<i class="fas fa-tags"></i>';
const catNombre = document.getElementById('catNombre');
const $catTable = $('#catTable');
const $catAddModal = $('#catAddModal');
const $catDeleteModal = $('#catDeleteModal');
const catAddForm = document.querySelector('.catAddForm');
const catValidate = catAddForm.querySelectorAll('.formValidate');
const catDeleteId = document.getElementById('catDeleteId');
const catDeleteBtn = document.getElementById('catDeleteBtn');

let objCat = {};
let objDeleteCat = {};

// TABLE EVENTS
window.operateEvents = {
    'click .catUpdateIcon': (e, value, row, _) => {
        drawCat(row);

    },
    'click .catDeleteIcon': function(e, value, row, _) {
        drawCatDeleteModal(row.catId, row.catNombre);
    }
}

//DRAW BUTTONS ON TABLE
const operateFormatter = _ => {
    return [
        '<i title="Actualizar" class="fas fa-edit updateIcon catUpdateIcon"></i>&nbsp;&nbsp;&nbsp;&nbsp;',
        '<i title="Eliminar" class="fas fa-trash deleteIcon catDeleteIcon"></i>',

    ].join('');
}

// STAFF TABLE
$catTable.bootstrapTable('destroy');
$catTable.bootstrapTable({

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

            field: "catId",
            title: "Id"
        },

        {
            field: "catNombre",
            title: "Nombre"
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


// DRAW CATEGORIES
const drawCat = data => {

    objCat = data;

    $catAddModal.modal('show');
}

// CREATE MODAL EVENTS
$catAddModal.on('shown.bs.modal', _ => {

    catNombre.focus();

    objCat && Object.keys(objCat).filter(item => item !== 'catId' && item !== 'createdAt').map((item) => {

        document.getElementById(item).value = objCat[item];
    })

    const textTitle = objCat.catId ? "Actualizar" : "Agregar";

    modalTitle.innerHTML = `${catTitleIcon} ${textTitle}`;

});

$catAddModal.on('hidden.bs.modal', _ => {

    objCat = {};
    catAddForm.classList.remove('was-validated');
    catAddForm.reset();
    alertModalPlanincorp.classList.remove('show');
    alertModalPlanincorp.innerHTML = '';
});

/* END CREATE MODAL EVENTS */

// STAFF CREATE
catAddForm.addEventListener('submit', e => {

    e.preventDefault();

    e.target.classList.remove('was-validated');

    Validation(catValidate, e.target);

    const idCat = objCat.catId;
    const compareField = objCat.catNombre;

    !e.target.classList.contains('was-validated') && Create(CONTROLLER, METHOD_CREATE, idCat, compareField, e.target, $catAddModal, $catTable);

});

// DRAW DELETE STAFF MODAL
const drawCatDeleteModal = (id, name) => {

    objDeleteCat = { id, name };
    $catDeleteModal.modal('show');
}

// DELETE MODAL EVENTS
$catDeleteModal.on('shown.bs.modal', _ => {

    catDeleteId.innerText = objDeleteCat.name;

});

$catDeleteModal.on('hidden.bs.modal', _ => {

    catDeleteId.innerText = '';
    objDeleteCat = {};
});

// END DELETE MODAL EVENTS

//STAFF DELETE
catDeleteBtn.addEventListener('click', _ => {

    const { id, name } = objDeleteCat;
    Delete(CONTROLLER, METHOD_DELETE, id, name, $catDeleteModal, $catTable);
});