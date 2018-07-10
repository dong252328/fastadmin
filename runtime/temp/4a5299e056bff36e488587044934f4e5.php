<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:98:"E:\phpStudy\PHPTutorial\WWW\origin\fastadmin\public/../application/index\view\user\brand_shop.html";i:1531217538;s:87:"E:\phpStudy\PHPTutorial\WWW\origin\fastadmin\application\index\view\layout\default.html";i:1531213576;s:84:"E:\phpStudy\PHPTutorial\WWW\origin\fastadmin\application\index\view\common\meta.html";i:1530866246;s:87:"E:\phpStudy\PHPTutorial\WWW\origin\fastadmin\application\index\view\common\sidenav.html";i:1531202739;s:86:"E:\phpStudy\PHPTutorial\WWW\origin\fastadmin\application\index\view\common\script.html";i:1530866246;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?> – <?php echo __('The fastest framework based on ThinkPHP5 and Bootstrap'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<?php if(isset($keywords)): ?>
<meta name="keywords" content="<?php echo $keywords; ?>">
<?php endif; if(isset($description)): ?>
<meta name="description" content="<?php echo $description; ?>">
<?php endif; ?>
<meta name="author" content="FastAdmin">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config: <?php echo json_encode($config); ?>
    };
</script>
        <link href="/assets/css/user.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo url('/'); ?>" style="padding:6px 15px;"><img src="/assets/img/logo.png" style="height:40px;" alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="header-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/" target="_blank"><?php echo __('Home'); ?></a></li>
                        <!--<li><a href="https://www.fastadmin.net/store.html" target="_blank"><?php echo __('Store'); ?></a></li>-->
                        <!--<li><a href="https://www.fastadmin.net/service.html" target="_blank"><?php echo __('Services'); ?></a></li>-->
                        <!--<li><a href="https://www.fastadmin.net/download.html" target="_blank"><?php echo __('Download'); ?></a></li>-->
                        <!--<li><a href="https://www.fastadmin.net/demo.html" target="_blank"><?php echo __('Demo'); ?></a></li>-->
                        <!--<li><a href="https://www.fastadmin.net/donate.html" target="_blank"><?php echo __('Donation'); ?></a></li>-->
                        <!--<li><a href="https://forum.fastadmin.net" target="_blank"><?php echo __('Forum'); ?></a></li>-->
                        <!--<li><a href="https://doc.fastadmin.net" target="_blank"><?php echo __('Docs'); ?></a></li>-->
                        <li class="dropdown">
                            <?php if($user): ?>
                            <a href="<?php echo url('user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 10px;height: 50px;">
                                <span class="avatar-img"><img src="<?php echo $user['avatar']; ?>" alt=""></span>
                            </a>
                            <?php else: ?>
                            <a href="<?php echo url('user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('User center'); ?> <b class="caret"></b></a>
                            <?php endif; ?>
                            <ul class="dropdown-menu">
                                <?php if($user): ?>
                                <li><a href="<?php echo url('user/index'); ?>"><i class="fa fa-user-circle fa-fw"></i><?php echo __('User center'); ?></a></li>
                                <li><a href="<?php echo url('user/profile'); ?>"><i class="fa fa-user-o fa-fw"></i><?php echo __('Profile'); ?></a></li>
                                <li><a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-key fa-fw"></i><?php echo __('Change password'); ?></a></li>
                                <li><a href="<?php echo url('user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i><?php echo __('Sign out'); ?></a></li>
                                <?php else: ?>
                                <li><a href="<?php echo url('user/login'); ?>"><i class="fa fa-sign-in fa-fw"></i> <?php echo __('Sign in'); ?></a></li>
                                <li><a href="<?php echo url('user/register'); ?>"><i class="fa fa-user-o fa-fw"></i> <?php echo __('Sign up'); ?></a></li>
                                <?php endif; ?>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="content">
            <style>
    .profile-avatar-container {
        position: relative;
        width: 100px;
    }

    .profile-avatar-container .profile-user-img {
        width: 100px;
        height: 100px;
    }

    .profile-avatar-container .profile-avatar-text {
        display: none;
    }

    .profile-avatar-container:hover .profile-avatar-text {
        display: block;
        position: absolute;
        height: 100px;
        width: 100px;
        background: #444;
        opacity: .6;
        color: #fff;
        top: 0;
        left: 0;
        line-height: 100px;
        text-align: center;
    }

    .profile-avatar-container button {
        position: absolute;
        top: 0;
        left: 0;
        width: 100px;
        height: 100px;
        opacity: 0;
    }

    .form-layer {
        height: 100%;
        min-height: 150px;
        min-width: 300px;
    }

    .form-body {
        width: 100%;
        overflow: auto;
        top: 0;
        position: absolute;
        z-index: 10;
        bottom: 50px;
        padding: 15px;
    }

    .form-layer .form-footer {
        height: 50px;
        line-height: 50px;
        background-color: #ecf0f1;
        width: 100%;
        position: absolute;
        z-index: 200;
        bottom: 0;
        margin: 0;
    }

    .form-footer .form-group {
        margin-left: 0;
        margin-right: 0;
    }

    .addbrand:hover {
        cursor: pointer;
    }

    .modal-backdrop {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1040;
        background-color: #000;
        display: none;
    }

    .modal-dialog {
        margin: 50px auto;
    }
</style>
<div id="content-container" class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="sidenav">
    <ul class="list-group">
        <li class="list-group-heading"><?php echo __('User center'); ?></li>
        <li class="list-group-item <?php echo $config['actionname']=='index'?'active':''; ?>"> <a href="<?php echo url('user/index'); ?>"><i class="fa fa-user-circle fa-fw"></i> <?php echo __('User center'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='brand_shop'?'active':''; ?>"> <a href="<?php echo url('user/brand_shop'); ?>"><i class="fa fa-user-circle fa-fw"></i> <?php echo __('User brand_shop'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='person_shop'?'active':''; ?>"> <a href="<?php echo url('user/person_shop'); ?>"><i class="fa fa-vcard fa-fw"></i> <?php echo __('User person_shop'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='profile'?'active':''; ?>"> <a href="<?php echo url('user/profile'); ?>"><i class="fa fa-user-o fa-fw"></i> <?php echo __('Profile'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='changepwd'?'active':''; ?>"> <a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-key fa-fw"></i> <?php echo __('Change password'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='logout'?'active':''; ?>"> <a href="<?php echo url('user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> <?php echo __('Sign out'); ?></a> </li>
    </ul>
</div>
        </div>
        <div class="col-md-9">
            <!--品牌基本信息-->
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="page-header"><?php echo __('brand infomation'); ?></h2>
                    <form id="brand" class="form-horizontal" role="form" data-toggle="validator" method="POST"
                          action="<?php echo url('api/user/brand_infomation'); ?>">
                        <?php echo token(); ?>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2"><?php echo __('cn_name'); ?></label>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" id="cn_name" name="cn_name"
                                       value="<?php echo $brand['cn_name']; ?>"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2"><?php echo __('en_name'); ?></label>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" id="en_name" name="en_name"
                                       value="<?php echo $brand['en_name']; ?>"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2"><?php echo __('tel'); ?></label>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" id="tel" name="tel"
                                       value="<?php echo $brand['tel']; ?>"
                                       data-rule="mobile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2"><?php echo __('brand_address'); ?></label>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" id="brand_address" name="brand_address"
                                       value="<?php echo $brand['brand_address']; ?>"
                                       data-level="city"
                                       data-toggle="city-picker">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2"><?php echo __('tag_id'); ?></label>
                            <div class="col-xs-12 col-sm-4">
                                <select name="tag_id" id="tag_id" class="form-control selectpicker"
                                        data-live-search="true" data-tokens="keyword keyword2">
                                    <?php if(is_array($tag) || $tag instanceof \think\Collection || $tag instanceof \think\Paginator): $i = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>" {if condition="$brand.tag_id eq $vo.id" } selected {
                                    /if}><?php echo $vo['floor']; ?> | <?php echo $vo['tag_name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2"><?php echo __('count_num'); ?></label>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" id="count_num" name="count_num"
                                       value="<?php echo $brand['count_num']; ?>" data-rule="digits">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2"><?php echo __('brand_model'); ?></label>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" id="brand_model" name="brand_model"
                                       value="<?php echo $brand['brand_model']; ?>">
                            </div>
                        </div>
                        <div class="form-group normal-footer">
                            <label class="control-label col-xs-12 col-sm-2"></label>
                            <div class="col-xs-12 col-sm-8">
                                <button type="submit" class="btn btn-success btn-embossed "><?php echo __('Ok'); ?></button>
                                <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!--近两年开店情况-->
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="page-header" style="position: relative">
                        <?php echo __('brand new shop'); ?>
                        <i class="fa fa-plus addbrand" style="position: absolute;right: 0px;bottom: 12px;"
                           data-toggle="modal" data-target="#myModal"></i>
                        <div class="clear"></div>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="brand_addshop" class="form-horizontal" role="form" data-toggle="validator"
                                          method="POST"
                                          action="<?php echo url('api/user/brand_infomation'); ?>">
                                        <?php echo token(); ?>
                                        <input type="hidden" name="active" value="edit">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">
                                                添加近两年新开店情况
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <!--form input-->
                                            <div class="form-group">
                                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('city'); ?></label>
                                                <div class="col-xs-12 col-sm-8">
                                                    <input type="text" class="form-control" name="city"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('coopreation_area'); ?></label>
                                                <div class="col-xs-12 col-sm-8">
                                                    <input type="text" class="form-control" name="coopreation_area"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('belong_area'); ?></label>
                                                <div class="col-xs-12 col-sm-8">
                                                    <input type="text" class="form-control" name="belong_area"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('openning_hours'); ?></label>
                                                <div class="col-xs-12 col-sm-8">
                                                    <input type="text" class="form-control" name="openning_hours"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('brand_name'); ?></label>
                                                <div class="col-xs-12 col-sm-8">
                                                    <input type="text" class="form-control" name="brand_name"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('year_turnover1'); ?></label>
                                                <div class="col-xs-12 col-sm-8">
                                                    <input type="text" class="form-control" name="year_turnover1"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('year_turnover2'); ?></label>
                                                <div class="col-xs-12 col-sm-8">
                                                    <input type="text" class="form-control" name="year_turnover2"
                                                           placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                            </button>
                                            <button type="button" class="btn btn-primary">
                                                提交更改
                                            </button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal -->
                        </div>
                    </h2>


                    <?php if(is_array($new_shop) || $new_shop instanceof \think\Collection || $new_shop instanceof \think\Paginator): $i = 0; $__LIST__ = $new_shop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ns): $mod = ($i % 2 );++$i;?>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion"
                                   href="#collapse<?php echo $ns['id']; ?>">
                                    <?php echo $ns['city']; ?>/<?php echo $ns['coopreation_area']; ?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse<?php echo $ns['id']; ?>" class="panel-collapse collapse">
                            <div class="panel-body" style="padding: 0">
                                <form class="form-horizontal" role="form" data-toggle="validator" method="POST"
                                      action="<?php echo url('api/user/brand_infomation'); ?>">
                                    <?php echo token(); ?>
                                    <input type="hidden" name="active" value="edit">
                                    <input type="hidden" name="id" value="<?php echo $ns['id']; ?>">
                                    <!--form input-->
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('city'); ?></label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="text" class="form-control" name="city"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('coopreation_area'); ?></label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="text" class="form-control" name="coopreation_area"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('belong_area'); ?></label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="text" class="form-control" name="belong_area"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('openning_hours'); ?></label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="text" class="form-control" name="openning_hours"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('brand_name'); ?></label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="text" class="form-control" name="brand_name"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('year_turnover1'); ?></label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="text" class="form-control" name="year_turnover1"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('year_turnover2'); ?></label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input type="text" class="form-control" name="year_turnover2"
                                                   placeholder="">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; endif; else: echo "" ;endif; ?>

                </div>

            </div>
        </div>
    </div>
</div>


<script>
    function add_new_shop() {

    }
</script>
        </main>

        <footer class="footer" style="clear:both">
            <p class="copyright"><?php echo $site['name']; ?> <?php echo __('Copyrights'); ?> <a href="/" target="_blank"><?php echo $site['beian']; ?></a></p>
        </footer>

        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>

    </body>

</html>