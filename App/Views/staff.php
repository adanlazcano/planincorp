<section class="main col-xxl-12">

        <!-- STAFF ALERT -->
        <div class="alert alert-success alertPlanincorp" role="alert"></div>
        <!-- STAFF CARD -->
        <div class ="card card-primary card-outline">

                <div class="header-card">
                        <h3>Personal</h3>
                        <button data-toggle="modal" data-target="#staffAddModal" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo</button>

                </div>
                 <hr/>

                 <!-- STAFF TABLE -->
                <table id="staffTable" 
                                data-locale="es-MX"
                                data-toolbar="#toolbar"  
                                data-pagination="true"
                                data-side-pagination="server"
                                data-search="true"
                                data-page-size="50">
                </table>
                 
        </div>
        <!-- END STAFF CARD -->

        <!-- CREATE STAFF MODAL -->
        <div id="staffAddModal" class="modal fade customModal" data-backdrop="static" data-keyboard="false" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
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
                                        
                                        <form class="staffAddForm" novalidate>
                                        
                                                <div class="form-group">
                                                        <label for="staffNombre">Nombre</label>
                                                        <input name="staffNombre" type="input" class="form-control formValidate" id="staffNombre" aria-describedby="staffNombreHelp" placeholder="Nombre" required>
                                                        
                                                        <div class="invalid-feedback">
                                                               Escribe Nombre
                                                        </div>
                                                </div>
                                               
                                                <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                                <label for="staffApPaterno">Apellido Paterno</label>
                                                                <input name="staffApPaterno" type="input" class="form-control formValidate" id="staffApPaterno" aria-describedby="staffApPaternoHelp" placeholder="Apellido Paterno" required>
                                                        
                                                                <div class="invalid-feedback">
                                                                Escribe Apellido
                                                                </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                                <label for="staffApMaterno">Apellido Materno</label>
                                                                <input name="staffApMaterno" type="input" class="form-control formValidate" id="staffApMaterno" aria-describedby="staffApMaternoHelp" placeholder="Apellido Materno">
                                                        
                                                                <div class="invalid-feedback">
                                                                Escribe Apellido
                                                                </div>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label for="staffMail">Correo Electr&oacute;nico</label>
                                                        <input name="staffMail" type="email" class="form-control formValidate" id="staffMail" aria-describedby="staffMailHelp" placeholder="some@planincorp.com.mx" required>
                                                        
                                                        <div class="invalid-feedback">
                                                               Escribe Correo Electr&oacute;nico
                                                        </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                        <label for="staffArea">&Aacute;rea</label>
                                                        <select id="staffArea" name="staffArea" class="custom-select formValidate" id="staffArea" aria-describedby="staffAreaHelp" placeholder="Área" required>
                                                      
                                                        </select>        
                                                        
                                                        <div class="invalid-feedback">
                                                               Selecciona una Área
                                                        </div>
                                                </div>

                                                <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                                <label for="staffPuesto">Puesto</label>
                                                                <input name="staffPuesto" type="input" class="form-control formValidate" id="staffPuesto" aria-describedby="stafPuestoHelp" placeholder="Puesto" required>
                                                                
                                                                <div class="invalid-feedback">
                                                                Escribe Puesto
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

                <!-- DELETE STAFF MODAL -->
        <div id="staffDeleteModal" class="modal fade customModal" data-backdrop="static" data-keyboard="false" role="dialog">
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

                                        <h5 class="modalMessage" id="staffDeleteId"></h5>
                                                                                                                        <hr/>
                                        <button id="staffDeleteBtn" type="button" style="background:#DC3545;"  class="btn btn-danger float-right btnModal">Eliminar</button>

                                </div>
                        </div>                  
                </div>
        </div>                          
                                        

</section>