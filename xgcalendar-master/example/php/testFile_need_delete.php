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
    <div id="bbit-cal-buddle" style="z-index: 990; width: 400px;visibility:hidden;" class="bubble">
        <table class="bubble-table" cellSpacing="0" cellPadding="0"><tbody>
            <tr>
                <td class="bubble-cell-side">
                    <div id="tl1" class="bubble-corner"><div class="bubble-sprite bubble-tl"></div></div>
                    <td class="bubble-cell-main">
                        <div class="bubble-top"></div>
                        <td class="bubble-cell-side">
                            <div id="tr1" class="bubble-corner">
                                <div class="bubble-sprite bubble-tr"></div></div>
                                <tr>
                                    <td class="bubble-mid" colSpan="3">
                                        <div style="overflow: hidden" id="bubbleContent1">
                                            <div>
                                                <div></div>
                                                <div class="cb-root">
                                                    <table class="cb-table" cellSpacing="0" cellPadding="0"><tbody>
                                                        <tr><th class="cb-key">时  间:</th>
                                                            <td class=cb-value>
                                                                <div id="bbit-cal-buddle-timeshow"></div>
                                                            </td>
                                                        </tr>
                                                        <tr><th class="cb-key">内 容:</th>
                                                            <td class="cb-value">
                                                                <div class="textbox-fill-wrapper">
                                                                    <div class="textbox-fill-mid">
                                                                        <input id="bbit-cal-what" class="textbox-fill-input"/>
                                                                    </div>
                                                                </div>
                                                                <div class="cb-example"></div>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                    <input id="bbit-cal-start" type="hidden"/>
                                                    <input id="bbit-cal-end" type="hidden"/>
                                                    <input id="bbit-cal-allday" type="hidden"/>
                                                    <input id="bbit-cal-quickAddBTN" value="创建日志" type="button"/>&nbsp; 
                                                    <SPAN id="bbit-cal-editLink" class="lk">修改日志详细信息 <StrONG>»</StrONG></SPAN>
                                                </div>
                                            </div>
                                        </div>
                                        <tr>
                                            <td><div id="bl1" class="bubble-corner"><div class="bubble-sprite bubble-bl"></div></div>
                                                <td><div class="bubble-bottom"></div>
                                                    <td><div id="br1" class="bubble-corner"><div class="bubble-sprite bubble-br"></div></div>
                                                    </tr>
                                                </tbody></table>
                                                <div id="bubbleClose1" class="bubble-closebutton"></div>
                                                <div id="prong2" class="prong"><div class=bubble-sprite></div>
                                            </div>
                                        </div>
                                    </body>
                                    </html>