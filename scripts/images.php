<!DOCTYPE html>
<html>
<head><title>Photo Gallery</title>
    
    
    
<style>
.touchgallery{
position: relative;
overflow: hidden;
width: 350px; /* default gallery width */
height: 270px; /* default gallery height */
background: #eee;
}
 
.touchgallery ul{
list-style: none;
margin: 0;
padding: 0;
left: 0;
position: absolute;
-moz-transition: all 100ms ease-in-out; /* image transition. Change 100ms to desired transition duration */
-webkit-transition: all 100ms ease-in-out;
transition: all 100ms ease-in-out;
}
 
.touchgallery ul li{
float: left;
display: block;
width: 350px;
text-align: center;
}
 
.touchgallery ul li img{ /* CSS for images within gallery */
max-width: 100%; /* make each image responsive, so its native width can occupy up to 100% of gallery's width, but not beyond */
height: auto;
}

.thumbnail 
{
float:left;
width:75px;
height:100px;
margin:5px;
}
</style>

<script>

function ontouch(el, callback){

	var touchsurface = el,
			dir,
			swipeType,
			startX,
			startY,
			distX,
			distY,
			threshold = 150,
			restraint = 100,
			allowedTime = 500,
			elapsedTime,
			startTime,
			mouseisdown = false,
			detecttouch = !!('ontouchstart' in window) || !!('ontouchstart' in document.documentElement) || !!window.ontouchstart || !!window.Touch || !!window.onmsgesturechange || (window.DocumentTouch && window.document instanceof window.DocumentTouch),
			handletouch = callback || function(evt, dir, phase, swipetype, distance){}

	touchsurface.addEventListener('touchstart', function(e){
		var touchobj = e.changedTouches[0]
		dir = 'none'
		swipeType = 'none'
		dist = 0
		startX = touchobj.pageX
		startY = touchobj.pageY
		startTime = new Date().getTime() // record time when finger first makes contact with surface
		handletouch(e, 'none', 'start', swipeType, 0) // fire callback function with params dir="none", phase="start", swipetype="none" etc
		e.preventDefault()
	
	}, false)

	touchsurface.addEventListener('touchmove', function(e){
		var touchobj = e.changedTouches[0]
		distX = touchobj.pageX - startX // get horizontal dist traveled by finger while in contact with surface
		distY = touchobj.pageY - startY // get vertical dist traveled by finger while in contact with surface
		if (Math.abs(distX) > Math.abs(distY)){ // if distance traveled horizontally is greater than vertically, consider this a horizontal movement
			dir = (distX < 0)? 'left' : 'right'
			handletouch(e, dir, 'move', swipeType, distX) // fire callback function with params dir="left|right", phase="move", swipetype="none" etc
		}
		else{ // else consider this a vertical movement
			dir = (distY < 0)? 'up' : 'down'
			handletouch(e, dir, 'move', swipeType, distY) // fire callback function with params dir="up|down", phase="move", swipetype="none" etc
		}
		e.preventDefault() // prevent scrolling when inside DIV
	}, false)

	touchsurface.addEventListener('touchend', function(e){
		var touchobj = e.changedTouches[0]
		elapsedTime = new Date().getTime() - startTime // get time elapsed
		if (elapsedTime <= allowedTime){ // first condition for awipe met
			if (Math.abs(distX) >= threshold && Math.abs(distY) <= restraint){ // 2nd condition for horizontal swipe met
				swipeType = dir // set swipeType to either "left" or "right"
			}
			else if (Math.abs(distY) >= threshold  && Math.abs(distX) <= restraint){ // 2nd condition for vertical swipe met
				swipeType = dir // set swipeType to either "top" or "down"
			}
		}
		// fire callback function with params dir="left|right|up|down", phase="end", swipetype=dir etc:
		handletouch(e, dir, 'end', swipeType, (dir =='left' || dir =='right')? distX : distY)
		e.preventDefault()
	}, false)
	
	touchsurface.addEventListener('mousedown', function(e){
		var touchobj = e
		dir = 'none'
		swipeType = 'none'
		dist = 0
		startX = touchobj.pageX
		startY = touchobj.pageY
		startTime = new Date().getTime() // record time when finger first makes contact with surface
		handletouch(e, 'none', 'start', swipeType, 0) // fire callback function with params dir="none", phase="start", swipetype="none" etc
		mouseisdown = true
		e.preventDefault()
	
	}, false)

	document.body.addEventListener('mousemove', function(e){
		if (mouseisdown){
			var touchobj = e
			distX = touchobj.pageX - startX // get horizontal dist traveled by finger while in contact with surface
			distY = touchobj.pageY - startY // get vertical dist traveled by finger while in contact with surface
			if (Math.abs(distX) > Math.abs(distY)){ // if distance traveled horizontally is greater than vertically, consider this a horizontal movement
				dir = (distX < 0)? 'left' : 'right'
				handletouch(e, dir, 'move', swipeType, distX) // fire callback function with params dir="left|right", phase="move", swipetype="none" etc
			}
			else{ // else consider this a vertical movement
				dir = (distY < 0)? 'up' : 'down'
				handletouch(e, dir, 'move', swipeType, distY) // fire callback function with params dir="up|down", phase="move", swipetype="none" etc
			}
			e.preventDefault() // prevent scrolling when inside DIV
		}
	}, false)

	document.body.addEventListener('mouseup', function(e){
		if (mouseisdown){
			var touchobj = e
			elapsedTime = new Date().getTime() - startTime // get time elapsed
			if (elapsedTime <= allowedTime){ // first condition for awipe met
				if (Math.abs(distX) >= threshold && Math.abs(distY) <= restraint){ // 2nd condition for horizontal swipe met
					swipeType = dir // set swipeType to either "left" or "right"
				}
				else if (Math.abs(distY) >= threshold  && Math.abs(distX) <= restraint){ // 2nd condition for vertical swipe met
					swipeType = dir // set swipeType to either "top" or "down"
				}
			}
			// fire callback function with params dir="left|right|up|down", phase="end", swipetype=dir etc:
			handletouch(e, dir, 'end', swipeType, (dir =='left' || dir =='right')? distX : distY)
			mouseisdown = false
			e.preventDefault()
		}
	}, false)
}

window.addEventListener('load', function(){
	var el = document.getElementById('touchsurface2')
	ontouch(el, function(evt, dir, phase, swipetype, distance){
		var touchreport = ''
		touchreport += '<b>Dir:</b> ' + dir + '<br />'
		touchreport += '<b>Phase:</b> ' + phase + '<br />'
		touchreport += '<b>Swipe Type:</b> ' + swipetype + '<br />'
		touchreport += '<b>Distance:</b> ' + distance + '<br />'
		el.innerHTML = touchreport
	})
}, false)



window.addEventListener('load', function(){
	var el = document.getElementById('swipegallery')
	var gallerywidth = el.offsetWidth
	var ul = el.getElementsByTagName('ul')[0]
	var liscount = ul.getElementsByTagName('li').length, curindex = 0, ulLeft = 0
	ul.style.width = gallerywidth * liscount + 'px'
	
	ontouch(el, function(evt, dir, phase, swipetype, distance){
		if (phase == 'start'){
			ulLeft = parseInt(ul.style.left) || 0
		}
		else if (phase == 'move' && (dir =='left' || dir =='right')){
			var totaldist = distance + ulLeft
			ul.style.left = Math.min(totaldist, (curindex+1) * gallerywidth) + 'px'
		}
		else if (phase == 'end'){
			if (swipetype == 'left' || swipetype == 'right'){
				curindex = (swipetype == 'left')? Math.min(curindex+1, liscount-1) : Math.max(curindex-1, 0)	
			}
			ul.style.left = -curindex * gallerywidth + 'px'
		}
	})
}, false)


</script>
    
    
    <link rel="stylesheet" href="../styles.css"><!-- This imports the settings of CSS from the external file styles.css -->
    
</head>

<body>

<?php

$user = "root";
$pass = "";

$db = new PDO('mysql:host=localhost;dbname=my_ecommerce_cp', $user, $pass);
            
            $browser = get_browser();//gets the browser version as well as many other pieces of information about the system the website is being run from
            
            $sql = $db->query('select ImagePath from products');//prepares the statement needed for accessing the images in the database
            
            if(($browser->device_pointing_method)=="touchscreen")//checks out the information pulled from the browscap file, checking if device_pointing_method is equal to touchscreen
            {   
            ?>
            <center>
            <div id="swipegallery" class="touchgallery">
            <ul>

                <?php
                while($row=$sql->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                    <li><img src=" <?php echo $row['ImagePath']; ?> " width="300" height="300" /></li>
                    
                <?php
                }
                ?>    
        
            </ul>
            </div>
            </center>
            
            <?php
                
            }
            else
            {
                while($row=$sql->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                    <img src=" <?php echo $row['ImagePath']; ?> " width="300" height="300" />
                <?php
                }
            }
            //This block of code from the $browser to here encompases the requirements to provide a mobile touchscreen oriented Photo Library, as well as putting in an else statement in the case of a non-touchscreen device visiting the website
            ?>
    
    
    
    </body>
</html>