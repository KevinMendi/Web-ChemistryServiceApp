<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


?>

<style type="text/css">

    .tab {
  overflow: hidden;
  border: 1px solid #ccc;
  box-shadow: 5px 10px #888888;
  background-color: rgba(255,255,255,0.4);
  border-radius: 20px;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
  box-shadow: 5px 10px #888888;
  border-bottom-left-radius: 20px;
  border-bottom-right-radius: 20px;
  animation: fadeEffect 1s;
}
    
    @keyframes fadeEffect {
        from {opacity: 0;}
        to {opacity: 1;}
    }
</style>

<script>
function myFunction() {
    document.getElementById("myText").value = $result;
}
</script>