<section class="main col-xxl-12">

        <!-- PRODUCT ALERT -->
        <div class="alert alert-success alertPlanincorp" role="alert"></div>
        <!-- PRODUCT CARD -->
        <div class ="card card-primary card-outline">

                <div class="header-card">
                        <h3>Productos</h3>
                        <button data-toggle="modal" data-target="#prodAddModal" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo</button>

                </div>
                 <hr/>

                 <!-- PRODUCT TABLE -->
                <table id="prodTable" 
                                data-locale="es-MX"
                                data-toolbar="#toolbar"  
                                data-pagination="true"
                                data-side-pagination="server"
                                data-search="true"
                                data-page-size="50">
                </table>
                 
        </div>
        <!-- END PRODUCT CARD -->

        <!-- CREATE PRODUCT MODAL -->
        <div id="prodAddModal" class="modal fade customModal" data-backdrop="static" data-keyboard="false" role="dialog">
                <div class="modal-dialog" role="document">
                        <div class="modal-content">
                                
                                <div class="modal-header">
                                        <h5 class="modal-title modalTitle">
                                                                           
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                               
                                <div class="modal-body">

                                <div class="alert alert-warning alertModalPlanincorp" role="alert"></div>
                                        
                                        <form class="prodAddForm" novalidate>
                                        
                                                <div class="form-group">
                                                        <label for="prodNombre">Nombre</label>
                                                        <input name="prodNombre" type="input" class="form-control formValidate" id="prodNombre" aria-describedby="prodNombreHelp" placeholder="Nombre" required>
                                                        
                                                        <div class="invalid-feedback">
                                                               Escribe Nombre
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label for="prodMarca">Marca</label>
                                                        <input name="prodMarca" type="input" class="form-control formValidate" id="prodMarca" aria-describedby="prodMarcaHelp" placeholder="Marca" required>
                                                        
                                                        <div class="invalid-feedback">
                                                               Escribe Marca
                                                        </div>
                                                </div>
                                               
                                       
                                                 <div class="form-row">

                                                        <div class="form-group col-md-6">
                                                                        <label for="prodPrecio">Precio</label>
                                                                        <input name="prodPrecio" type="number"
                                                                        min="0" 
                                                                        step="0.01" class="form-control formValidate" id="prodPrecio" aria-describedby="prodPrecioHelp" placeholder="Precio" required>
                                                                
                                                                        <div class="invalid-feedback">
                                                                        Escribe precio
                                                                        </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                                        <label for="prodCat">Categor&iacute;a</label>
                                                                        <select id="prodCat" name="prodCat" class="custom-select formValidate" id="prodCat" aria-describedby="prodCatHelp" placeholder="Área" required>
                                                      
                                                      </select>  
                                                                
                                                                        <div class="invalid-feedback">
                                                                       Selecciona una categoría
                                                                        </div>
                                                        </div>
                                                </div>

                                                 <hr/>                 
                                                
                                                 <button type="submit"  class="btn btn-primary float-right btnModal">
                                                         Guardar
                                                 </button>
                                        
                                        </form>
                                </div>
                        </div>
                </div>
        </div>

                <!-- DELETE PRODUCT MODAL -->
        <div id="prodDeleteModal" class="modal fade customModal" data-backdrop="static" data-keyboard="false" role="dialog">
                <div class="modal-dialog" role="document">
                        <div class="modal-content">
                                
                                <div class="modal-header">
                                        <h5 class="modal-title">
                                           <i style="color:#DC3545" class="fas fa-minus-circle"></i>
                                           Confirmar
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                               
                                <div class="modal-body">

                                        <h5 class="modalMessage text-truncate" id="prodDeleteId"></h5>
                                                                                                                        <hr/>
                                        <button id="prodDeleteBtn" type="button" style="background:#DC3545;"  class="btn btn-danger float-right btnModal">Eliminar</button>

                                </div>
                        </div>                  
                </div>
        </div>                          
                                        

</section>