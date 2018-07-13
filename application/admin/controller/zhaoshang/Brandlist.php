<?php

namespace app\admin\controller\zhaoshang;

use app\common\controller\Backend;

/**
 * 品牌申请
 *
 * @icon fa fa-circle-o
 */
class Brandlist extends Backend
{

    /**
     * Brand模型对象
     * @var \app\admin\model\Brand
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('Brand');

    }

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */


    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->with(['brandtags'])
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->with(['brandtags'])
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            foreach ($list as $row) {


            }
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    /**
     * 详情
     */
    public function detail($ids)
    {
        $join = [['zs_brand_tags tag', 'brand.tag_id = tag.id', 'LEFT']];
        $row = $this->model->get(['id' => $ids]);
        if (!$row)
            $this->error(__('No Results were found'));
        if ($this->request->isAjax()) {
            $this->success("Ajax请求成功", null, ['id' => $ids]);
        }

        $tag = db('BrandTags')->where('id', $row->tag_id)->find();
        $new_shop = db('BrandNewShop')->where('brand_id', $ids)->select();
        $model_shop = db('BrandModelShop')->where('brand_id', $ids)->select();
        $worst_shop = db('BrandWorstShop')->where('brand_id', $ids)->select();
        $goodsinfo = db('GoodsInfo')->where('brand_id', $ids)->select();
        $this->view->assign("row", $row->toArray());
        $this->assign('new_shop', $new_shop);
        $this->assign('model_shop', $model_shop);
        $this->assign('worst_shop', $worst_shop);
        $this->assign('goodsinfo', $goodsinfo);
        $this->assign('tag', $tag);
        return $this->view->fetch();
    }

    /*审批*/
    public function created($ids)
    {
        if ($this->request->isPost()) {
            $admin = session('admin');
            $status = array(
                10 => "通过审核",
                2 => '正在流转',
                41 => '已被驳回'
            );
            $post = input('post.');
            /*添加到留言表*/
            $content = input('post.content');
            $message['brand_id'] = $ids;
            $message['admin_nickname'] = $admin['nickname'];
            $message['admin_id'] = $admin['id'];
            $message['content'] = $content;
            $message['brand_sta'] = $post['brand_sta'];
            $message['action'] = $status[$post['brand_sta']];
            $message['createtime'] = date('Y-m-d H:i:s');
            db('BrandMessage')->insert($message);
            /*修改状态 处理人*/
            $brand['pro_person'] = $post['pro_person'];
            $brand['status'] = $post['brand_sta'];
            db('Brand')->where(array('id' => $ids))->update($brand);
            $this->success();
        } else {
            $admins = db('Admin')->field('id,nickname')->select();
            $message = db('BrandMessage')->where(array('brand_id' => $ids))->select();
            foreach ($admins as $v) {
                $admin[$v['id']] = $v['nickname'];
            }
            $this->assign('message', $message);
            $this->assign('admin', $admin);
            return $this->fetch();
        }

    }
}
