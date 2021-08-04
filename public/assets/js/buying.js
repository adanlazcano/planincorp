import GetURL from './handlers/GetURL.js';
import Validation from './handlers/Validation.js';
import { alertModalPlanincorp, alertPlanincorp } from './handlers/Elements.js';
import { CreateBuy, CreateDelivery } from './handlers/Crud.js';
// LOCAL CONSTANTS
const CONTROLLER = 'buying';
const METHOD = 'createBuy';
const METHOD_DELIVERY = 'createDelivery';
const $buyTable = $('#buyTable');
const $buyAddModal = $('#buyAddModal');
const buyStaff = document.getElementById('buyStaff');
const buyProv = document.getElementById('buyProv');
const buyPayType = document.getElementById('buyPayType');
const buyProd = document.getElementById('buyProd');
const buyNewProv = document.querySelector('.buyNewProv');
const modalBuyNewProv = document.querySelector('.modalBuyNewProv');
const inputModalProvBuy = document.querySelector('.inputModalProvBuy');
const formModalBuyProv = document.getElementById('formModalBuyProv');
const buyNewProd = document.querySelector('.buyNewProd');
const modalBuyNewName = document.getElementById('modalBuyNewName');
const modalBuyNewProd = document.querySelector('.modalBuyNewProd');
const modalBuyNewProdAll = modalBuyNewProd.querySelectorAll('.formValidate');
const itemsBuy = document.getElementById('itemsBuy');
const tableBuyFooter = document.getElementById('tableBuyFooter');
const buyFooterTotalProducts = document.getElementById('buyFooterTotalProducts');
const buyFooterTotal = document.getElementById('buyFooterTotal');
const btnEmptyProducts = document.querySelector('.btnEmptyProducts');
const btnBuy = document.querySelector('.btnBuy');

const $buyDetailsModal = $("#buyDetailsModal");
const buyDetailsProduct = document.getElementById('buyDetailsProduct');
const $buyCancelModal = $("#buyCancelModal");
const buyDetailsTitleMin = document.getElementById('buyDetailsTitleMin');
const buyTotalProductsMin = document.getElementById('buyTotalProductsMin');
const buyAllTotalMin = document.getElementById('buyAllTotalMin');
const buyDetailsProductMin = document.getElementById('buyDetailsProductMin');

const buysTableMin = document.querySelector('.buysTableMin');

const buyDetailsTitle = document.getElementById('buyDetailsTitle');
const buyDetailsStaff = document.getElementById('buyDetailsStaff');
const buyDetailsArea = document.getElementById('buyDetailsArea');
const buyDetailsProv = document.getElementById('buyDetailsProv');
const buyDetailsPay = document.getElementById('buyDetailsPay');
const buyDetailsTotalProducts = document.getElementById('buyDetailsTotalProducts');
const buyDetailsAllTotal = document.getElementById('buyDetailsAllTotal');

const templateBuyPdf = document.querySelector('.templateBuyPdf');
const buyDetailsProductPdf = document.getElementById('buyDetailsProductPdf')

let timeAlert = '';


/**** CREATE BUY ****/

let objBuy = {};
let arrBuy = [];

let objDetails = {};

objBuy["tipoPago"] = 'EFECTIVO';

//REMOVE NEW PROVIDER MODAL FROM WINDOW.ONCLICK
addEventListener('click', _ => {
    modalBuyNewProv.style.opacity = "0";

    modalBuyNewProd.style.display = 'none';

});

// CLEAN ALERT MODAL 

const cleanAlert = _ => {
    alertModalPlanincorp.classList.remove('show');
    alertModalPlanincorp.innerHTML = ``;

};

// SET SELECT2
const setSelect2 = _ => {

    $('.buyList').select2({
        placeholder: "Selecciona...",

    });

    $(document).on('select2:open', (e) => {
        const selectId = e.target.id;

        $(".select2-search__field[aria-controls='select2-" + selectId + "-results']").each((index, value) => {

            value.focus()
        });
    });
};

// TABLE EVENTS
window.operateEvents = {
    'click .buyDetailsIcon': (e, value, row, _) => {
        fetchDetails(row.buyId, row.buyNomStaff, row.buyNomProv, row.buyArea, row.buyPayType, row.buyUnits, row.buyTotal, row.createdAt, $buyDetailsModal, true, false);

    },
    'click .buyDownloadIcon': function(e, value, row, _) {
        fetchDetails(row.buyId, row.buyNomStaff, row.buyNomProv, row.buyArea, row.buyPayType, row.buyUnits, row.buyTotal, row.createdAt, 0, false, true);
    },
    'click .buyDeliveryIcon': function(e, value, row, _) {
        buyDelivery(row.buyId, row.buyNomStaff);
    },
    'click .buyDeleteIcon': function(e, value, row, _) {
        fetchDetails(row.buyId, row.buyNomStaff, row.buyNomProv, row.buyArea, row.buyPayType, row.buyUnits, row.buyTotal, row.createdAt, $buyCancelModal, true, false);
    }
};

//DRAW BUTTONS ON TABLE
const operateFormatter = (e, value, row, _) => {

    const actions = [
        '<i title="Detalles" class="fas fa-list-ul updateIcon buyDetailsIcon"></i>',
        '<i title="Descargar Formato de Compra" class="fas fa-file-pdf downloadIcon buyDownloadIcon"></i>',
        '<i title="Cancelar" class="fas fa-window-close deleteIcon buyDeleteIcon"></i>'
    ];

    if (value.buyStatus === 'P') {

        actions.splice(2, 0, '<i title="Entregar" class="fas fa-truck deliveryIcon buyDeliveryIcon"></i>')
    }

    if (value.buyStatus === 'E') {

        actions.splice(2, 1);
    }

    return actions.join('\xa0\xa0\xa0');
};

const getStatus = (e, value, row, _) => {

    let status = '';

    switch (value.buyStatus) {
        case 'E':
            status = `<span class="badge badge-success">Entregada</span>`;
            break;
        case 'C':
            status = `<span class="badge badge-danger">Cancelada</span>`;
            break;
        case 'P':
            status = `<span class="badge badge-warning">Por Entregar</span>`;
            break;
        default:
            status = '';
    }

    return status;
};

const coin = (e, value, row, _) => {

    return new Intl.NumberFormat("en-EN", { minimumFractionDigits: 2 }).format(value.buyTotal);
}

// BUY TABLE
$buyTable.bootstrapTable('destroy');
$buyTable.bootstrapTable({

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

            field: "buyId",
            title: "Id"
        },

        {
            field: "buyNomStaff",
            title: "Para"
        },
        {
            field: "buyArea",
            title: "Área"
        },
        {
            field: "buyTotal",
            title: "Total",
            align: "right",
            formatter: coin
        },
        {
            field: "buyPayType",
            title: "Tipo de Pago"
        },
        {
            field: "buyNomProv",
            title: "Proveedor"
        },

        {
            field: "createdAt",
            title: "Fecha"
        },

        {
            field: "buyStatus",
            title: "Status",
            align: "center",
            formatter: getStatus

        },

        {
            field: 'operate',
            title: 'Acción',
            align: "center",
            events: window.operateEvents,
            formatter: operateFormatter
        }
    ]
});


// FILL SELECT WITH STAFF LIST
const getStaff = _ => {

    buyStaff.innerHTML = '<option value="">Selecciona...</option>';

    $.ajax({
        url: GetURL(CONTROLLER, 'getStaff'),
        method: 'POST',
        dataType: 'json',
        success: resp => {

            resp.map(({ staffId, nombreCompleto }) => {

                buyStaff.innerHTML += `<option value="${staffId}">${nombreCompleto}</option>`;
            })
        }
    });
};

// FILL SELECT WITH PROVIDERS LIST
const getProviders = _ => {

    buyProv.innerHTML = '<option value="">Selecciona...</option>';

    $.ajax({
        url: GetURL(CONTROLLER, 'getProviders'),
        method: 'POST',
        dataType: 'json',
        success: resp => {

            resp.map(({ provId, provNombre }) => {

                buyProv.innerHTML += `<option value="${provId}">${provNombre}</option>`;


            })
        }
    });
};

// FILL SELECT WITH PRODUCTS LIST
const getProducts = _ => {

    buyProd.innerHTML = `<option value=""></option>`;

    $.ajax({
        url: GetURL(CONTROLLER, 'getProducts'),
        method: 'POST',
        dataType: 'json',
        success: resp => {


            resp.map(({ prodId, prodNombre, prodMarca, prodPrecio, prodStock }) => {

                buyProd.innerHTML += `<option data-stock="${prodStock}" data-price="${prodPrecio}" value="${prodId}">${prodNombre} ${prodMarca}</option>`;
            })
        }
    });
};

//  MODAL EVENTS
$buyAddModal.on('shown.bs.modal', _ => {

    setSelect2();
    getStaff();
    getProviders();
    getProducts();
});

$buyAddModal.on('hidden.bs.modal', _ => {

    buyStaff.innerHTML = '';
    buyProv.innerHTML = '';
    buyProd.innerHTML = '';
    alertModalPlanincorp.classList.remove('show');
    alertModalPlanincorp.innerHTML = ``;
    arrBuy = [];
    drawBuy();
});

/* END MODAL EVENTS */

//OPEN NEW PROVIDER MODAL

buyNewProv.onclick = e => {

    e.stopPropagation();
    modalBuyNewProv.style.opacity = "1";
    inputModalProvBuy.focus();
};

modalBuyNewProv.onclick = e => {
    e.stopPropagation();
};

// QUICK SAVE NEW PROVIDER
const createProvider = (provider) => {

    $.ajax({
        url: GetURL(CONTROLLER, 'createProvider'),
        method: 'POST',
        data: { provider },
        success: resp => {
            inputModalProvBuy.value = '';
            modalBuyNewProv.style.opacity = "0";

            const { field, id, status } = JSON.parse(resp);

            if (status) {

                let newOption = new Option(field, id, false, true);
                $(buyProv).append(newOption).trigger('change');

            } else {
                $(buyProv).val(id).trigger('change');
            }
        },
    });
};

formModalBuyProv.addEventListener('submit', e => {

    e.preventDefault();

    inputModalProvBuy.value.length > 0 && createProvider(inputModalProvBuy.value);
});

/* END QUICK SAVE NEW PROVIDER */

//OPEN NEW PRODUCT MODAL
buyNewProd.onclick = e => {

    e.stopPropagation();
    modalBuyNewProd.style.display = 'block';
    modalBuyNewName.focus();

};


modalBuyNewProd.onclick = e => {
    e.stopPropagation();
};

// QUICK SAVE NEW PRODUCT
const createProduct = (form) => {

    const formData = new FormData(form);

    const values = Object.fromEntries(formData.entries());

    $.ajax({
        url: GetURL(CONTROLLER, 'createProduct'),
        method: 'POST',
        data: JSON.stringify(values),
        success: resp => {

            modalBuyNewProd.reset();
            modalBuyNewProd.style.display = "none";

            const { field, id, price, status } = JSON.parse(resp);

            if (status) {

                let newOption = new Option(field, id, false, true);

                newOption.dataset.price = price;
                newOption.dataset.stock = 0;
                $(buyProd).append(newOption).trigger('change');

            } else {
                $(buyProd).val(id).trigger('change');
            }
        },
    });
};


modalBuyNewProd.addEventListener('submit', e => {

    e.preventDefault();

    e.target.classList.remove('was-validated');

    Validation(modalBuyNewProdAll, e.target);

    !e.target.classList.contains('was-validated') && createProduct(e.target);
});

/* END QUICK SAVE NEW PRODUCT */


// SET PERSONAL ID TO LIST FROM ONCHANGE EVENT

$(buyStaff).on('change', e => {

    cleanAlert();
    objBuy["idPersonal"] = e.target.value;
});

// SET PROVEEDOR ID TO LIST FROM ONCHANGE EVENT

$(buyProv).on('change', e => {

    cleanAlert();
    objBuy["idProveedor"] = e.target.value;
});

// SET PAY TYPE VALUE TO LIST FROM ONCHANGE EVENT

buyPayType.addEventListener('change', e => {

    cleanAlert();
    objBuy["tipoPago"] = e.target.value;
});

// DRAW BUY PRODUCTS  TABLE

const drawFooter = _ => {

    let displayFooter = arrBuy.length === 0 ? 'none' : 'table-footer-group';

    tableBuyFooter.style.display = displayFooter;

    const sumUnit = arrBuy.reduce((acc, { unit }) => acc + unit, 0);
    let sumTotal = arrBuy.reduce((acc, item) => acc + item.unit * item.price, 0);

    buyFooterTotalProducts.textContent = sumUnit;
    buyFooterTotal.textContent = `$${Intl.NumberFormat("en-EN", { minimumFractionDigits: 2 }).format(sumTotal)}`;

    objBuy["totalUnit"] = +sumUnit;
    objBuy["total"] = sumTotal;
};

const drawBuy = _ => {

    objBuy["productos"] = arrBuy;
    const buyMap = arrBuy.map((item, i) => {

        let price = item.price;

        let total = item.unit * item.price;

        objBuy.productos[i]["total"] = total;

        return `<tr>
                    <td>${item.text}</td>
                    <td>
                        <button data-id="${item.id}" class="btn-buy-substract">
                        -
                    </button>

                    <span>&nbsp;${item.unit}&nbsp;</span>
                        <button data-id="${item.id}" class="btn-buy-add">
                        +
                    </button>
                    </td>
                    <td>${Intl.NumberFormat("en-EN", { minimumFractionDigits: 2 }).format(price)}</td>
                    <td>${Intl.NumberFormat("en-EN", { minimumFractionDigits: 2 }).format(total)}</td>
                </tr>`;

    }).join('\n');

    itemsBuy.innerHTML = buyMap;

    drawFooter();
};

/* END DRAW BUY PRODUCTS TABLE */

// SET PRODUCTS TO LIST
$(buyProd).on('change', e => {

    cleanAlert();

    const findProduct = arrBuy.find(item => item.id === e.target.value);

    if (!findProduct) {
        arrBuy.push({

            id: e.target.value,
            text: e.target.options[e.target.selectedIndex].text,
            unit: 1,
            price: e.target.options[e.target.selectedIndex].dataset.price,
            stock: e.target.options[e.target.selectedIndex].dataset.stock,

        });
    } else {
        findProduct["unit"] = findProduct["unit"] + 1;
    }

    drawBuy();

    $(buyProd).val(null);

});

// ADD OR SUBSTRACT PRODUCT
itemsBuy.addEventListener('click', e => {

    switch (e.target.classList["value"]) {

        case 'btn-buy-substract':
            arrBuy.filter((item, i) => {

                if (item.id === e.target.dataset.id) {
                    item.unit--;
                    item.unit === 0 && arrBuy.splice(i, 1);
                }
            });

            break;

        case 'btn-buy-add':
            const add = arrBuy.find(item => item.id === e.target.dataset.id);
            add["unit"]++;
            break;
    }

    drawBuy();
    e.stopPropagation();

});

// EMPTY PRODUCTS & PRODUCTS ARRAY
btnEmptyProducts.addEventListener('click', _ => {
    arrBuy = [];
    drawBuy();

});

// SET & SHOW ALERT MODAL
const showModal = (icon, message) => {

    alertModalPlanincorp.classList.add('show');
    alertModalPlanincorp.innerHTML = `<i class="${icon}"></i>&nbsp; ${message}`;
    $buyAddModal.scrollTop(0);
}


// SAVE BUY
btnBuy.addEventListener('click', e => {

    cleanAlert();

    if (buyStaff.value === '') {

        showModal('fas fa-user', 'Selecciona personal');
        return;

    } else if (buyProv.value === '') {

        showModal('fas fa-address-card', 'Selecciona Proveedor');
        return;
    } else if (arrBuy.length === 0) {

        showModal('fas fa-box', 'No has seleccionado ningún producto para comprar.');
        return;
    }

    e.preventDefault();

    CreateBuy(CONTROLLER, METHOD, objBuy, $buyAddModal, $buyTable);

});

/**** END CREATE BUY ****/


/**** BUY'S DETAILS ****/

// GET DETAILS FROM BD

const fetchDetails = (id, staff, prov, area, pay, units, total, createdAt, modalId, modal = 0, download = 0) => {

    objDetails["id"] = id;
    objDetails["staff"] = staff;
    objDetails["area"] = area;
    objDetails["prov"] = prov;
    objDetails["pay"] = pay;
    objDetails["productsTotal"] = total;
    objDetails["totalProd"] = units;
    objDetails["totalProducts"] = `${units} <span>producto(s)</span>`;
    objDetails["allTotal"] = `$${Intl.NumberFormat("en-EN", { minimumFractionDigits: 2 }).format(total)}`;
    objDetails["createdAt"] = createdAt;

    $.ajax({
        url: GetURL(CONTROLLER, 'getDetails'),
        method: 'GET',
        data: { id },
        success: resp => {


            objDetails["details"] = JSON.parse(resp);

            drawBuyTemplate(objDetails, download);

            modal && modalId.modal('show');

        },
    });


};

// MAP ON DETAILS
const buysMap = del => {
    return objDetails["details"].map(({ id, detailUnit, detailProduct, detailPrice, detailTotal }) => {

        const min = del ? `
     
        <td> <i data-id="${id}" style="color:#DC3545" class="fas fa-minus-circle buyDeleteProduct"></i></td>` : '';

        return `<tr>
        
            ${min}
            <td>${detailProduct}</td>
            <td class="buyDetailsUnit">${detailUnit}</td>
            <td class="buyDetailsPrice">${Intl.NumberFormat("en-EN", { minimumFractionDigits: 2 }).format(detailPrice)}</td>
            <td class="buyDetailsTotal">${Intl.NumberFormat("en-EN", { minimumFractionDigits: 2 }).format(detailTotal)}</td>
        
        </tr>`

    }).join('\n');
}

// SHOW MODAL DETAILS 
$buyDetailsModal.on('shown.bs.modal', _ => {

    buyDetailsProduct.innerHTML = '';
    buyDetailsTitle.innerText = objDetails["id"];
    buyDetailsStaff.innerText = objDetails["staff"];
    buyDetailsArea.innerText = objDetails["area"];
    buyDetailsProv.innerText = objDetails["prov"];
    buyDetailsPay.innerText = objDetails["pay"];
    buyDetailsTotalProducts.innerHTML = objDetails["totalProducts"];
    buyDetailsAllTotal.innerText = objDetails["allTotal"];
    buyDetailsProduct.innerHTML = buysMap(0);
});


/**** END BUY'S DETAILS ****/

/****  PDF DETAILS ****/

const drawBuyTemplate = (obj, download) => {

    buyDetailsProductPdf.innerHTML = '';

    const optDownload = {
        margin: 0.2,
        filename: `compra_${obj.id}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, letterRendering: true, dpi: 362, logging: true },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };


    templateBuyPdf.querySelector('#buyIdPdf').innerText = obj.id;
    templateBuyPdf.querySelector('#buyDatePdf').innerText = obj.createdAt;
    templateBuyPdf.querySelector('#buyStaffPdf').innerText = obj.staff;
    templateBuyPdf.querySelector('#buyAreaPdf').innerText = obj.area;
    templateBuyPdf.querySelector('#buyProvPdf').innerText = obj.prov;
    templateBuyPdf.querySelector('#buyPayPdf').innerText = obj.pay;
    templateBuyPdf.querySelector('#buyDetailsTotalProductsPdf').innerHTML = obj.totalProducts;
    templateBuyPdf.querySelector('#buyDetailsAllTotalPdf').innerText = obj.allTotal;

    buyDetailsProductPdf.innerHTML = buysMap(0);

    document.body.style.fontFamily = "'Poppins',sans-serif";

    download && html2pdf(templateBuyPdf.innerHTML, optDownload);

    document.body.style.fontFamily = "-apple-system, BlinkMacSystemFont, segoe ui, roboto, helvetica neue, Arial, sans-serif, apple color emoji, segoe ui emoji, segoe ui symbol";
}

/**** END PDF DETAILS ****/


/**** DELIVERY BUY ****/

const buyDelivery = (id, nameStaff) => {

    CreateDelivery(CONTROLLER, METHOD_DELIVERY, id, nameStaff, $buyTable);
}

/**** END DELIVERY BUY ****/

/**** CANCEL BUY ****/

const drawDeleteBuy = _ => {

    buyDetailsProductMin.innerHTML = '';
    buyDetailsTitleMin.innerText = objDetails["id"];
    buyTotalProductsMin.innerHTML = objDetails["totalProducts"];
    buyAllTotalMin.innerHTML = objDetails["allTotal"];
    buyDetailsProductMin.innerHTML = buysMap(1);
}

$buyCancelModal.on('shown.bs.modal', _ => {

    drawDeleteBuy();

});

// SET AND CLEAR CANCEL ALERT
const setAlertCancelBuy = item => {

    clearTimeout(timeAlert);

    $buyCancelModal.modal('hide');


    alertPlanincorp.classList.add('show');
    alertPlanincorp.innerHTML = `<i class='fas fa-check-circle'></i> Compra # ${item} cancelada con éxito.`;

    timeAlert = setTimeout(_ => {

        alertPlanincorp.classList.remove('show');
        alertPlanincorp.innerHTML = '';

    }, 6000);

}

// DETAIL DELETE HANDLER
buysTableMin.addEventListener('click', e => {

    if (e.target.classList["value"] === 'fas fa-minus-circle buyDeleteProduct') {

        e.target.style.pointerEvents = "none";
        e.target.classList = '';
        e.target.classList.add('fas', 'fa-spinner', 'fa-spin');

        objDetails["details"].filter((item, i) => {

            if (item.id === e.target.dataset.id) {

                item.detailUnit--;

                let total = item.detailUnit * item.detailPrice;
                total = parseFloat(total).toFixed(2);

                item.detailTotal = total;
                const totalProd = objDetails["details"].reduce((acc, { detailUnit }) => acc + +detailUnit, 0);
                const allTotal = parseFloat(objDetails["details"].reduce((acc, item) => acc + item.detailUnit * item.detailPrice, 0)).toFixed(2);

                objDetails["totalProducts"] = `${totalProd} <span>producto(s)</span>`;

                objDetails["allTotal"] = `$${Intl.NumberFormat("en-EN", { minimumFractionDigits: 2 }).format(allTotal)}`;

                const objDeleteDetail = {
                    idCompra: item.idCompra,
                    id: item.id,
                    unit: item.detailUnit,
                    total,
                    totalProd,
                    allTotal,
                    idStock: item.idStock,
                    stock: item.stock
                }


                $.ajax({
                    url: GetURL(CONTROLLER, 'deleteDetail'),
                    method: 'POST',
                    data: JSON.stringify(objDeleteDetail),
                    success: resp => {

                        item.stock = JSON.parse(resp);

                        $buyTable.bootstrapTable('refresh', { silent: true });
                        window.scroll(0, 0);

                        if (totalProd === 0) {

                            setAlertCancelBuy(item.id);
                        }

                        setTimeout(() => {

                            item.detailUnit === 0 && objDetails["details"].splice(i, 1);
                            drawDeleteBuy();
                        }, 1500);


                    },
                });

            }

        });
    }

});

//DELETE ALL BUYS
buyCancelAll.addEventListener('click', _ => {

    let detailId = objDetails["details"].map(({ id }) => id);

    let stockProduct = '';
    let productId = '';

    objDetails["details"].map(({ idProducto, stock, detailUnit }) => {

        const minStock = stock - detailUnit;

        stockProduct += `WHEN ${idProducto} THEN ${minStock} `;

        productId += `${idProducto},`;
    });

    detailId = `(${detailId.join(',')})`;

    productId = productId.slice(0, -1);

    $.ajax({
        url: GetURL(CONTROLLER, 'deleteAllBuy'),
        method: 'POST',
        data: { idCompra: objDetails["id"], detailId, stockProduct, productId },
        success: _ => {

            $buyTable.bootstrapTable('refresh', { silent: true });

            window.scroll(0, 0);
            setAlertCancelBuy(objDetails["id"]);
        }

    });

});

/**** END CANCEL BUY ****/