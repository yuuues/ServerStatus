<?php
    /*
     * The MIT License
     *
     * Copyright 2016 kyto.
     *
     * Permission is hereby granted, free of charge, to any person obtaining a copy
     * of this software and associated documentation files (the "Software"), to deal
     * in the Software without restriction, including without limitation the rights
     * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
     * copies of the Software, and to permit persons to whom the Software is
     * furnished to do so, subject to the following conditions:
     *
     * The above copyright notice and this permission notice shall be included in
     * all copies or substantial portions of the Software.
     *
     * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
     * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
     * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
     * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
     * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
     * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
     * THE SOFTWARE.
     */
    $Server = new Servers($dbo->db);
    // Inizialise current Servers
    $Server->getServers();
?>

<script>
    var lool;
    $(function () {
        $("#createServer").click(function () {
            $.ajax({
                url: "<?php echo API_DIR; ?>",
                method: "POST",
                data: {
                    action: 'createServer',
                    server_name: $("#server_name").val(),
                    server_url: $("#server_url").val(),
                    server_location: $("#server_location").val(),
                    server_host: $("#server_host").val(),
                    server_type: $("#server_type").val()
                }
            }).done(function (data) {
                data = JSON.parse(data);
                if (data['error'] == false) {
                    location.reload();
                } else {
                    $("#panel-text").html(data['message']);
                    $("#error_panel").show();
                }
            }).fail(function () {
                $("#panel-text").html("La Cagaste!!");
                $("#error_panel").show();
            });
        }
        );
        $(".deleteServer").click(function () {
            $.ajax({
                url: "<?php echo API_DIR; ?>",
                method: "POST",
                data: {
                    action: 'deleteServer',
                    server_id: $(this).data("id")
                }
            }).done(function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (data['error'] == false) {
                    location.reload();
                } else {
                    $("#panel-text").html(data['message']);
                    $("#error_panel").show();
                }
            }).fail(function () {
                $("#panel-text").html("La Cagaste!!");
                $("#error_panel").show();
            });
        });
    });
</script>

<div id="page-wrapper">
    <div class="row">
        <br/>
        <div class="col-lg-12">
            <div id="error_panel" class="panel panel-red" style="text-align: center;line-height: 2em;display:none;">
                <span id="panel-text" class="panel-warning strong"></span>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Servidores Actuales
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Atenci&oacute;n: No es posible editar un servidor.
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre del Servidor</th>
                                    <th>URL del Servidor</th>
                                    <th>Localización</th>
                                    <th>ISP</th>
                                    <th>Servicio Ofrecido</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    Foreach ($Server->servers as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['url'] ?></td>
                                            <td><?php echo $row['location'] ?></td>
                                            <td><?php echo $row['host'] ?></td>
                                            <td><?php echo $row['type'] ?></td>
                                            <td><i data-id="<?php echo $row['id']; ?>" class="deleteServer glyphicon glyphicon-trash"></i>
                                            </td>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> A&ntilde;adir nuevo servidor
                    <div class="pull-right">

                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="form-group col-sm-6">
                            <label for="server_name">Server Name</label>
                            <input type="text" class="form-control" id="server_name">
                        </div><div class="form-group col-sm-6">
                            <label for="server_url">Server URL</label>
                            <input type="text" class="form-control" id="server_url">
                        </div><div class="form-group col-sm-6">
                            <label for="server_location">Server Location</label>
                            <input type="text" class="form-control" id="server_location">
                        </div><div class="form-group col-sm-6">
                            <label for="server_host">Server Host</label>
                            <input type="text" class="form-control" id="server_host">
                        </div><div class="form-group col-sm-6">
                            <label for="server_type">Server Type</label>
                            <input type="text" class="form-control" id="server_type">
                        <div class="clearfix"><br/></div>
                    </div>
                    <button id="createServer" class="btn btn-success btn-block">Create Server</button>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
    </div>