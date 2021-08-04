
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Listado de indicadores</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formularioModal" onclick="limpiar();document.getElementById('faccion').value=1; document.getElementById('formularioModalLabel').innerHTML='Nuevo Registro';">
            Nuevo
        </button>
        <table id="idTbIndicadores" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Unidad Medida</th>
                    <th>Fecha</th>
                    <th>Valor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    for($a=0;$a<count($tbindicadores);$a++){
                        $id = $tbindicadores[$a]["id"];
                        $codigo = $tbindicadores[$a]["codigo"];
                        $nombre = $tbindicadores[$a]["nombre"];
                        $idmedida = $tbindicadores[$a]["id_unidad_medida"];
                        $nombre_medida = $tbindicadores[$a]["nombre_medida"];
                        $fecha = date("Y-m-d",strtotime($tbindicadores[$a]["fecha"]));
                        $valor = $tbindicadores[$a]["valor"];
                ?>
                    <tr>
                        <td><?php echo $id;?></td>
                        <td><?php echo $codigo;?></td>
                        <td><?php echo $nombre;?></td>
                        <td><?php echo $nombre_medida;?></td>
                        <td><?php echo date("d-m-Y",strtotime($tbindicadores[$a]["fecha"]));?></td>
                        <td><?php echo $valor;?></td>
                        <td>
                            <button type="button" class="btn btn-block bg-gradient-success col-md-5 mt-2 mr-2" style="float:left;" data-toggle="modal" data-target="#formularioModal" onclick="actualizar(<?= $id;?>,'<?= $codigo;?>','<?= $nombre;?>','<?= $idmedida;?>','<?= $fecha;?>',<?= $valor;?>)">
                                Actualizar
                            </button>
                            <input type="button" value="Borrar" class="btn btn-block bg-gradient-danger col-md-5" onclick="eliminar(<?= $id;?>);">
                        </td>
                    </tr>
                <?php }?>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>


<!-- Modal para ingreso de registro nuevo y modificación-->
<div class="modal fade" id="formularioModal" tabindex="-1" role="dialog" aria-labelledby="formularioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="formularioModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="fcodigo" class="col-form-label">Código:</label>
                    <input type="text" class="form-control" id="fcodigo">
                </div>
                <div class="form-group">
                    <label for="fnombre" class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control" id="fnombre">
                </div>
                <div class="form-group">
                    <label for="fumedida" class="col-form-label">Unidad de Medida:</label>
                    <select class="custom-select" id="fumedida">
                        <?php
                        for($a=0;$a<count($umedida);$a++){
                        ?>
                            <option value="<?php echo $umedida[$a]["id"];?>"><?php echo $umedida[$a]["nombre"];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ffecha" class="col-form-label">Fecha:</label>
                    <input type="date" class="form-control" id="ffecha">
                </div>
                <div class="form-group">
                    <label for="fvalor" class="col-form-label">Valor:</label>
                    <input type="number" class="form-control" id="fvalor">
                    <input type="hidden" class="form-control" id="fid">
                    <input type="hidden" class="form-control" id="faccion">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="guardar();">Guardar</button>
        </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $("#idTbIndicadores").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
        }).buttons().container().appendTo('#idTbIndicadores .col-md-6:eq(0)');
        
    });
</script>
