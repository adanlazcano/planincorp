<section class="main col-xxl-12">

        <!-- PROVIDER ALERT -->
        <div class="alert alert-success alertPlanincorp" role="alert"></div>
        <!-- PROVIDER CARD -->
        <div class ="card card-primary card-outline">

                <div class="header-card">
                        <h3>Proveedores</h3>
                        <button data-toggle="modal" data-target="#provAddModal" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo</button>

                </div>
                 <hr/>

                 <!-- PROVIDER TABLE -->
                <table id="provTable" 
                                data-locale="es-MX"
                                data-toolbar="#toolbar"  
                                data-pagination="true"
                                data-side-pagination="server"
                                data-search="true"
                                data-page-size="50">
                </table>
                 
        </div>
        <!-- END PROVIDER CARD -->

        <!-- CREATE PROVIDER MODAL -->
        <div id="provAddModal" class="modal fade customModal" data-backdrop="static" data-keyboard="false" role="dialog">
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
                                        
                                        <form class="provAddForm" novalidate>
                                        
                                                <div class="form-group">
                                                        <label for="provNombre">Nombre</label>
                                                        <input name="provNombre" type="input" class="form-control formValidate" id="provNombre" aria-describedby="provNombreHelp" placeholder="Nombre" required>
                                                        
                                                        <div class="invalid-feedback">
                                                               Escribe Nombre
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label for="provDescripcion">Descripci&oacute;n</label>
                                                        <input name="provDescripcion" type="input" class="form-control formValidate" id="provDescripcion" aria-describedby="provDescripcionHelp" placeholder="Descripcion">
                                                        
                                                        <div class="invalid-feedback">
                                                               Escribe Descripci&oacute;n
                                                        </div>
                                                </div>
                                               
                                               
                                                <div class="form-group">
                                                                <label for="provDireccion">Direcci&oacute;n</label>
                                                                <input name="provDireccion" type="input" class="form-control formValidate" id="provDireccion" aria-describedby="provDireccionHelp" placeholder="Dirección" required>
                                                        
                                                                <div class="invalid-feedback">
                                                                Escribe Direcci&oacute;n
                                                                </div>
                                                 </div>

                                                 <div class="form-row">

                                                        <div class="form-group col-md-12">
                                                                        <label for="provTelefono">Tel&eacute;fono</label>
                                                                        <input name="provTelefono" type="input" class="form-control formValidate" id="provTelefono" aria-describedby="provTelefonoHelp" placeholder="Teléfono" required>
                                                                
                                                                        <div class="invalid-feedback">
                                                                        Escribe Tel&eacute;fono
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

                <!-- DELETE PROVIDER MODAL -->
        <div id="provDeleteModal" class="modal fade customModal" data-backdrop="static" data-keyboard="false" role="dialog">
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

                                        <h5 class="modalMessage" id="provDeleteId"></h5>
                                                                                                                        <hr/>
                                        <button id="provDeleteBtn" type="button" style="background:#DC3545;"  class="btn btn-danger float-right btnModal">Eliminar</button>

                                </div>
                        </div>                  
                </div>
        </div>                          
                                        

</section>