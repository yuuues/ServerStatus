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
                    <i class="fa fa-bar-chart-o fa-fw"></i> Servers
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Server Name</th>
                                    <th>Server Url</th>
                                    <th>Server Location</th>
                                    <th>Server Host</th>
                                    <th>Server Type</th>
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
                    <i class="fa fa-bar-chart-o fa-fw"></i> New Server
                    <div class="pull-right">

                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th><label for="server_name">Server Name</th>
                                    <th><label for="server_url">Server URL</th>
                                    <th><label for="server_location">Server Location</th>
                                    <th><label for="server_host">Server Host</th>
                                    <th><label for="server_type">Server Type</label></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" id="server_name"></td>
                                    <td><input type="text" id="server_url"></td>
                                    <td><input type="text" id="server_location"></td>
                                    <td><input type="text" id="server_host"></td>
                                    <td><input type="text" id="server_type"></td>
                                    <td><button id="createServer" class="btn btn-success btn-block">Create Server</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
    </div>