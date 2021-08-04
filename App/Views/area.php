<section class="main col-xxl-12">

        <!-- AREA ALERT -->
        <div class="alert alert-success alertPlanincorp" role="alert"></div>
        <!-- AREA CARD -->
        <div class ="card card-primary card-outline">

                <div class="header-card">
                        <h3>Áreas</h3>
                        <button data-toggle="modal" data-target="#areaAddModal" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo</button>

                </div>
                 <hr/>

                 <!-- AREA TABLE -->
                <table id="areaTable" 
                                data-locale="es-MX"
                                data-toolbar="#toolbar"  
                                data-pagination="true"
                                data-side-pagination="server"
                                data-search="true"
                                data-page-size="50">
                </table>
                 
        </div>
        <!-- END AREA CARD -->

        <!-- CREATE AREA MODAL -->
        <div id="areaAddModal" class="modal fade customModal" data-backdrop="static" data-keyboard="false" role="dialog">
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
                                        
                                        <form class="areaAddForm" novalidate>
                                        
                                                <div class="form-group">
                                                        <label for="areaNombre">Nombre</label>
                                                        <input name="areaNombre" type="input" class="form-control formValidate" id="areaNombre" aria-describedby="areaNombreHelp" placeholder="Nombre" required>
                                                        
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

                <!-- DELETE AREA MODAL -->
        <div id="areaDeleteModal" class="modal fade customModal" data-backdrop="static" data-keyboard="false" role="dialog">
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

                                        <h5 class="modalMessage" id="areaDeleteId"></h5>
                                                                                                                        <hr/>
                                        <button id="areaDeleteBtn" type="button" style="background:#DC3545;"  class="btn btn-danger float-right btnModal">Eliminar</button>

                                </div>
                        </div>                  
                </div>
        </div>                          
                                        

</section>