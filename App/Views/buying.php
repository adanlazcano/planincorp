<section class="main col-xxl-12">

        <!--BUYING ALERT -->
        <div class="alert alert-success alertPlanincorp" role="alert"></div>
        <!-- BUYING CARD -->
        <div class ="card card-primary card-outline">

                <div class="header-card">
                        <h3>Compras</h3>
                        <button data-toggle="modal" data-target="#buyAddModal" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;Nueva</button>

                </div>
                 <hr/>

                 <!-- AREA TABLE -->
                <table id="buyTable" 
                                data-locale="es-MX"
                                data-toolbar="#toolbar"  
                                data-pagination="true"
                                data-side-pagination="server"
                                data-search="true"
                                data-page-size="50">
                </table>
                 
        </div>
        <!-- END AREA CARD -->

            <div id="buyAddModal" class="modal fade customModal" data-backdrop="static" data-keyboard="false" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                                
                                <div class="modal-header">
                                        <h5 class="modal-title modalTitle">
                                        <i class="fas fa-shopping-cart" aria-hidden="true"></i> Agregar                               
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                               
                                <div class="modal-body">

                                        <div class="alert alert-danger alertModalPlanincorp" role="alert"></div>

                                        
                                        <div class="form-row buyContainerGral">
                                              
                                                <div class="form-group col-md-4">
                                                       <label for="buyStaff">
                                                               &nbsp;<i class="fas fa-user"></i> &nbsp;Personal</label>
                                                      
                                                       <select lang="es" style="width:100%;" class="buyList"
                                                       aria-describedby="buyStaffHelp" 
                                                       name="buyStaff" id="buyStaff" required>

                                                       </select>
                                                </div>
                                               
                                                <div class="form-group col-md-4">
                                                       <label for="buyProv">
                                                       &nbsp;<i class="far fa-address-card"></i> &nbsp;Proveedor</label>
                                                       <span class="buyNewProv buyValidate">Nuevo

                                                       </span>

                                                         <div class="modalBuyNewProv">
                                                               <form id="formModalBuyProv">
                                                              
                                                                       <input  type="text" class="form-control inputModalProvBuy" placeholder="Nombre">
                                                               </form>

                                                        </div>
                                                       <select lang="es" style="width:100%;" class="buyList" name="buyProv" id="buyProv">

                                                       </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                &nbsp;<label for="buyPayType">
                                                       <i class="far fa-money-bill-alt"></i>  &nbsp;Tipo de Pago</label>

                                                       <select class="form-control select-custom" name="buyPayType" id="buyPayType">
                                                               
                                                               <option value="EFECTIVO">
                                                                       EFECTIVO
                                                               </option>
                                                               <option value="CHEQUE">
                                                                       CHEQUE
                                                               </option>

                                                       </select>
                                                </div>
                                        </div>
                                       
                                        <div class="form-row buyContainerBuy">
                                              
                                                <div class="form-group col-md-12">
                                                        <label for="buyProduct">
                                                        &nbsp;<i class="fa fa-box"></i>  &nbsp;Producto(s)

                                                        </label>
                                                        <span class="buyNewProd">Nuevo
                                                        </span>
                                                                               
                                                        <select  lang="es" style="width:100%;" class="buyList"
                                                        id="buyProd"
                                                        name="buyProd"></select>
                                               
                                                </div>

                                                <form class="modalBuyNewProd col-md-12" novalidate>
                                                         
                                                        <div class="modalBuyNewProdContent">
                                                                 <div class="form-group col-md-5">
                                                                        <input
                                                                        id="modalBuyNewName"
                                                                        name="modalBuyNewName"
                                                                        class="form-control formValidate" placeholder="Nombre" type="input"
                                                                        aria-describedby="modalBuyNewNameHelp" required>
                                                                </div>
                                                        
                                                                <div class="form-group col-md-5">
                                                                <input
                                                                        id="modalBuyNewMarca"
                                                                        name="modalBuyNewMarca"
                                                                        class="form-control formValidate" placeholder="Marca" type="input"
                                                                        aria-describedby="modalBuyNewMarcaHelp" required>
                                                                </div>
                                                                
                                                                <div class="form-group col-md-2">
                                                    
                                                                        <input class="form-control formValidate"
                                                                        id="modalBuyNewPrecio" name="modalBuyNewPrecio"type="number"
                                                                         min="0" 
                                                                         step="0.01" placeholder="$"
                                                                         aria-describedby="modalBuyNewPrecioHelp" required>
                                                                </div>

                                                        </div>

                                                                        <button  style="display:none;" type="submit">o</button>
                                                 </form>

                                                <section class="sectionBuyTable">                                  
                                                        <table class="table buysTable table-striped">
                                                         <thead>
                                                                <tr>
                                                                        <th >Producto</th>
                                                                        <th>Cantidad</th>
                                                                        
                                                                        <th>Precio</th>
                                                                        <th>Total</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody id="itemsBuy">
                                                                     
                                                        </tbody>
                                                        <tfoot id="tableBuyFooter">
                                                                <tr id="table-footer">
                                                                <th scope="row" colspan="1">Total Productos:</th>

                                                                <td id="buyFooterTotalProducts"></td>
                                                                <td>
                                                                <button class="btnEmptyProducts">Vaciar</button>
                                                                </td>
                                                                <th id="buyFooterTotal"></th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                </section>


                                        </div> 
                                        
                                        <hr/>
                                        <button type="submit"  class="btn btn-primary float-right btnModal btnBuy">
                                                Comprar
                                        </button>
                                </div>       
                        </div>
                </div>
        </div>

      
         <div id="buyDetailsModal" class="modal fade customModal" data-keyboard="false" data-backdrop="static" role="dialog">
                <div class="modal-dialog" role="document">
                        <div class="modal-content">
                                
                                <div class="modal-header">
                                        <h5 class="modal-title modalTitle">
                                             <i class="fas fa-list-ul"></i>&nbsp;Compra # <span class="buyDetailsContent" id="buyDetailsTitle"></span>                             
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                               
                                <div class="modal-body modalBodyDetails">

                                        <div class="form-row">
                                                <div class="col-md-9 text-truncate">
                                                         <i class="fas fa-user"></i>&nbsp;<span class="buyDetailsContent" id="buyDetailsStaff"> </span> 
                                                        
                                                </div>
                                                <div class="col-md-3 text-truncate">
                                                         <i class="fas fa-building"></i>&nbsp;<span class="buyDetailsContent" id="buyDetailsArea"></span>

                                                </div>
                                                <div class="col-md-12">
                                                         <hr/>
                                                </div>

                                                <div class="col-md-9 text-truncate">

                                                        <i class="fas fa-address-card"></i>&nbsp;<span class="buyDetailsContent" id="buyDetailsProv"></span>
                                                 </div>

                                                <div class="col-md-3 text-truncate">

                                                        <i class="fas fa-money-bill-alt"></i>&nbsp;<span class="buyDetailsContent" id="buyDetailsPay"></span>
                                                 </div>

                                        </div>  
                                        
                                        <section class="buyDetailsTable">

                                                <table class="table buysTable table-striped">
                                                        <thead>
                                                        <tr>

                                                                        <th >Producto</th>
                                                                        <th>Cantidad</th>
                                                                        
                                                                        <th>Precio</th>
                                                                        <th>Total</th>
                                                                </tr>

                                                        </thead>
                                                        <tbody id="buyDetailsProduct"></tbody>                 
                                                </table>
                                        </section>
                                      
                                        <div class="buyDetailsH5Total">
                                             <h5>Total</h5>                  
                                        </div>
                                       
                                        <div class="buyDetailsModalFooter">
                                                <div id="buyDetailsTotalProducts" class="buyDetailsContent">
                                                </div>
                                                <div class="buyDetailsContent" id="buyDetailsAllTotal"></div>
                                        </div>
                                        <hr/>
                                        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-info float-right btnModal">
                                                        Cerrar
                                                 </button>              
                                       
                                </div>
                        </div>
                </div>
        </div>

           
        <div id="buyCancelModal" class="modal fade customModal" data-backdrop="static" data-keyboard="false" role="dialog">
                <div class="modal-dialog" role="document">
                        <div class="modal-content">
                                
                                <div class="modal-header">
                                        <h5 class="modal-title">
                                           <i style="color:#DC3545" class="fas fa-minus-circle"></i>
                                           Compra # <span id="buyDetailsTitleMin"></span>         
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                               
                                <div class="modal-body modalBodyDetails">

                                        <div class="form-row">
                                                        <div class="col-md-8 text-truncate">
                                                        <span id="buyTotalProductsMin">
                                                                
                                                                </span>
                                                                
                                                                
                                                        </div>
                                                        <div style="text-align:right;" class="col-md-4 text-truncate">
                                                                <span id="buyAllTotalMin"> </span> 
                                                                
                                                        </div>
                                        </div>                

                                        <section class="buyDetailsTable">

                                        <table class="table buysTable buysTableMin table-striped">
                                                <thead>
                                                <tr>
                                                        <th></th>
                                                        <th ></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                </tr>

                                                </thead>
                                                <tbody id="buyDetailsProductMin"></tbody>                 
                                        </table>
                                        </section>
                                        
                                        <hr/>
                                        <button type="button" id="buyCancelAll" style="background:#DC3545;" class="btn btn-danger float-right btnModal">
                                                        Cancelar Todo
                                                 </button>    

                                </div>
                        </div>                  
                </div>
        </div>                          
                                        


        <div class="templateBuyPdf">

                <div class="templateBuyPdfHeader">
                        <img width="250" src="./assets/img/logoplanin.jpg" alt="">

                        <h1>Compra</h1>
                </div>
                <hr/>
                <div class="templateBuyPdfGrales">
                <ul>
                        <li># : <span id="buyIdPdf"></span></li>
                        <li>Fecha : <span id="buyDatePdf"></span></li>
                        <li>Para: <span id="buyStaffPdf"></span></li>
                        <li>&Aacute;rea : <span id="buyAreaPdf"></span></li>
                        <li>Proveedor : <span id="buyProvPdf"></span></li>
                        <li>Pago : <span id="buyPayPdf"></span></li>
                </ul>
                        
                </div>

                <div class="templateBuyPdfTable">

                        <table class="table buysTable table-striped">
                                <thead>
                                        <tr>
                                                <th >Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Total</th>
                                        </tr>
                                </thead>
                                <tbody id="buyDetailsProductPdf"></tbody>                 
                        </table>
                </div>

                <div class="templateBuyPdfFooter">
                        <h5>Total</h5>                  
                                                
                        <div id="buyDetailsTotalProductsPdf"></div>
                                        
                        <div id="buyDetailsAllTotalPdf"></div>
                </div>
        </div>

</section>