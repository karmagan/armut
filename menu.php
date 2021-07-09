<?php
session_start();
$_SESSION['user'] = $_POST['id'];
$_SESSION['passwd'] = $_POST['passwd'];


?>
<html>

<head>
    <title>.:: Academic Record Management Utility ::.</title>
    <link rel="stylesheet" type="text/css" href="style1.css" />
    <link rel="icon" href="icon.gif" type="image/gif" />
    <script type="text/javascript" src="functions.js"></script>
</head>

<body>
    <?php
    include('connect.php');
    ?>

    <div style="width:1000px;margin:auto">
        <table style="width:950px;margin:auto;border: 2px solid #6495ed;">
            <tr class="maintable" style="vertical-align:top">
                <td colspan="5">

                    <ul id="sddm">
                        <li><a href="#" onmouseover="mopen('m1')" onclick="mopen('m1')" onmouseout="mclosetime()">Assessments</a>
                            <div id="m1" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
                                <a href="#" onclick="show('studentList.php', 'mainBody');mclose()">Student List</a>
                                <hr>
                                <a href="#" onclick="show('assessmentList.php', 'mainBody');mclose()">Assessment List</a>
                                <a href="#" onclick="show('assessmentEnter.php', 'mainBody');mclose()">Enter new Assessment</a>
                                <a href="#" onclick="show('assessmentCorrection.php', 'mainBody');mclose()">Delete Assessment</a>
                                <hr>
                                <a href="#" onclick="show('subteacherEnter.php', 'mainBody');mclose()">Subject Registration</a>
                                <a href="#" onclick="show('subteacherCorrect.php', 'mainBody');mclose()">Subject Correction</a>
                                <a href="#" onclick="show('substuCorrection.php', 'mainBody');mclose()">De-register Student</a>
                                <hr>
                                <a href="#" onclick="show('termmarks.php', 'mainBody');mclose()">Enter Term Mark</a>

                            </div>
                        </li>
                        <li><a href="#" onmouseover="mopen('m2')" onclick="mopen('m2')" onmouseout="mclosetime()">Merit/Demerit</a>
                            <div id="m2" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
                                <a href="#" onclick="show('meritsEnter.php', 'mainBody');mclose()">Enter Merit Demerit</a>
                                <a href="#" onclick="show('meritsCorrection.php', 'mainBody');mclose()">Merit Demerit Correction</a>
                                <hr>
                                <a href="#" onclick="show('serveddetentionEnter.php', 'mainBody');mclose()">Enter Served Detention</a>
                                <a href="#" onclick="show('badgeList.php', 'mainBody');mclose()">Badge List</a>
                                <a href="#" onclick="show('meritSummary.php', 'mainBody');mclose()">Total Merits</a>
                                <a href="#" onclick="show('meritDetailed.php', 'mainBody');mclose()">Detailed Merits</a>
                                <a href="#" onclick="show('meritDetailedWeek.php', 'mainBody');mclose()">Detailed Merits Last Week</a>

                            </div>
                        </li>
                        <li><a href="#" onclick="mopen('m3')" onmouseover="mopen('m3')" onmouseout="mclosetime()">Send SMS</a>
                            <div id="m3" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">


                                <a href="#" onclick="show('smsEnter.php', 'mainBody');mclose()">SMS to students</a>
                                <a href="#" onclick="show('smsStaffEnter.php', 'mainBody');mclose()">SMS to staff</a>

                            </div>
                        </li>
                        <li><a href="#" onclick="mopen('m4')" onmouseover="mopen('m4')" onmouseout="mclosetime()">Absent/Late</a>
                            <div id="m4" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">

                                <a href="#" onclick="show('absentEnter.php', 'mainBody');mclose()">Absent Learners</a>
                                <a href="#" onclick="show('lateEnter.php', 'mainBody');mclose()">Late Comers</a>
                                <hr>
                                <a href="#" onclick="show('absentCorrection.php', 'mainBody');mclose()">Absent Correction</a>
                                <a href="#" onclick="show('lateCorrection.php', 'mainBody');mclose()">Late Correction</a>

                            </div>
                        </li>
                        <li>
                            <a href="#" style="width:120px;" onclick="mopen('m5')" onmouseover="mopen('m5')" onmouseout="mclosetime()">Weekly Newsletter</a>
                            <div id="m5" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">


                                <a href="#" onclick="show('weeklyEnter.php', 'mainBody');mclose()">Write Newsletter</a>
                                <hr>
                                <a href="weeklynewsletter.php?grade=6" target="_blank" onclick="mclose()">See Newsletter for grd6</a>
                                <a href="weeklynewsletter.php?grade=7" target="_blank" onclick="mclose()">See Newsletter for grd7</a>
                                <a href="weeklynewsletter.php?grade=8" target="_blank" onclick="mclose()">See Newsletter for grd8</a>
                                <a href="weeklynewsletter.php?grade=9" target="_blank" onclick="mclose()">See Newsletter for grd9</a>
                                <a href="weeklynewsletter.php?grade=10" target="_blank" onclick="mclose()">See Newsletter for grd10</a>
                                <a href="weeklynewsletter.php?grade=11" target="_blank" onclick="mclose()">See Newsletter for grd11</a>
                                <a href="weeklynewsletter.php?grade=12" target="_blank" onclick="mclose()">See Newsletter for grd12</a>

                            </div>
                        </li>

                        <li><a href="#" onclick="mopen('m6')" onmouseover="mopen('m6')" onmouseout="mclosetime()">Help</a>
                            <div id="m6" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">

                                <a href="#" onclick="show('personal.php', 'mainBody');mclose()">Personal</a>
                                <a href="#" onclick="show('help.php', 'mainBody');mclose()">Help</a>
                            </div>
                        </li>
                        <li><a href="#" onclick="mopen('m7')" onmouseover="mopen('m7')" onmouseout="mclosetime()">Library</a>
                            <div id="m7" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">

                                <a href="#" onclick="show('bookLendEnter.php', 'mainBody');mclose()">Lend a Book</a>
                                <a href="#" onclick="show('bookReturnEnter.php', 'mainBody');mclose()">Return a Book</a>

                            </div>
                        </li>



                    </ul>
                    <div style="clear:both"></div>

                </td>
            </tr>
            <tr class="maintable" style="vertical-align:top">

                <td colspan="1" style="text-align:right"><img src="" alt="logo"></td>
                <td colspan="2" style="text-align:left">
                    <strong><span style="font-size: larger;"><span style="font-size: larger;">School</span></span></strong>
                    <br>
                    <span style="font-size: larger;">Student Record Database</span>
                    <br>
                    <span style="font-size: smaller;">Teacher's Console<br> v0.9.13<br>6/9/2011</span>
                </td>

                <td colspan="2" style="text-align:right">
                    <?php printf("Welcome %s %s", $row['Name'], $row['Surname']); ?>
                    <br><a href="index.php" target="_top">LOGOUT</a>
                    <br><a href="help.html" target="_blank">Help</a>
                </td>
            </tr>


            <tr class="maintable" style="vertical-align:top">
                <td colspan="5">
                    <div id="mainBody" style="text-align:center;">
                        <h2>Welcome to <br></h2>If the page does not work correctly try pressing "F5" key on your
                        keyboard to refresh the page.



                    </div>


                </td>
            </tr>
        </table>

    </div>