import GetURL from './handlers/GetURL.js';
import { alertModalPlanincorp, modalTitle } from './handlers/Elements.js';
import Validation from './handlers/Validation.js';
import { Create, Delete } from './handlers/Crud.js';


// LOCAL CONSTANTS
const CONTROLLER = 'product';
const METHOD_CREATE = 'create';
const METHOD_DELETE = 'delete';
const prodTitleIcon = '<i class="fas fa-box"></i>';
const prodNombre = document.getElementById('prodNombre');
const $prodTable = $('#prodTable');
const $prodAddModal = $('#prodAddModal');
const $prodDeleteModal = $('#prodDeleteModal');
const prodAddForm = document.querySelector('.prodAddForm');
const prodCat = document.getElementById('prodCat');
const prodValidate = prodAddForm.querySelectorAll('.formValidate');
const prodDeleteId = document.getElementById('prodDeleteId');
const prodDeleteBtn = document.getElementById('prodDeleteBtn');

let objProd = {};
let objDeleteProd = {};

// TABLE EVENTS
window.operateEvents = {
    'click .prodUpdateIcon': (e, value, row, _) => {
        drawProd(row);

    },
    'click .prodDeleteIcon': function(e, value, row, _) {
        drawProdDeleteModal(row.prodId, row.prodNombre);
    }
}

//DRAW BUTTONS ON TABLE
const operateFormatter = _ => {
    return [
        '<i title="Actualizar" class="fas fa-edit updateIcon prodUpdateIcon"></i>&nbsp;&nbsp;&nbsp;&nbsp;',
        '<i title="Eliminar" class="fas fa-trash deleteIcon prodDeleteIcon"></i>',

    ].join('');
}

const coin = (e, value, row, _) => {

    return new Intl.NumberFormat("en-EN", { minimumFractionDigits: 2 }).format(value.prodPrecio);
}

// PRODUCTS TABLE
$prodTable.bootstrapTable('destroy');
$prodTable.bootstrapTable({

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

            field: "prodId",
            title: "Id"
        },

        {
            field: "prodNombre",
            title: "Nombre"
        },
        {
            field: "prodMarca",
            title: "Marca"
        },
        {
            field: "prodPrecio",
            title: "Precio",
            align: "right",
            formatter: coin
        },
        {
            field: "catNombre",
            title: "Categoría"
        },

        {
            field: "prodStock",
            title: "Stock",
            align: "center"

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

// FILL SELECT WITH CATEGORIES LIST
const getCategories = (idCategory = '') => {

    prodCat.innerHTML = '<option value="">Selecciona...</option>';

    $.ajax({
        url: GetURL(CONTROLLER, 'getCategories'),
        method: 'GET',
        dataType: 'json',
        success: resp => {

            resp.map(item => {

                const sel = item.catId === idCategory ? ' selected' : '';

                prodCat.innerHTML += `<option ${sel} value="${item.catId}">${item.catNombre}</option>`;
            })
        }
    })
}

// DRAW PRODUCT
const drawProd = data => {

    objProd = data;

    $prodAddModal.modal('show');
}

// CREATE MODAL EVENTS
$prodAddModal.on('shown.bs.modal', _ => {

    prodNombre.focus();

    const prodCatOption = objProd.prodCat;

    getCategories(prodCatOption);

    objProd && Object.keys(objProd).filter(item => item !== 'prodId' && item !== 'createdAt' && item != 'catNombre' && item != 'prodStock').map((item) => {

        document.getElementById(item).value = objProd[item];
    })

    const textTitle = objProd.prodId ? "Actualizar" : "Agregar";

    modalTitle.innerHTML = `${prodTitleIcon} ${textTitle}`;

});

$prodAddModal.on('hidden.bs.modal', _ => {

    objProd = {};
    prodAddForm.classList.remove('was-validated');
    prodAddForm.reset();
    alertModalPlanincorp.classList.remove('show');
    alertModalPlanincorp.innerHTML = '';
});

/* END CREATE MODAL EVENTS */

// PRODUCT CREATE
prodAddForm.addEventListener('submit', e => {

    e.preventDefault();

    e.target.classList.remove('was-validated');

    Validation(prodValidate, e.target);

    const idProd = objProd.prodId;
    const compareField = `${objProd.prodNombre} ${objProd.prodMarca}`;

    !e.target.classList.contains('was-validated') && Create(CONTROLLER, METHOD_CREATE, idProd, compareField, e.target, $prodAddModal, $prodTable);

});

// DRAW DELETE PRODUCT MODAL
const drawProdDeleteModal = (id, name) => {

    objDeleteProd = { id, name };
    $prodDeleteModal.modal('show');
}

// DELETE MODAL EVENTS
$prodDeleteModal.on('shown.bs.modal', _ => {

    prodDeleteId.innerText = objDeleteProd.name;

});

$prodDeleteModal.on('hidden.bs.modal', _ => {

    prodDeleteId.innerText = '';
    objDeleteProd = {};
});

// END DELETE MODAL EVENTS

//PRODUCT DELETE
prodDeleteBtn.addEventListener('click', _ => {

    const { id, name } = objDeleteProd;
    Delete(CONTROLLER, METHOD_DELETE, id, name, $prodDeleteModal, $prodTable);
});