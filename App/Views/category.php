<section class="main col-xxl-12">

        <!-- CATEGORY ALERT -->
        <div class="alert alert-success alertPlanincorp" role="alert"></div>
        <!-- CATEGORY CARD -->
        <div class ="card card-primary card-outline">

                <div class="header-card">
                        <h3>Categor&iacute;as</h3>
                        <button data-toggle="modal" data-target="#catAddModal" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo</button>

                </div>
                 <hr/>

                 <!-- CATEGORY TABLE -->
                <table id="catTable" 
                                data-locale="es-MX"
                                data-toolbar="#toolbar"  
                                data-pagination="true"
                                data-side-pagination="server"
                                data-search="true"
                                data-page-size="50">
                </table>
                 
        </div>
        <!-- END CATEGORY CARD -->

        <!-- CREATE CATEGORY MODAL -->
        <div id="catAddModal" class="modal fade customModal" data-backdrop="static" data-keyboard="false" role="dialog">
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
                                        
                                        <form class="catAddForm" novalidate>
                                        
                                                <div class="form-group">
                                                        <label for="catNombre">Nombre</label>
                                                        <input name="catNombre" type="input" class="form-control formValidate" id="catNombre" aria-describedby="catNombreHelp" placeholder="Nombre" required>
                                                        
                                                        <div class="invalid-feedback">
                                                               Escribe Nombre
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

                <!-- DELETE CATEGORY MODAL -->
        <div id="catDeleteModal" class="modal fade customModal" data-backdrop="static" data-keyboard="false" role="dialog">
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

                                        <h5 class="modalMessage" id="catDeleteId"></h5>
                                                                                                                        <hr/>
                                        <button id="catDeleteBtn" type="button" style="background:#DC3545;"  class="btn btn-danger float-right btnModal">Eliminar</button>

                                </div>
                        </div>                  
                </div>
        </div>                          
                                        

</section>