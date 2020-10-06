
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" xmlns="http://www.w3.org/1999/html"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Ingresar a su cuenta</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link href="http://d2styy3cl55ra7.cloudfront.net/themes/h2/css/cache/minify.css?v=0.1" rel="stylesheet" type="text/css"/>
    <link href="http://d2styy3cl55ra7.cloudfront.net/themes/h2/css/pages/login.css?v=0.1" rel="stylesheet" type="text/css"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,700,300&subset=latin,cyrillic-ext,vietnamese,cyrillic' rel='stylesheet' type='text/css'>
        <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="shortcut icon" href="http://www.creativekits.es/favicon.ico" />

    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/plugins/jquery-1.10.1.min.js?v=0.1" type="text/javascript"></script>

    </head>
<body class="login">
    <!-- BEGIN LOGO -->
    <div class="logo" style=">
        <a class="brand" href="http://creativekits.es">
            <img src="http://www.creativekits.es/img/logoheader.png" alt="" />
        </a>
    </div>
    <!-- END LOGO -->

        <!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form method="POST"
          class="form-vertical login-form pma-login"
          action="http://phpmyadmin.main-hosting.eu/auth">
        <h3 class="form-title">Acceder</h3>

        <div class="control-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Base de datos</label>
            <div class="controls">
                <div class="input-icon left">
                    <i class="icon-user"></i>
                    <input class="m-wrap placeholder-no-fix" type="text" placeholder="Nombre de base de datos" name="db" value="u281730400_ck"/>
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label visible-ie8 visible-ie9">Usuario</label>
            <div class="controls">
                <div class="input-icon left">
                    <i class="icon-lock"></i>
                    <input class="m-wrap placeholder-no-fix" type="text" placeholder="Usuario" name="pma_username" value="u281730400_ck"/>
                </div>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label visible-ie8 visible-ie9">Contraseña</label>
            <div class="controls">
                <div class="input-icon left">
                    <i class="icon-lock"></i>
                    <input class="m-wrap placeholder-no-fix" type="password" placeholder="Contraseña" name="pma_password" value=""/>
                </div>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label visible-ie8 visible-ie9">Idioma</label>
            <div class="controls">
                <div class="input-icon left">
                    <select class="m-wrap placeholder-no-fix" type="text" placeholder="Idioma" name="lang" value="">
                                                <option value="af-utf-8" >Afrikaans</option>
                                                <option value="sq-utf-8" >Shqip - Albanian</option>
                                                <option value="ar-utf-8" >العربية - Arabic</option>
                                                <option value="az-utf-8" >Azərbaycanca - Azerbaijani</option>
                                                <option value="bn-utf-8" >Bangla</option>
                                                <option value="eu-utf-8" >Euskara - Basque</option>
                                                <option value="becyr-utf-8" >Беларуская - Belarusian</option>
                                                <option value="belat-utf-8" >Biełaruskaja - Belarusian latin</option>
                                                <option value="bs-utf-8" >Bosanski - Bosnian</option>
                                                <option value="ptbr-utf-8" >Português - Brazilian portuguese</option>
                                                <option value="bg-utf-8" >Български - Bulgarian</option>
                                                <option value="ca-utf-8" >Català - Catalan</option>
                                                <option value="zh-utf-8" >中文 - Chinese simplified</option>
                                                <option value="zhtw-utf-8" >中文 - Chinese traditional</option>
                                                <option value="hr-utf-8" >Hrvatski - Croatian</option>
                                                <option value="cs-utf-8" >Česky - Czech</option>
                                                <option value="da-utf-8" >Dansk - Danish</option>
                                                <option value="nl-utf-8" >Nederlands - Dutch</option>
                                                <option value="en-utf-8" >English</option>
                                                <option value="et-utf-8" >Eesti - Estonian</option>
                                                <option value="fi-utf-8" >Suomi - Finnish</option>
                                                <option value="fr-utf-8" >Français - French</option>
                                                <option value="gl-utf-8" >Galego - Galician</option>
                                                <option value="ka-utf-8" >ქართული - Georgian</option>
                                                <option value="de-utf-8" >Deutsch - German</option>
                                                <option value="el-utf-8" >Ελληνικά - Greek</option>
                                                <option value="he-utf-8" >עברית - Hebrew</option>
                                                <option value="hi-utf-8" >हिन्दी - Hindi</option>
                                                <option value="hu-utf-8" >Magyar - Hungarian</option>
                                                <option value="id-utf-8" >Bahasa Indonesia - Indonesian</option>
                                                <option value="it-utf-8" >Italiano - Italian</option>
                                                <option value="ja-utf-8" >日本語 - Japanese</option>
                                                <option value="ko-utf-8" >한국어 - Korean</option>
                                                <option value="lv-utf-8" >Latviešu - Latvian</option>
                                                <option value="lt-utf-8" >Lietuvių - Lithuanian</option>
                                                <option value="mkcyr-utf-8" >Macedonian - Macedonian</option>
                                                <option value="ms-utf-8" >Bahasa Melayu - Malay</option>
                                                <option value="mn-utf-8" >Монгол - Mongolian</option>
                                                <option value="no-utf-8" >Norsk - Norwegian</option>
                                                <option value="fa-utf-8" >فارسی - Persian</option>
                                                <option value="pl-utf-8" >Polski - Polish</option>
                                                <option value="pt-utf-8" >Português - Portuguese</option>
                                                <option value="ro-utf-8" >Română - Romanian</option>
                                                <option value="ru-utf-8" >Русский - Russian</option>
                                                <option value="srcyr-utf-8" >Српски - Serbian</option>
                                                <option value="srlat-utf-8" >Srpski - Serbian latin</option>
                                                <option value="si-utf-8" >සිංහල - Sinhala</option>
                                                <option value="sk-utf-8" >Slovenčina - Slovak</option>
                                                <option value="sl-utf-8" >Slovenščina - Slovenian</option>
                                                <option value="es-utf-8" selected>Español - Spanish</option>
                                                <option value="sv-utf-8" >Svenska - Swedish</option>
                                                <option value="tt-utf-8" >Tatarça - Tatarish</option>
                                                <option value="th-utf-8" >ภาษาไทย - Thai</option>
                                                <option value="tr-utf-8" >Türkçe - Turkish</option>
                                                <option value="uk-utf-8" >Українська - Ukrainian</option>
                                                <option value="uzcyr-utf-8" >Ўзбекча - Uzbek-cyrillic</option>
                                                <option value="uzlat-utf-8" >O‘zbekcha - Uzbek-latin</option>
                                            </select>
                </div>
            </div>
        </div>
                <div class="form-actions">
            <button type="submit" class="btn purple pull-right">
                Iniciar sesión <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
    </form>
    <!-- END LOGIN FORM -->
</div>


    <div class="copyright">
            </div>
    <!-- END COPYRIGHT -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->

    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/plugins/jquery-migrate-1.2.1.min.js?v=0.1" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js?v=0.1" type="text/javascript"></script>
    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/plugins/bootstrap/js/bootstrap.min.js?v=0.1" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/plugins/excanvas.min.js?v=0.1"></script>
    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/plugins/respond.min.js?v=0.1"></script>
    <![endif]-->
    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/plugins/jquery-slimscroll/jquery.slimscroll.min.js?v=0.1" type="text/javascript"></script>
    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/plugins/jquery.blockui.min.js?v=0.1" type="text/javascript"></script>
    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/plugins/jquery.cookie.min.js?v=0.1" type="text/javascript"></script>
    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/plugins/uniform/jquery.uniform.min.js?v=0.1" type="text/javascript" ></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/plugins/jquery-validation/dist/jquery.validate.min.js?v=0.1" type="text/javascript"></script>
    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/plugins/jquery-validation/dist/additional-methods.min.js?v=0.1" type="text/javascript"></script>

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/scripts/app.js?v=0.1" type="text/javascript"></script>
    <script src="http://d2styy3cl55ra7.cloudfront.net/themes/h2/scripts/login.js?v=0.1" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->


    <!-- END JAVASCRIPTS -->
    </body>
</html>