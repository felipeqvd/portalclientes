        <div id="page-content-wrapper" class="main">
          <h4 class="page-header">Cambio de contraseña</h4>

          <div style="clear: both; padding-top: 10px;">
            
                <div class="easyui-panel" title="" style="width:100%;padding:30px 70px 50px 70px; text-align: center;">
                  <div style="padding:10px 60px 20px 60px">     
                    <form class="form-horizontal" id="ff1" method="post">
                      
                        <div class="row" style="margin-bottom: 20px">
                          <div class="col-sm-2"></div>
                          <label class="control-label col-sm-2">Contraseña anterior:</label>
                          <div class="col-sm-6">
                            <input id="oldpassw" name="oldpassw" class="easyui-textbox" type="password"  data-options="prompt:'Contraseña anterior',iconCls:'icon-lock',iconWidth:38" style="width:100%;">
                          </div>
                          <div class="col-sm-2"></div>    
                        </div>
                        <div class="row" style="margin-bottom: 20px">  
                          <div class="col-sm-2"></div>
                          <label class="control-label col-sm-2">Nueva contraseña:</label>
                          <div class="col-sm-6">
                            <input id="newpassw1" name="newpassw1" class="easyui-textbox" type="password"  data-options="prompt:'Nueva contraseña',iconCls:'icon-lock',iconWidth:38" style="width:100%;">
                          </div>
                          <div class="col-sm-2"></div>    
                         </div>
                         <div class="row" style="margin-bottom: 20px">  
                          <div class="col-sm-2"></div>
                          <label class="control-label col-sm-2">Confirmar nueva contraseña:</label>
                          <div class="col-sm-6">
                            <input id="newpassw2" name="newpassw2" class="easyui-textbox" type="password"  data-options="prompt:'Nueva contraseña',iconCls:'icon-lock',iconWidth:38" style="width:100%;">
                          </div>
                          <div class="col-sm-2"></div>     
                         </div>     
                       
                    </form>
                    <div>
                        <a href="#" class="easyui-linkbutton" style="width:250px" id="changepassw">Cambiar</a>
                    </div>  
                   </div>    
                </div>

            
            </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/datagrid-filter.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#changepassw').on('click', function(event) {
                event.preventDefault();
                if ($("input[name='oldpassw']").val() !== "" && $("input[name='newpassw1']").val() !== "" && $("input[name='newpassw2']").val() !== "")
                    changePassword();
                else
                    $.messager.alert('Warning','Por favor diligencie todos los campos','warning');
            });
        });
        function changePassword(){
            var data = $("#ff1").serializeArray();
            $.post(<?=json_encode(base_url())?>+"index.php/login/cambiar_password", data, function(response,status,xhr){
                if (status == "error"){
                    $.messager.alert('Warning','Ha ocurrido un error al procesar la información. Por favor intente nuevamente','warning');
                }
                else if (response.type == 'danger'){
                    $.messager.alert('Error',response.msg,'error');
                }
                else if (response.type == 'success'){
                    $.messager.alert({
                        title: 'Contraseña cambiada',
                        msg: response.msg,
                        fn: function(){
                            location.reload();
                        }
                    });
                }
            }, 'json');
        }            
    </script>
  </body>
</html>