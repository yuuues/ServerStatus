<script>
    $(function () {
        $("#trytolog").click(function () {
            $.ajax({
                url: '<?php echo API_DIR; ?>',
                method: 'POST',
                data: {
                    'action': 'login',
                    'password': $("#password").val(),
                    'email': $("#email").val()
                }
            }).done(function (data) {
                console.log(data);
                data = JSON.parse(data);
                if (data['error'] == false) {
                    $.cookie("KY_AuthID", data['hash']);
                    window.location = 'index.php';
                } else {
                    $("#panel-text").html(data['message']);
                    $("#error_panel").show();
                }
            }).fail(function () {
                $("#panel-text").html('Ha ocurrido un error al iniciar sesion');
                $("#error_panel").show();
            });
        })
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Sesi&oacute;n Requerida</h3>
                </div>
                <div id="error_panel" class="panel panel-red" style="text-align: center;line-height: 2em;display:none;">
                    <span id="panel-text" class="panel-warning strong"></span>
                </div>
                <div class="panel-body">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Email" <?php if (DEBUG_MODE) echo 'value="mail@mail.com"' ?> id="email" type="email" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="*******" <?php if (DEBUG_MODE) echo 'value="1234"' ?>  id="password" type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Recordarme ">Recordarme
                            </label>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <button id="trytolog" class="btn btn-lg btn-success btn-block">Iniciar Sesi&oacute;n</button>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

