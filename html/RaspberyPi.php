<html>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<style>
		.button {
		  background-color: #ff9800;  
		  border-radius: 5px;
		  color: white;
		  padding: .5em;
		  text-decoration: none;
		  height:100%;
		  display:inline-table;
		  font-family: system-ui;
		}
		
		.button:focus,
		.button:hover {
		  background-color: #007bff;
		  color: White;
		}
		
		.buttonDefault {
		  background-color: #04AA6D;  
		  border-radius: 5px;
		  color: white;
		  padding: .5em;
		  text-decoration: none;
		  height:100%;
		  display:inline-table;
		  font-family: system-ui;
		}
		.buttonDefault:focus,
		.buttonDefault:hover {
		  background-color: #007bff;
		  color: White;
		}
		
		.buttonRed {
		  background-color: #f44336;  
		  border-radius: 5px;
		  color: white;
		  padding: .5em;
		  text-decoration: none;
		  height:100%;
		  display:inline-table;
		  font-family: system-ui;
		}
		.buttonRed:focus,
		.buttonRed:hover {
		  background-color: #007bff;
		  color: White;
		}
		.titlehead {
		  background-color: #003263;  
		  border-radius: 5px;
		  color: white;
		  padding: .5em;
		  text-decoration: none;
		  text-align: center;
		  margin-top: -10px;
		  margin-bottom: -10px;
		  font-family: system-ui;
		}

		.titlehead:focus,
		.titlehead:hover {
		  background-color: #007bff;
		  color: White;
		}
		.bg {
		  background-color: black;
		  background-position: center;
		  background-size: cover;
		}
		.label {
  			color: white;
  			padding: 7px;
  			font-family: Arial;
		}
		.success {background-color: #04AA6D;} /* Green */
		.info {background-color: #2196F3;} /* Blue */
		.warning {background-color: #ff9800;text-align: right;} /* Orange */
		.danger {background-color: #f44336;} /* Red */ 
		.other {background-color: #e7e7e7; color: black;} /* Gray */ 
		select {
 font-size: 20px;
    	}
    	select:focus {
        	min-width: 150px;
        	width: auto;
    	}
	</style>
	<head>
		<title>Raspberry Pi</title>
		<script>
			function SetNetwork(device,OpType){
                    var sid="dummy";
                    var pwd="dummy";
				if (device=='wlan' && OpType=='enable'){
                    sid=document.getElementById('SSID').value;
                    pwd=document.getElementById('password').value;
                    if (sid === "" || pwd === "") {
                        alert("Valid Ssid and password please");
                        return;
                    }
                }
    			var hr = new XMLHttpRequest();
    			const url = "script.php";
    			const vars = "value="+"Network"+"&device="+encodeURIComponent(device)+"&OpType="+encodeURIComponent(OpType)+"&sid="+encodeURIComponent(sid)+"&pwd="+encodeURIComponent(pwd);
    			hr.open("POST", url, true);
    			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    			hr.onreadystatechange = function() {
	    			if(hr.readyState == 4 && hr.status == 200) {
                        alert(hr.responseText+'Will reflect on restarting the PS4');
	    			}
	    			location.reload();
    			}
    			hr.send(vars);
    			
			}
			function postCommand(val){
    			var hr = new XMLHttpRequest();
    			const url = "script.php";
    			const vars = "value="+encodeURIComponent(val);
    			hr.open("POST", url, true);
    			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    			hr.onreadystatechange = function() {
	    			if(hr.readyState == 4 && hr.status == 200) {
		    			alert(val+' Command has been executed');
	    			}
    			}
    			hr.send(vars);
			}
			function updatePass(){
                var passType=document.getElementById('PasswordReset').value;
				var Rootpwd=document.getElementById('WifiRootpwd').value;
				if (Rootpwd === "") {
					alert("Valid password please");
				    return;
				}
    			var hr = new XMLHttpRequest();
    			const url = "script.php";
    			const vars = "value="+encodeURIComponent(passType)+"&pwd="+encodeURIComponent(Rootpwd);
    			hr.open("POST", url, true);
    			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    			hr.onreadystatechange = function() {
	    			if(hr.readyState == 4 && hr.status == 200) {
		    			alert(hr.responseText);
	    			}
	    			location.reload();
    			}
    			hr.send(vars);
			}
			function IdleTimerUpdate(OpType){
                var Timer=document.getElementById('IdleTimer').value;
				if ((parseInt(Timer) <"180" || parseInt(Timer) >"3600") && OpType ==="start") {
					alert("Please enter a value between 180 to 3600 !!!");
				    return;
				}
    			var hr = new XMLHttpRequest();
    			const url = "script.php";
    			const vars = "value="+"IdleTimer"+"&OpType="+encodeURIComponent(OpType)+"&Timer="+encodeURIComponent(Timer);
    			hr.open("POST", url, true);
    			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    			hr.onreadystatechange = function() {
	    			if(hr.readyState == 4 && hr.status == 200) {
                        var resp=hr.responseText;
                        if(resp.trim()===""){
                            resp="Unable to "+OpType+" the service";
                        }
		    			alert(resp);
	    			}
	    			location.reload();
    			}
    			hr.send(vars);
			}
			
			function AutoJBUpdate(opType){
    			var hr = new XMLHttpRequest();
    			const url = "script.php";
    			const vars = "value="+"AutoJb"+"&opType=IPUpdate"+"&opVal="+encodeURIComponent(opType);
    			hr.open("POST", url, true);
    			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    			hr.onreadystatechange = function() {
	    			if(hr.readyState == 4 && hr.status == 200) {
                        var resp=hr.responseText;
                        if(resp.trim()===""){
                            resp="Unable to "+opType+" the Auto Jailbreak";
                        }
		    			alert(resp);
	    			}
	    			location.reload();
    			}
    			hr.send(vars);
			}
			
			function driveUpdates(opType){
                progress.innerHTML="Updating drive , Please wait...";
                var LinSize="0";
                if ( opType ==="Fat32Exfat"){
                    MaxAvail=<?php echo exec("awk '{print $1/2097152}' /sys/class/block/mmcblk0/size") ?>;
                    LinSize=document.getElementById('driveUpdateLinSize').value;
                    if ((parseInt(LinSize) <"1" || parseInt(LinSize) >(parseInt(MaxAvail)-1) )) {
                        alert("Please enter a value between 1 to "+(parseInt(MaxAvail)-1) +" !!!");
                        return;
                    }
                }
    			var hr = new XMLHttpRequest();
    			const url = "script.php";
    			const vars = "value="+"DriveUpdate"+"&opType="+encodeURIComponent(opType)+"&opValue="+encodeURIComponent(LinSize);
    			hr.open("POST", url, true);
    			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    			hr.onreadystatechange = function() {
	    			if(hr.readyState == 4 && hr.status == 200) {
                        var resp=hr.responseText;
		    			alert(resp);
	    			}
	    			location.reload();
    			}
    			hr.send(vars);
			}
			
			function usbLoading(driveName){
    			var hr = new XMLHttpRequest();
    			const url = "script.php";
    			const vars = "value=LoadVirtualUSB"+"&driveName="+encodeURIComponent(driveName);
    			hr.open("POST", url, true);
    			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    			hr.onreadystatechange = function() {
	    			if(hr.readyState == 4 && hr.status == 200) {
		    			alert(' USB has been Loaded :)');
	    			}
    			}
    			hr.send(vars);
			}
			
		</script>
	</head>
	<body class="bg">
		<h1 id="progress" class="titlehead">Pi - <?php echo $_SERVER['SERVER_ADDR'] ?> || PS4 - <?php echo $_SERVER['REMOTE_ADDR'] ?></h1><hr><br>
		<div>
			<table align="center" style="width:1000px;margin-top:30px;">
            <tr>
            <td align="center">
			<?php $NetwrokModecmd = shell_exec('sudo /bin/ls -l /etc/init.d/S90hostapd');?>
			<?php if (substr( $NetwrokModecmd, 0, 4 ) ===  '-rw-') : ?>
			<a href="#" class="buttonDefault" onclick="SetNetwork('wlan','Router'); return false">Default Wifi Server</a>
			<?php endif; ?>
			
			<?php if (exec('cat /etc/network/interfaces | grep "wlan0 inet dhcp"') ) : ?>
			<br><br>
			<a href="#" class="buttonRed" onclick="SetNetwork('wlan','disable'); return false">Wifi-Disable</a>
			<?php else : ?>
			<br><br><br>
			<label class="label info" for="fname">Wifi SSID and Pwd</label><br><br>
			<select name="SSID" id="SSID">
			<?php
				exec("sudo /sbin/iwlist wlan0 scan | grep -w 'ESSID\|Quality' | sed '$!N;s/\\n/\\t/'", $wifiSidList, $retval);
				$wifiArray = array();
				foreach ($wifiSidList as $value) {
                    array_push($wifiArray, substr($value,strpos($value, 'Quality')+8,2). str_replace('"',"",substr($value,strpos($value, 'ESSID')+6)));
				}
				rsort($wifiArray);
				foreach ($wifiArray as $value) {
                     echo '<option value="'.substr($value,2).'">'.substr($value,2,22).'</option>';
				}
			?>
			</select>
			<br><br>
		    <input type="text" size=18  style="font-size:12pt;"id="password" name="password" value="">
			<br><br>
			<a href="#" class="buttonDefault" onclick="SetNetwork('wlan','enable'); return false">Wifi-Enable</a>
			<?php endif; ?>
			<?php
                $devModel = shell_exec("cat /proc/cpuinfo | grep 'Model.*' |cut -c 10-");
                if(strpos($devModel,'Pi 4 Model B')!==false){
                    echo '<br><br><br>';
                    if (exec('cat /etc/network/interfaces | grep "eth0 inet dhcp"')) {
                        echo '<a href="#" class="buttonRed" onclick="SetNetwork('."'lan','disable'); return false".'">Eth-Disable</a>';
                    } 
                    else{
                        echo '<a href="#" class="buttonDefault" onclick="SetNetwork('."'lan','enable'); return false".'">Eth-Enable</a>';
                    }
                }
            ?>
			</td>
			<td  align="center" >
			<label class="label info" for="fname">Wifi / Root Pwd update</label><br><br>
            <select name="PasswordReset" id="PasswordReset">
            <option value="WifiPass-PiZero">WifiPass-PiZero</option>
			<!--<option value="RootPassword">RootPassword</option>-->
			</select>
			<br><br>
			<input type="password" size=18  style="font-size:12pt;"id="WifiRootpwd" name="WifiRootpwd" value="">
            <br><br><a href="#" class="button" onclick="updatePass(); return false">Update</a>    
			</td>
			<td  align="center" >
			<label class="label info" align="right" for="fname">Idle Timer Shutdown(sec)</label><br><br>
			<?php
                $netTimeOut = exec('cat /etc/idleTimer.conf');
                 if ($netTimeOut == "" || $netTimeOut == "0"  ){
                        echo '<input type="number" min=180 max=3600  style="font-size:12pt;"id="IdleTimer" name="IdleTimer" value="180">';
                        echo '<br><br><a href="#" class="buttonDefault" onclick="IdleTimerUpdate('."'start'); return false".'">start</a>';
                    } else{
                        echo '<input type="number" min=180 max=3600  style="font-size:12pt;"id="IdleTimer" name="IdleTimer" value="'.$netTimeOut.'">';
                        echo '<br><br><a href="#" class="buttonRed" onclick="IdleTimerUpdate('."'stop'); return false".'">stop</a>';
                    }
			?>
			</td>
			</tr>
			</table>
			</div>
			<div>
			<br><br>
			<table align="center" style="width:1000px;margin-top:30px;">
			<tr>
			<td align="center">
				<a href="#" class="buttonRed" onclick="postCommand('Reboot'); return false">Reboot Pi</a>&nbsp;&nbsp;
				<a href="#" class="buttonRed" onclick="postCommand('Shutdown'); return false">Shutdown Pi</a>
			</td>
            <td align="center">
            <?php
                    $part4Size = exec("awk '{print $1}' /sys/class/block/mmcblk0p4/size");
                    
                    if($part4Size == "0" || $part4Size =="2"){
                        echo '<a href="#" class="button" onclick="usbLoading('."'/dev/mmcblk0p6'); return false".'">Use Exfat USB</a>&nbsp;&nbsp;';
                        echo '<a href="#" class="button" onclick="usbLoading('."'/dev/mmcblk0p5'); return false".'">Use Fat32 USB</a>&nbsp;&nbsp;';
                        
                    }else{
                        echo '<a href="#" class="button" onclick="usbLoading('."'/dev/mmcblk0p4'); return false".'">Use Exfat USB</a>&nbsp;&nbsp;';
                    }
            ?>
				
				<a href="#" class="buttonRed" onclick="postCommand('RemoveUSB'); return false">USB Remove</a>
            </td>
            <td align="center">
				<?php
                    $autoJBconf = exec('cat /etc/autoJB.conf');
                    if($autoJBconf == "no"){
                        echo '<a href="#" class="buttonDefault" onclick="AutoJBUpdate('."'enable'); return false".'">Auto JB Enable</a>';
                    } else{
                        echo '<a href="#" class="buttonRed" onclick="AutoJBUpdate('."'disable'); return false".'">Auto JB Disable</a>';
                    }
                ?>
            </td>
			</tr>
			<tr>
			<td align="center" colspan="3">
                <?php
                    $part4Size = exec("awk '{print $1}' /sys/class/block/mmcblk0p4/size");
                    if($part4Size == "0" || $part4Size =="2"){
                        echo '<br><a href="#" class="buttonDefault" onclick="driveUpdates('."'Exfat'); return false".'">ExFat Only</a><br>';
                        echo '<font  style="color:white;">Note: Using this will delete existing Exfat/Fat32 drives inside SD card</font>';
                    } else{
                        $partSize = exec("awk '{print $1/2097152}' /sys/class/block/mmcblk0/size");
                        if (intval( $partSize )>1){
                            echo '<br><a href="#" class="buttonDefault" onclick="driveUpdates('."'Fat32Exfat'); return false".'">ExFat and Fat32</a>&nbsp;&nbsp;';
                            echo '<input type="number" min=1 max='.(intval($partSize)-1).'  style="font-size:12pt;"id="driveUpdateLinSize" name="driveUpdateLinSize" value="'.(intval($partSize)-1).'">&nbsp;&nbsp;';
                            echo '<label class="label info" for="fname">(Size in GB)</label><br>';
                            echo '<font  style="color:white;">Note: Using this will delete existing Exfat/Fat32 drives inside SD card</font>';
                        }
                    }
                ?>
			</td>
			</tr>
			</table>
			</div>
	</body>
</html>
