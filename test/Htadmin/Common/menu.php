<?php

global $mem;
//55代表开发配置，11代表功能不用
$mem = array(
    array
        (
        "全局", array(
            array(
                "全局设置", array(
                    array("欢迎首页", "home_welcome.html", 1),
                    array("微信网站", "home_web.html", 1),
                    array("支付接口", "home_pay.html", 1),
                    array("微信绑定设置", "weix_index.html", 1),
                )
            ),
            array(
                "在线通知", array(
                    array("短信配置", "home_dx.html", 1),
                    array("短信模板设置", "gg_email.html?qy=2", 1),
                )
            ),
            array(
                "系统工具", array(
                    array("更新缓存", "home_delhc.html", 1),
                //array("计划任务", "syst_corns.html", 1),
                //array("IP锁定设置", "syst_iplock.html", 1),
                //array("过滤词管理", "syst_keyword.html", 1),
                //array("清理数据信息", "syst_dell.html", 1)
                )
            )
        )
    ),
    array
        (
        '数据中心',
        array
            (
            array(
                "项目管理", array(
                    array("项目审核", "pro_apply.html", 1),
                    array("项目列表", "pro_subject.html", 1),
                    array("项目汇总", "pro_hz.html", 1),
                    array("服务员汇总", "pro_fwhz.html", 1),
                    array("红包发送记录", "pro_jl.html", 1),
                )
            ),
            array(
                "酒店管理", array(
                    array("酒店信息", "pro_hotel.html", 1),
                    array("部门信息", "pro_part.html", 1),
                )
            )
        )
    ),
    array
        (
        '会员管理',
        array
            (
            array(
                '账号管理', array(
                    array("领班账号", "user.html", 1),
                    array("服务员列表", "user_waiter.html", 1),
                    array("领班余额流水记录", "user_jl.html", 1),
                    array('服务员等级', 'user_level.html', 1)
                ),
            ),
        )
    ),
    array
        (
        '权限设置',
        array
            (
            array(
                "管理权限", array(
                    array("增加权限组", "admin_group.html", 1),
                    array("编辑组权限", "admin_groupl.html", 1),
                    array("增加管理员", "admin_addmanager.html", 1),
                    array("管理员列表", "admin_index.html", 1),
                    array("后台操作日志", "admin_logg.html", 1),
                )
            )
        )
    )
);
foreach ($mem as $key => $v) {
    if (isset($mem[$key][1]))
        ksort($mem[$key][1]);
}
