define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'zhaoshang/brandlist/index',
                    add_url: 'zhaoshang/brandlist/add',
                    edit_url: 'zhaoshang/brandlist/edit',
                    del_url: 'zhaoshang/brandlist/del',
                    multi_url: 'zhaoshang/brandlist/multi',
                    table: 'brand',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'cn_name', title: __('Cn_name')},
                        {field: 'en_name', title: __('En_name')},
                        {field: 'tel', title: __('Tel')},
                        {field: 'brand_address', title: __('Brand_address')},
                        {field: 'tag_id', title: __('Tag_id')},
                        {field: 'count_num', title: __('Count_num')},
                        {field: 'brand_level', title: __('Brand_level')},
                        {field: 'brand_model', title: __('Brand_model')},
                        {field: 'status', title: __('Status')},
                        {field: 'pro_person', title: __('Pro_person')},
                        {field: 'add_member', title: __('Add_member')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange'},
                        // {field: 'brandtags.id', title: __('Brandtags.id')},
                        {field: 'brandtags.tag_name', title: __('Brandtags.tag_name')},
                        {field: 'brandtags.floor', title: __('Brandtags.floor')},
                        // {field: 'brandtags.fuze_person', title: __('Brandtags.fuze_person')},
                        // {field: 'brandtags.fuze_per_tel', title: __('Brandtags.fuze_per_tel')},
                        // {field: 'brandtags.contact_person', title: __('Brandtags.contact_person')},
                        // {field: 'brandtags.contact_per_tel', title: __('Brandtags.contact_per_tel')},
                        // {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                        //操作栏,默认有编辑、删除或排序按钮,可自定义配置buttons来扩展按钮
                        {
                            field: 'operate',
                            width: "120px",
                            title: __('Operate'),
                            table: table,
                            events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'detail',
                                    title: __('查看详细信息'),
                                    classname: 'btn btn-xs btn-primary btn-dialog',
                                    icon: 'fa fa-list',
                                    url: 'zhaoshang/brandlist/detail',
                                },
                                {
                                    name: 'created',
                                    title: __('审核流程'),
                                    classname: 'btn btn-xs btn-success btn-dialog',
                                    icon: 'fa fa-magic',
                                    url: 'zhaoshang/brandlist/created',
                                }
                            ],

                            formatter: Table.api.formatter.operate
                        },
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        detail: function () {
            $(document).on('click', '.btn-callback', function () {
                Fast.api.close($("input[name=callback]").val());
            });
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});