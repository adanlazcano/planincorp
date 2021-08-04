import GetURL from "./handlers/GetURL.js";
const $inventoryTable = $('#inventoryTable');

const CONTROLLER = 'inventory';


// INVENTORY TABLE
$inventoryTable.bootstrapTable('destroy');
$inventoryTable.bootstrapTable({

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
            field: "cantidad",
            title: "Cantidad",
            align: "center"
        },
        {
            field: "producto",
            title: "Producto"
        },
        {
            field: "responsable",
            title: "Responsable"
        },

        {
            field: "puesto",
            title: "Puesto",


        },
        {
            field: "area",
            title: "Área",


        },

        {
            field: "fecha",
            title: "Fecha"
        },

    ]
});


// INVENTORY DATA EXPORT
btnExportInventory.addEventListener('click', _ => {

    const filename = 'inventario.xlsx';

    $.ajax({
        url: GetURL(CONTROLLER, 'getAllData'),
        method: 'GET',
        dataType: 'json',
        success: resp => {

            const ws = XLSX.utils.json_to_sheet(resp);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Planincorp");
            XLSX.writeFile(wb, filename);
        },

    })
});