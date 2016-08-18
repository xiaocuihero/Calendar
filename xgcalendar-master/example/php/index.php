<?php
ob_start();
require_once ("includes/commons.inc");
require_once ("resources/i18n.php");
ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <title><?php echo msg("title"); ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="static/theme/Default/main.css" rel="stylesheet" type="text/css" />
    <link href="static/theme/Default/dailog.css" rel="stylesheet" type="text/css" />
    <link href="static/theme/Default/calendar.css" rel="stylesheet" type="text/css" /> 
    <link href="static/theme/Default/dp.css" rel="stylesheet" type="text/css" />   
    <link href="static/theme/Default/alert.css" rel="stylesheet" type="text/css" />     
    <link href="static/theme/Shared/blackbird.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div>
        <div id="calhead" style="padding-left:1px;padding-right:1px;">                      
            <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;"><?php echo ucfmsg("loaddatamsg"); ?></div>
            <div id="errorpannel" class="ptogtitle loaderror" style="display: none;"><?php echo ucfmsg("defaulterrormsg"); ?></div>
        </div>          

        <div id="caltoolbar" class="ctoolbar">
            <div class="btnseparator"></div>
            <div id="showtodaybtn" class="fbutton">
                <div><span title='<?php echo ucfmsg("today_title"); ?> ' class="showtoday">
                    <?php echo ucfmsg("today"); ?></span></div>
                </div>          
                <div  id="showmonthbtn" class="fbutton fcurrent">
                    <div><span title='<?php echo ucfmsg("month") ?>' class="showmonthview"><?php echo ucfmsg("month"); ?></span></div>
                </div>
                <div class="btnseparator"></div>
                <div  id="showreflashbtn" class="fbutton">
                    <div><span title='<?php echo ucfmsg("refresh_title") ?>' class="showdayflash"><?php echo ucfmsg("refresh"); ?></span></div>
                </div>
                <div class="btnseparator"></div>
                <div id="sfprevbtn" title="<?php echo ucfmsg("prev_title"); ?>"  class="fbutton">
                    <span class="fprev"></span>
                </div>
                <div id="sfnextbtn" title="<?php echo ucfmsg("next_title"); ?>" class="fbutton">
                    <span class="fnext"></span>
                </div>
                <div class="fshowdatep fbutton">
                    <div>
                        <input type="hidden" name="txtshow" id="hdtxtshow" />
                        <span id="txtdatetimeshow">加载</span>
                    </div>
                </div>
                <div class="btnseparator">
                    <div class="myPlan" id="planContainer">
                        <input type='checkbox' id="planCheckBox">计划
                    </div>
                </div>            
                <div class="btnseparator">
                    <div class="myFinish" id="finishContainer">
                        <input type='checkbox' id="finishCheckBox">完成
                    </div>
                </div>       
                <div class="clear"></div>                
            </div>
        </div>
        <div style="padding:1px;">
            <div class="t1 chromeColor">
                &nbsp;</div>
                <div class="t2 chromeColor">
                    &nbsp;</div>
                    <div id="dvCalMain" class="calmain printborder">
                        <div id="gridcontainer" style="overflow-y: visible;">
                        </div>
                    </div>
                    <div class="t2 chromeColor">
                        &nbsp;</div>
                        <div class="t1 chromeColor">
                            &nbsp;
                        </div>   
                    </div>
                </div>
                <script src="static/javascripts/jquery.min.js" type="text/javascript"></script>  
                <script src="static/javascripts/Common.js" type="text/javascript"></script>    
                <script src="static/javascripts/lib/blackbird.js" type="text/javascript"></script> 
                <script src="<?php echo msg("datepicker_langpack_url"); ?>" type="text/javascript"></script>     
                <script src="static/javascripts/Plugins/jquery.datepicker.js" type="text/javascript"></script>
                <script src="static/javascripts/Plugins/jquery.alert.js" type="text/javascript"></script>    
                <script src="static/javascripts/Plugins/jquery.ifrmdailog.js" defer="defer" type="text/javascript"></script>
                <script src="<?php echo msg("calendar_langpack_url"); ?>" type="text/javascript"></script>  
                <script src="static/javascripts/Plugins/xgcalendar.js?v=1.2.0.4" type="text/javascript"></script>   
                <script type="text/javascript">


                    function GetQueryString(name)
                    {
                        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
                        var r = window.location.search.substr(1).match(reg);
                        if (r != null)
                            return  unescape(r[2]);
                        return null;
                    }
                    $(document).ready(function () {
                //[id,title,start,end，全天日程，跨日日程,循环日程,theme,'','']   
                <?php
                @session_start();
                $_SESSION['pid'] = $_GET['pid'];
                $role = $_SESSION['role'];
                if ($role == 0) {
                    $_SESSION['nu'] = $_GET['nu'];
                } else {
                    $_SESSION['nu'] = 0;
                }

                include("_part.php");
                ?>
                var view = "month";
                var op = {
                    view: view,
                    theme: 3,
                    showday: new Date(),
                    EditCmdhandler: Edit,
                    DeleteCmdhandler: Delete,
                    ViewCmdhandler: View,
                    onWeekOrMonthToDay: wtd,
                    onBeforeRequestData: cal_beforerequest,
                    onAfterRequestData: cal_afterrequest,
                    onRequestDataError: cal_onerror,
                    url: "calendar.php?mode=get&pid=" + GetQueryString("pid"),
                    quickAddUrl: "calendar.php?mode=quickadd&pid=" + GetQueryString("pid"),
                    quickUpdateUrl: "calendar.php?mode=quickupdate&pid=" + GetQueryString("pid"),
                    quickDeleteUrl: "calendar.php?mode=quickdelete&pid=" + GetQueryString("pid") //快速删除日程的
                    /* timeFormat:" hh:mm t", //t表示上午下午标识,h 表示12小时制的小时，H表示24小时制的小时,m表示分钟
                    tgtimeFormat:"ht" //同上 */
                };
                var $dv = $("#calhead");
                var _MH = document.documentElement.clientHeight;
                var dvH = $dv.height() + 2;
                op.height = _MH - dvH;
                op.eventItems = __CURRENTDATA;
                var planOrFinish = new Array();
                var dateTime = new Date();
                planOrFinish["plan"] = "1";
                planOrFinish["finish"] = "1";
                op.extParam = planOrFinish;

                var p = $("#gridcontainer").bcalendar(op).BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
                $("#caltoolbar").noSelect();

                $("#hdtxtshow").datepicker({picker: "#txtdatetimeshow", showtarget: $("#txtdatetimeshow"),
                    onReturn: function (r) {
                        var p = $("#gridcontainer").BCalGoToday(r).BcalGetOp();
                        if (p && p.datestrshow) {
                            $("#txtdatetimeshow").text(p.datestrshow);
                        }
                    }
                });
                function cal_beforerequest(type)
                {
                    var t = "<?php echo ucfmsg("loaddatamsg") ?>";
                    switch (type)
                    {
                        case 1:
                        t = "<?php echo ucfmsg("loaddatamsg"); ?>";
                        break;
                        case 2:
                        case 3:
                        case 4:
                        t = "<?php echo ucfmsg("processdatamsg"); ?>";
                        break;
                    }
                    $("#errorpannel").hide();
                    $("#loadingpannel").html(t).show();
                }
                function cal_afterrequest(type)
                {
                    switch (type)
                    {
                        case 1:
                        $("#loadingpannel").hide();
                        break;
                        case 2:
                        case 3:
                        case 4:
                        $("#loadingpannel").html("<?php echo ucfmsg("successmsg"); ?>");
                        window.setTimeout(function () {
                            $("#loadingpannel").hide();
                        }, 2000);
                        break;
                    }

                }
                function cal_onerror(type, data)
                {
                    $("#errorpannel").show();
                }
                function Edit(data)
                {
                    var eurl = "myEditWindow.php";
                    if (data)
                    {
                        var url = eurl + "?id=" + data[0] + "&name=" + data[1] + "&category=" + data[7];
                        console.log(url);
                        OpenModelWindow(url, {width: 600, height: 400, caption: "<?php echo ucfmsg("editcalendar"); ?>", onclose: function () {
                        }});
                    }
                }
                function View(data)
                {
                    var str = "";
                    $.each(data, function (i, item) {
                        str += "[" + i + "]: " + item + "\n";
                    });
                    alert(str);
                }
                function Delete(data, callback)
                {
                    $.alerts.okButton = "<?php echo ucfmsg("ok"); ?>";
                    $.alerts.cancelButton = "<?php echo ucfmsg("cancel"); ?>";
                    hiConfirm("<?php echo ucfmsg("deleteconfirm"); ?>", '<?php echo ucfmsg("confirm"); ?>', function (r) {
                        r && callback(0);
                    });
                }
                function wtd(p)
                {
                    if (p && p.datestrshow) {
                        $("#txtdatetimeshow").text(p.datestrshow);
                    }
                    $("#caltoolbar div.fcurrent").each(function () {
                        $(this).removeClass("fcurrent");
                    })
                    $("#showdaybtn").addClass("fcurrent");
                }
                //显示日视图
                $("#showdaybtn").click(function (e) {
                    //document.location.href="#day";
                    $("#caltoolbar div.fcurrent").each(function () {
                        $(this).removeClass("fcurrent");
                    })
                    $(this).addClass("fcurrent");
                    var p = $("#gridcontainer").BCalSwtichview("day").BcalGetOp();
                    if (p && p.datestrshow) {
                        $("#txtdatetimeshow").text(p.datestrshow);
                    }
                });
                //显示周视图
                $("#showweekbtn").click(function (e) {
                    //document.location.href="#week";
                    $("#caltoolbar div.fcurrent").each(function () {
                        $(this).removeClass("fcurrent");
                    })
                    $(this).addClass("fcurrent");
                    var p = $("#gridcontainer").BCalSwtichview("week").BcalGetOp();
                    if (p && p.datestrshow) {
                        $("#txtdatetimeshow").text(p.datestrshow);
                    }

                });
                //显示月视图
                $("#showmonthbtn").click(function (e) {
                    //document.location.href="#month";
                    $("#caltoolbar div.fcurrent").each(function () {
                        $(this).removeClass("fcurrent");
                    })
                    $(this).addClass("fcurrent");
                    var p = $("#gridcontainer").BCalSwtichview("month").BcalGetOp();
                    if (p && p.datestrshow) {
                        $("#txtdatetimeshow").text(p.datestrshow);
                    }
                });

                $("#showreflashbtn").click(function (e) {
                    $("#gridcontainer").BCalReload();
                });

                //点击新增日程
                $("#faddbtn").click(function (e) {
                    var url = "";
                    OpenModelWindow(url, {width: 500, height: 400, caption: "<?php echo ucfmsg("addcalendar"); ?>"});
                });
                //点击回到今天
                $("#showtodaybtn").click(function (e) {
                    var p = $("#gridcontainer").BCalGoToday().BcalGetOp();
                    if (p && p.datestrshow) {
                        $("#txtdatetimeshow").text(p.datestrshow);
                    }


                });
                //上一个
                $("#sfprevbtn").click(function (e) {
                    var p = $("#gridcontainer").BCalPrev().BcalGetOp();
                    if (p && p.datestrshow) {
                        $("#txtdatetimeshow").text(p.datestrshow);
                    }
                });
                //下一个
                $("#sfnextbtn").click(function (e) {
                    var p = $("#gridcontainer").BCalNext().BcalGetOp();
                    if (p && p.datestrshow) {
                        $("#txtdatetimeshow").text(p.datestrshow);
                    }
                });
                $("#changetochinese").click(function (e) {
                    location.href = "?lang=zh-cn";
                });
                $("#changetoenglish").click(function (e) {
                    location.href = "?lang=en-us";
                });
                $("#changetoenglishau").click(function (e) {
                    location.href = "?lang=en-au";
                });

                $("#finishCheckBox").attr("checked","checked");
                $("#planCheckBox").attr("checked","checked");
                $("#planCheckBox").change(function(){                    
                    if(this.checked){
                        planOrFinish["plan"] = "1";
                    }else{
                        planOrFinish["plan"] = "0";
                    }
                    $("#planContainer").toggleClass("myPlan");
                    op.extParam = planOrFinish;
                    $("#gridcontainer").bcalendar(op).BcalGetOp();
                });
                $("#finishCheckBox").change(function(){                    
                    if(this.checked){
                        planOrFinish["finish"] = "1";
                    }else{
                        planOrFinish["finish"] = "0";
                    }
                    $("#finishContainer").toggleClass("myFinish");
                    op.extParam = planOrFinish;
                    $("#gridcontainer").bcalendar(op).BcalGetOp();
                });                
            });
        </script>
    </body>
    </html>

