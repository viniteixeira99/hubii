<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Agência CodeLabs">
    <meta name="author" content="Agência CodeLabs">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="https://agenciacodelabs.com.br/wp-content/uploads/2020/11/cropped-Design-sem-nome-11-180x180.png" type="image/x-icon">
    <link rel="icon" href="https://agenciacodelabs.com.br/wp-content/uploads/2020/11/cropped-Design-sem-nome-11-180x180.png" type="image/x-icon">

    <!-- App title -->
    <title>Painel de Administração</title>
    <script>
        var DIR = '<?php echo base_url('');?>';

    </script>
    <!-- App CSS -->
    <link href="<?php echo base_url('assets/admin/')?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin/')?>/css/core.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin/')?>/css/components.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin/')?>/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin/')?>/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin/')?>/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin/')?>/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin/')?>plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo base_url('assets/admin/')?>/js/modernizr.min.js"></script>

</head>
<body>

<div class="text-center logo-alt-box">
    <a href="index.html" class="logo"><span>Painel<span>Administrativo</span></span></a>
    <h5 class="text-muted m-t-0">Acessar a area do Administrador</h5>
</div>

<div class="wrapper-page">

    <div class="m-t-30 card-box">
        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">Entrar</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal m-t-10" action="javascript:login();">

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" name="user" placeholder="Usuario">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required=""  name="pass" placeholder="Senha">
                    </div>
                </div>
            <b id="info"></b>


                <div class="form-group text-center m-t-30">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light text-uppercase" type="submit">Entrar</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a data-toggle="modal" data-target="#myModal" class="text-muted"><i class="fa fa-lock m-r-5"></i> Esqueceu sua senha?</a>
                    </div>
                </div>


            </form>

        </div>
    </div>
    <!-- end card-box -->

</div>
<!-- end wrapper page -->


<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Redefinir meu acesso</h4>
            </div>
            <div class="modal-body">
                <p>
                    <input type="email" class="form-control" id="emailRecuperar" placeholder="Informe seu e-mail">

                </p>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-custom waves-effect waves-light">Recuperar Acesso</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="<?php echo base_url('assets/admin/')?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/admin/')?>/js/detect.js"></script>
<script src="<?php echo base_url('assets/admin/')?>/js/fastclick.js"></script>
<script src="<?php echo base_url('assets/admin/')?>/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url('assets/admin/')?>/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url('assets/admin/')?>/js/waves.js"></script>
<script src="<?php echo base_url('assets/admin/')?>/js/wow.min.js"></script>
<script src="<?php echo base_url('assets/admin/')?>/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url('assets/admin/')?>/js/jquery.scrollTo.min.js"></script>

<!-- App js -->
<script src="<?php echo base_url('assets/admin/')?>/js/jquery.core.js"></script>
<script src="<?php echo base_url('assets/admin/')?>/js/jquery.app.js"></script>
<script src="<?php echo base_url('assets/admin/')?>/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
    $(function () {
        var i = -1;
        var toastCount = 0;
        var $toastlast;

        var getMessage = function () {
            var msgs = ['My name is Inigo Montoya. You killed my father. Prepare to die!',
                'Are you the six fingered man?',
                'Inconceivable!',
                'I do not think that means what you think it means.',
                'Have fun storming the castle!'
            ];
            i++;
            if (i === msgs.length) {
                i = 0;
            }

            return msgs[i];
        };

        var getMessageWithClearButton = function (msg) {
            msg = msg ? msg : 'Clear itself?';
            msg += '<br /><br /><button type="button" class="btn btn-default clear">Yes</button>';
            return msg;
        };

        $('#showtoast').click(function () {
            var shortCutFunction = $("#toastTypeGroup input:radio:checked").val();
            var msg = $('#message').val();
            var title = $('#title').val() || '';
            var $showDuration = $('#showDuration');
            var $hideDuration = $('#hideDuration');
            var $timeOut = $('#timeOut');
            var $extendedTimeOut = $('#extendedTimeOut');
            var $showEasing = $('#showEasing');
            var $hideEasing = $('#hideEasing');
            var $showMethod = $('#showMethod');
            var $hideMethod = $('#hideMethod');
            var toastIndex = toastCount++;
            var addClear = $('#addClear').prop('checked');

            toastr.options = {
                closeButton: $('#closeButton').prop('checked'),
                debug: $('#debugInfo').prop('checked'),
                newestOnTop: $('#newestOnTop').prop('checked'),
                progressBar: $('#progressBar').prop('checked'),
                positionClass: $('#positionGroup input:radio:checked').val() || 'toast-top-right',
                preventDuplicates: $('#preventDuplicates').prop('checked'),
                onclick: null
            };

            if ($('#addBehaviorOnToastClick').prop('checked')) {
                toastr.options.onclick = function () {
                    alert('You can perform some custom action after a toast goes away');
                };
            }

            if ($showDuration.val().length) {
                toastr.options.showDuration = $showDuration.val();
            }

            if ($hideDuration.val().length) {
                toastr.options.hideDuration = $hideDuration.val();
            }

            if ($timeOut.val().length) {
                toastr.options.timeOut = addClear ? 0 : $timeOut.val();
            }

            if ($extendedTimeOut.val().length) {
                toastr.options.extendedTimeOut = addClear ? 0 : $extendedTimeOut.val();
            }

            if ($showEasing.val().length) {
                toastr.options.showEasing = $showEasing.val();
            }

            if ($hideEasing.val().length) {
                toastr.options.hideEasing = $hideEasing.val();
            }

            if ($showMethod.val().length) {
                toastr.options.showMethod = $showMethod.val();
            }

            if ($hideMethod.val().length) {
                toastr.options.hideMethod = $hideMethod.val();
            }

            if (addClear) {
                msg = getMessageWithClearButton(msg);
                toastr.options.tapToDismiss = false;
            }
            if (!msg) {
                msg = getMessage();
            }

            $('#toastrOptions').text('Command: toastr["'
                + shortCutFunction
                + '"]("'
                + msg
                + (title ? '", "' + title : '')
                + '")\n\ntoastr.options = '
                + JSON.stringify(toastr.options, null, 2)
            );

            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
            $toastlast = $toast;

            if (typeof $toast === 'undefined') {
                return;
            }

            if ($toast.find('#okBtn').length) {
                $toast.delegate('#okBtn', 'click', function () {
                    alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
                    $toast.remove();
                });
            }
            if ($toast.find('#surpriseBtn').length) {
                $toast.delegate('#surpriseBtn', 'click', function () {
                    alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
                });
            }
            if ($toast.find('.clear').length) {
                $toast.delegate('.clear', 'click', function () {
                    toastr.clear($toast, {force: true});
                });
            }
        });

        function getLastToast() {
            return $toastlast;
        }

        $('#clearlasttoast').click(function () {
            toastr.clear(getLastToast());
        });
        $('#cleartoasts').click(function () {
            toastr.clear();
        });
    })
</script>


<script>

    function login() {

        var form = $('form').serialize();
        $.ajax({
            url: '<?php echo base_url('AjaxAdmin/loginAdm')?>',
            data: form,
            type: 'POST',
            beforeSend: function () {
                $('body').css('opacity','0.5');

            },
            error: function (res) {

                Command: toastr["error"]("Ocorreu um erro, tente novamente!");

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                $('body').css('opacity','1');

            },
            success: function (data) {

                $('body').css('opacity','1');

                if(data == 11){

                    window.location.reload();

                }

                else{
                    Command: toastr["warning"](data);

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }



            }
        });
    }

</script>

</body>
</html>