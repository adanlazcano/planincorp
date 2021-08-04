import GetURL from './handlers/GetURL.js';

const CONTROLLER = 'home';

$.ajax({

    url: GetURL(CONTROLLER, 'getAllInformation'),
    method: 'GET',
    dataType: 'json',
    success: resp => {

        homeTotalBuy.innerHTML = `$${new Intl.NumberFormat("en-EN",{ minimumFractionDigits: 2 }).format(resp.totalBuy["total"])}`
        homeTotalProv.innerHTML = resp["totalProvd"][0]["total"];
        homeTotalProd.innerHTML = resp["totalProvd"][1]["total"];

        const maxStaff = resp["maxStaff"].map(({ idPersonal, nombre, cont }) => (

            `<li data-id="${idPersonal}"> <span class="text-truncate">${nombre}</span><span>${cont}</span> </li>`
        )).join('\n');

        homeMaxStaff.innerHTML = maxStaff;

        const maxBuy = resp["maxBuy"].map(({ idProducto, producto, cant }) => (

            `<li data-id="${idProducto}"> <span class="text-truncate">${producto}</span><span>${cant}</span> </li>`

        )).join('\n');

        homeMaxBuy.innerHTML = maxBuy;


    },

});




// new Intl.NumberFormat('mx-MX', {  style: 'currency', currency: 'MXN' }).format(row.total);