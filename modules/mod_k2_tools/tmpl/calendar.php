<?php
/**
 * @version		$Id: calendar.php 1812 2013-01-14 18:45:06Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2CalendarBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
	<?php echo $calendar; ?>
	<div class="clr"></div>
</div>
<script type="text/javascript">
var calchartfunc=function(){
var max=0; 
var calitems=jQuery(".calendarDateLinked"); 
calitems.each(function(i,e){var n=jQuery(e).data("itemcount"); if(n>max) max=n;});
var caltoday=jQuery(".calendarTodayLinked"); 
caltoday.each(function(i,e){var n=jQuery(e).data("itemcount"); if(n>max) max=n;}); 
var height= jQuery(calitems.get(0)).height(); 
calitems.each(function(i,e){
    var je=jQuery(e);
  
    var wrapper=document.createElement("DIV");
    wrapper=jQuery(wrapper);
    wrapper.css("position","relative").css("width","100%").css("height","100%").css("left","0px").css("top","0px");
    var jechild=je.children(); 
    je.prepend(wrapper);
    jechild.appendTo(wrapper); //appendTo=move!
    var curr=je.data("itemcount"); 
    je.attr("title",curr+" articoli");
    var x=height*curr/max; /*height:max=x:curr*/ 
    wrapper.prepend("<span style='height:"+x+"px; background-color:lightcoral; opacity:.1; width:100%; position:absolute; bottom:0px; left:0px;'></span>");
});
caltoday.each(function(i,e){
    var je=jQuery(e);
    var wrapper=document.createElement("DIV");
    wrapper=jQuery(wrapper);
    wrapper.css("position","relative").css("width","100%").css("height","100%").css("left","0px").css("top","0px");
    var jechild=je.children(); 
    je.prepend(wrapper);
    jechild.appendTo(wrapper); //appendTo=move!
    var curr=je.data("itemcount"); 
    je.attr("title",curr+" articoli sinora");
    var x=height*curr/max; /*height:max=x:curr*/ 
    wrapper.prepend("<span style='height:"+x+"px; background-color:lightcoral; opacity:.1; width:100%; position:absolute; bottom:0px; left:0px;'></span>");
});
};       

jQuery(".calendar")
    .parent()
    .on("change",
    function(){
calchartfunc(); //requires trigger in k2.js line 238
});

calchartfunc();
</script>
