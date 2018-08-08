<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:83:"/var/www/fastadmin/public/../application/admin/view/zhaoshang/brandlist/detail.html";i:1531463063;s:61:"/var/www/fastadmin/application/admin/view/layout/default.html";i:1531308055;s:58:"/var/www/fastadmin/application/admin/view/common/meta.html";i:1531308055;s:60:"/var/www/fastadmin/application/admin/view/common/script.html";i:1531308055;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <style>
    .black {
        color: #000
    }

    .info-box {
        background-color: #fff;
        padding: 15px;
        margin-top: 15px;
    }
</style>

<div class="layui-container">
    <div class="info-box">
        <h3 class="black">基本信息</h3>

        <div style="padding-left: 40px;">
            <table class="black" style="width: 100%;">
                <tr height="40px;">
                    <td width="100px"><h4>品牌名称</h4></td>
                    <td><h4><?php echo $row['cn_name']; ?></h4></td>
                    <td></td>
                    <td width="100px">英文名名称</td>
                    <td><?php echo $row['en_name']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>品牌原产地</h4></td>
                    <td><h4><?php echo $row['brand_address']; ?></h4></td>
                    <td></td>
                    <td>联系方式</td>
                    <td><?php echo $row['tel']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>全国店面数量</h4></td>
                    <td><h4><?php echo $row['count_num']; ?></h4></td>
                    <td></td>
                    <td>所属品类</td>
                    <td><?php echo $tag['tag_name']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>楼层</h4></td>
                    <td><h4><?php echo $tag['floor']; ?></h4></td>
                    <td></td>
                    <td>联系人</td>
                    <td><?php echo $tag['contact_person']; ?></td>
                </tr>
            </table>

        </div>
    </div>
    <div class="info-box">
        <h3 class="black">商品信息</h3>

        <div style="padding-left: 40px;">

            <?php if(is_array($goodsinfo) || $goodsinfo instanceof \think\Collection || $goodsinfo instanceof \think\Paginator): $k = 0; $__LIST__ = $goodsinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shop): $mod = ($k % 2 );++$k;?>
            <table class="black" style="width: 100%;">
                <tr height="40px;">
                    <td width="100px"><h4>序号</h4></td>
                    <td><h4><?php echo $k; ?></h4></td>
                    <td></td>
                    <td width="100px">商品类型</td>
                    <td><?php echo $shop['goods_type']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>主力销售价格区间</h4></td>
                    <td><h4><?php echo $shop['main_min']; ?>-<?php echo $shop['main_max']; ?></h4></td>
                    <td></td>
                    <td>完整销售价格区间</td>
                    <td><?php echo $shop['complete_min']; ?>-<?php echo $shop['complete_max']; ?></td>
                </tr>
            </table>
            <div style="border:1px solid #292B34"></div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
    </div>
    <div class="info-box">
        <h3 class="black">近两年全国开店情况</h3>

        <div style="padding-left: 40px;">

            <?php if(is_array($new_shop) || $new_shop instanceof \think\Collection || $new_shop instanceof \think\Paginator): $k = 0; $__LIST__ = $new_shop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shop): $mod = ($k % 2 );++$k;?>
            <table class="black" style="width: 100%;">
                <tr height="40px;">
                    <td width="100px"><h4>序号</h4></td>
                    <td><h4><?php echo $k; ?></h4></td>
                    <td></td>
                    <td width="100px">城市</td>
                    <td><?php echo $shop['city']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>合作商场</h4></td>
                    <td><h4><?php echo $shop['coopreation_area']; ?></h4></td>
                    <td></td>
                    <td>所属商圈</td>
                    <td><?php echo $shop['belong_area']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>开店时间</h4></td>
                    <td><h4><?php echo $shop['openning_hours']; ?></h4></td>
                    <td></td>
                    <td>品牌</td>
                    <td><?php echo $shop['brand_name']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>年营业额</h4></td>
                    <td><h4><?php echo $shop['year_turnover1']; ?>亿元</h4></td>
                    <td></td>
                    <td><?php echo $shop['year_turnover2']; ?>亿元</td>
                </tr>
            </table>
            <div style="border:1px solid #292B34"></div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
    </div>

    <div class="info-box">
        <h3 class="black">全国标杆店面情况</h3>

        <div style="padding-left: 40px;">

            <?php if(is_array($model_shop) || $model_shop instanceof \think\Collection || $model_shop instanceof \think\Paginator): $k = 0; $__LIST__ = $model_shop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shop): $mod = ($k % 2 );++$k;?>
            <table class="black" style="width: 100%;">
                <tr height="40px;">
                    <td width="100px"><h4>序号</h4></td>
                    <td><h4><?php echo $k; ?></h4></td>
                    <td></td>
                    <td width="100px">城市</td>
                    <td><?php echo $shop['city']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>合作商场</h4></td>
                    <td><h4><?php echo $shop['coopreation_area']; ?></h4></td>
                    <td></td>
                    <td>所属商圈</td>
                    <td><?php echo $shop['belong_area']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>开店时间</h4></td>
                    <td><h4><?php echo $shop['openning_hours']; ?></h4></td>
                    <td></td>
                    <td>品牌</td>
                    <td><?php echo $shop['brand_name']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>年营业额</h4></td>
                    <td><h4><?php echo $shop['year_turnover1']; ?>亿元</h4></td>
                    <td></td>
                    <td><?php echo $shop['year_turnover2']; ?>亿元</td>
                </tr>
            </table>
            <div style="border:1px solid #292B34"></div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
    </div>

    <div class="info-box">
        <h3 class="black">全国最差店面情况</h3>

        <div style="padding-left: 40px;">

            <?php if(is_array($worst_shop) || $worst_shop instanceof \think\Collection || $worst_shop instanceof \think\Paginator): $k = 0; $__LIST__ = $worst_shop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shop): $mod = ($k % 2 );++$k;?>
            <table class="black" style="width: 100%;">
                <tr height="40px;">
                    <td width="100px"><h4>序号</h4></td>
                    <td><h4><?php echo $k; ?></h4></td>
                    <td></td>
                    <td width="100px">城市</td>
                    <td><?php echo $shop['city']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>合作商场</h4></td>
                    <td><h4><?php echo $shop['coopreation_area']; ?></h4></td>
                    <td></td>
                    <td>所属商圈</td>
                    <td><?php echo $shop['belong_area']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>开店时间</h4></td>
                    <td><h4><?php echo $shop['openning_hours']; ?></h4></td>
                    <td></td>
                    <td>品牌</td>
                    <td><?php echo $shop['brand_name']; ?></td>
                </tr>
                <tr height="40px;">
                    <td><h4>年营业额</h4></td>
                    <td><h4><?php echo $shop['year_turnover1']; ?>亿元</h4></td>
                    <td></td>
                    <td><?php echo $shop['year_turnover2']; ?>亿元</td>
                </tr>
            </table>
            <div style="border:1px solid #292B34"></div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
    </div>

</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>