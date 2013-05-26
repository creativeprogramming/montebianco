/**
 * 
 * © creativeprogramming.it all rights reserved
 * 
 */
jQuery(document).ready(function() {
    if (jQuery('.creativeprogramming_it_awesome_pagination_slider')) {
        jQuery("head").append("<link>");
        css = jQuery("head").children(":last");
        css.attr({
            rel: "stylesheet",
            type: "text/css",
            href: "/components/com_k2/templates/counterplan_graphic_title/js/pagination/jquery-ui-1.10.3.custom/css/smoothness/jquery-ui-1.10.3.custom.css"

                    //href: "/components/com_k2/templates/counterplan_graphic_title/js/pagination/jquery-ui-1.10.3.custom/css/start/jquery-ui-1.10.3.custom.css"
                    // href: "//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"
        });
        jQuery("head").append("<link>");
        jQuery.getScript("/components/com_k2/templates/counterplan_graphic_title/js/pagination/jquery-smooth-scroll/jquery.smooth-scroll.min.js");
        jQuery.getScript(
                "/components/com_k2/templates/counterplan_graphic_title/js/pagination/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js",
                //   "//code.jquery.com/ui/1.10.3/jquery-ui.js", 
                        function() {
                            //wait before initialising to prevent intermittent load error	

                            setTimeout(init_creativeprogramming_it_sliderpagination, 150);
                        });
                jQuery.getScript("/components/com_k2/templates/counterplan_graphic_title/js/globalize/lib/globalize.js",
                        function() {
                            jQuery.getScript("/components/com_k2/templates/counterplan_graphic_title/js/globalize/lib/cultures/globalize.culture.it.js", function() {

                                //Globalize.culture("it");//def
                                Globalize.culture(navigator.language);  //browser language
                                /*
                                 * 
                                 * 
                                 //TODO: for old browsers
                                 $.ajax({ 
                                 url: "http://ajaxhttpheaders.appspot.com", 
                                 dataType: 'jsonp', 
                                 success: function(headers) {
                                 language = headers['Accept-Language'];
                                 nowDoSomethingWithIt(language);
                                 }
                                 });
                                 */
                            });
                        });

            }
});

function _it_creativeprogramming_scrollRollback(){
     jQuery.smoothScroll({
                                //scrollElement: $('div.scrollme'),
                                offset: -100,
                                //direction: 'top', // one of 'top' or 'left'
                                scrollTarget: window._it_creativeprogramming_savedscrollElement, // only use if you want to override default behavior
                                //afterScroll: null,   // function to be called after scrolling occurs. "this" is the triggering element
                                //easing: 'swing',
                                speed: 800,
                                //"auto",
                                // coefficient for "auto" speed
                                autoCoefficent: 2
        });
}
var _creative_skip_initialPopState=true;
var _creative_skip_initialPopStatePageLoadTime=0;
var _INITIAL_POPSTATE_ISSUE_REQUIRED_MILLIS_FROM_LOAD=1500;
var _it_creativeprogramming_savedscrollElement=null;
var historyUrlDoesNotMatchPage=false;

function init_creativeprogramming_it_linkhandler() {
    _creative_skip_initialPopStatePageLoadTime=(new Date()).getTime();
    window.onpopstate = function(event) { 

        //console.debug("popstate ",event);
        var initialPopstatePreventDiff =    ((new Date()).getTime()-_creative_skip_initialPopStatePageLoadTime);
     //   console.debug("intial popstate prevent diff: "+initialPopstatePreventDiff);
        if (historyUrlDoesNotMatchPage==true){
         
                    ////TODO FIXME #issue
        /*
         * fix this case:
         * 
         * click on ajaxlink
         * click on normal link
         * hit back button (ok)
         * hit back button again (fails)!!
         * 
         * hint: use state variables in history to really save  rollbackElements or location.href
         * 
         */
        //END TODO FIXME
            alert("location: " + document.location + ", state: " + JSON.stringify(event.state));

             location.href=document.location;
            location.reload(); //reload current location.href (that's good)
           
        }
        if (!_creative_skip_initialPopState && 
                initialPopstatePreventDiff >_INITIAL_POPSTATE_ISSUE_REQUIRED_MILLIS_FROM_LOAD){ //see       //see http://dropshado.ws/post/15251622664/ignore-initial-popstate
        
       
        
        jQuery("#"+_SYSTEM_DYNAMIC_TEMPORARY_ID).remove();
        jQuery("#system").show();
        _it_creativeprogramming_rollbackContentTransitionEffect();
              
       _it_creativeprogramming_scrollRollback();
       // console.debug("smmmm to",_it_creativeprogramming_savedscrollElement);
       //scroll back to saved timeline element!
        }
                      
       //  alert("location: " + document.location + ", state: " + JSON.stringify(event.state));
    };
    
    
    var creativeprogrammingHrefHandler = function(e) {
       // alert("hey");
       
        var el = jQuery(this);
        window._it_creativeprogramming_savedscrollElement=el;
        if (el.hasClass("modal")) {  //TODO: Joomla modal links needs another type o fix
            return true;
        }
        var link = el.attr('href');
     // alert(link+" is ajaxable???");
        var linkExists = (link != undefined && link != null);
        if (!linkExists) {
            return true;
        }
        var linkIsAbsolute = (link.indexOf("http") == 0);
        var linkIsRelativeAnchor = (link.indexOf("#") == 0);
        var linkSeemsAnAnchor = (link.indexOf("#") != -1);
        var linkIsJavascriptAction = (link.indexOf("javascript:") == 0);
        var linkIsImageOrMedia = false;
        try {
            var ext = link.split('.').pop();

            linkIsImageOrMedia = (-1 != jQuery.inArray(ext, ["mp3", "avi", "png", "gif", "jpeg", "jpg"]));
            /***if extension is a media file is very probable we don't want browser changes the location to it  because maybe we have here a js popup/player (e.g. soundmanager2_360) on this href, so i don't enforce
             window.location 
             *** remove/add the media file extensions in the .inArray functions according to your needs ***/
        } catch (urlGotNoFileExtension) {

        }

        if (!linkIsJavascriptAction && !linkIsRelativeAnchor && (!linkSeemsAnAnchor || linkIsAbsolute)) {
            //  jQuery("#gkPageTop").css("top", "49%");

     //alert(link+" is ajaxable...");
            window.ajaxPushStateLinksCount = window.ajaxPushStateLinksCount + 1;
            //conta sempre anche se ajax è disattivo per evitare stalli
            if (ajaxPushStateLinksCount <= 23) {
               // alert(link+" test");
                window._creativeLinkHandlerWrongBubblingListenersOrderStopPropagation=true;
                e.stopPropagation();
                e.stopImmediatePropagation();
                e.preventDefault();
               
               
                _it_creativeprogramming_addUrlToHistory(link);
               
                if (link.match(/\?/)) {
                    link += "&tmpl=component&format=raw";
                } else {
                    link += "?tmpl=component&format=raw";
                }
                //TODO: make body rotate selector configurable
                 _it_creativeprogramming_startContentTransitionEffect();
                      
              
                //console.debug("ajaxing "+link );
                
                jQuery.ajax({url: link, 
                    error:function(data,textStatus){
                        window._creativeLinkHandlerWrongBubblingListenersOrderStopPropagation=false; //reset
                        _it_creativeprogramming_rollbackContentTransitionEffect();
                    },
                   success:function(data,textStatus){
                window._creativeLinkHandlerWrongBubblingListenersOrderStopPropagation=false; //reset
                  
                   if (textStatus=="success" || textStatus=="200"){
                       _it_creativeprogramming_completeContentTransitionEffect();
                      
                        //window.savedHtmlMainState=jQuery("#system").html();
                        jQuery("#system").hide();
                        //console.debug("data",{debug:data});
                    //    window.debuggable=data;
                        var htmlJuicePart = jQuery("#k2Container", 
                                    "<i>"+data+"</i>");
                    //    console.log("\n\n\njuice "+htmlJuicePart.html() );
                        jQuery("#system").parent().prepend(
                                "<div id='"+_SYSTEM_DYNAMIC_TEMPORARY_ID+"'>"
                                    +htmlJuicePart.html()
                                +"</div>");
                        if ( _creative_skip_initialPopState==true){
                             _creative_skip_initialPopStatePageLoadTime=(new Date()).getTime();
                             setTimeout(function(){
                                 _creative_skip_initialPopState=false;
                            //see http://dropshado.ws/post/15251622664/ignore-initial-popstate
                             },200);
                        }
                        //scroll to loaded article (needed only if it is not a lightbox!)
                     
                   } 
                }});
                
            }

        }
        // el.trigger("touchend");  //fastclick creative(programming.it) alternative see: https://developers.google.com/mobile/articles/fast_buttons
    };
    jQuery("a.timelinearticleLink").unbind();
    jQuery("a.timelinearticleLink").on("click", creativeprogrammingHrefHandler);
}

window.it_creativeprogrammingTransitionEffects=
    {
    rotate: 1,
    dissolve: 2,
    zoomtimeline: 3,
    filpcard: 4 //TODO!
    };
window.it_creativeprogrammingTransitionEffect=  
       it_creativeprogrammingTransitionEffects.zoomtimeline;  //tune to change enabled effect

window._SYSTEM_DYNAMIC_TEMPORARY_ID="system_dynamic_temporary";
window._MAINBODY_SELECTOR="body #creativeMainPage";
function _it_creativeprogramming_scrollToLoadedArticle(){
    var scrolltoart=function(){    
                           jQuery.smoothScroll({
                                //scrollElement: $('div.scrollme'),
                                offset: -250,
                                //direction: 'top', // one of 'top' or 'left'
                                scrollTarget: jQuery("#"+_SYSTEM_DYNAMIC_TEMPORARY_ID), // only use if you want to override default behavior
                                //afterScroll: null,   // function to be called after scrolling occurs. "this" is the triggering element
                                //easing: 'swing',
                                speed: 100,
                                //"auto",
                                // coefficient for "auto" speed
                                autoCoefficent: 2
                            });
                         };
                         setTimeout(scrolltoart,100);
                        // setTimeout(scrolltoart,250);
                         setTimeout(scrolltoart,500);
}

/* called when we have to change from timeline to article */
function _it_creativeprogramming_startContentTransitionEffect(){
    var clickEventElement=window._it_creativeprogramming_savedscrollElement;
    // var timelineArticleEventElement=eventClickElement.parentsUntil("article").parent();
    var timelineArticleClickEventElement=clickEventElement.parentsUntil("li").parent();
     switch (window.it_creativeprogrammingTransitionEffect){
        case it_creativeprogrammingTransitionEffects.rotate:
             jQuery(_MAINBODY_SELECTOR).addClass("rotate").addClass("rotatezero3s");
                setTimeout(function(){
                     jQuery(_MAINBODY_SELECTOR).addClass("rotateforward90");
                },10);
        break;
        case it_creativeprogrammingTransitionEffects.dissolve:
            jQuery("#system").fadeOut(300);
        break;
        case it_creativeprogrammingTransitionEffects.zoomtimeline: 
            timelineArticleClickEventElement.addClass("zoomoutscreen");
        break;
        default: break;
    } 
}
/* called when we changed from timeline to article and article is loaded! */
function _it_creativeprogramming_completeContentTransitionEffect(){
    var clickEventElement=window._it_creativeprogramming_savedscrollElement;
    // var timelineArticleEventElement=eventClickElement.parentsUntil("article").parent();
    var timelineArticleClickEventElement=clickEventElement.parentsUntil("li").parent();
    switch (window.it_creativeprogrammingTransitionEffect){
        case it_creativeprogrammingTransitionEffects.rotate:
             jQuery(_MAINBODY_SELECTOR).addClass("rotateforward360");
             _it_creativeprogramming_scrollToLoadedArticle();
        break;
        case it_creativeprogrammingTransitionEffects.dissolve:
             jQuery("#"+_SYSTEM_DYNAMIC_TEMPORARY_ID).fadeIn(500);
             _it_creativeprogramming_scrollToLoadedArticle();
        break;
        case it_creativeprogrammingTransitionEffects.zoomtimeline:
               _it_creativeprogramming_scrollToLoadedArticle();
           // timelineArticleClickEventElement.addClass("zoomoutscreen");
        break;
        default: break;
    }
   
}



function _it_creativeprogramming_rollbackContentTransitionEffect(){
    var clickEventElement=window._it_creativeprogramming_savedscrollElement;
    // var timelineArticleEventElement=eventClickElement.parentsUntil("article").parent();
    var timelineArticleClickEventElement=clickEventElement.parentsUntil("li").parent();
 switch (window.it_creativeprogrammingTransitionEffect){
        case it_creativeprogrammingTransitionEffects.rotate:
            jQuery(_MAINBODY_SELECTOR).removeClass("rotate").removeClass("rotateforward90").removeClass("rotateforward360");     
            _it_creativeprogramming_scrollRollback();
        break;
        case it_creativeprogrammingTransitionEffects.dissolve:
            jQuery("#system").fadeIn(400);
            _it_creativeprogramming_scrollRollback();
        break;
        case it_creativeprogrammingTransitionEffects.zoomtimeline:
             timelineArticleClickEventElement.removeClass("zoomoutscreen").addClass("zoomback_transition_timings");
             _it_creativeprogramming_scrollRollback();
        break;
        default: break;
    } 
}


                
function _it_creativeprogramming_addUrlToHistory(ajaxurl){
                    try {
                            var popStateObj = {};

                            var historyUrl = ajaxurl.replace(location.protocol, "");
                          //  console.log("history: " + historyUrl);
                            historyUrl = historyUrl.replace(location.hostname, "");
                           // console.log("history: " + historyUrl);
                            while (historyUrl.match("//")) {
                                historyUrl = historyUrl.replace("//", "/");
                            //    console.log("history: " + historyUrl);
                            }
                            window.history.pushState(popStateObj, "", historyUrl);
                           // console.log("history s: " + historyUrl);
                        } catch (noPushStateAPI) {

                        }
}

function init_creativeprogramming_it_sliderpagination() {
    init_creativeprogramming_it_linkhandler();
    var slider = jQuery('.creativeprogramming_it_awesome_pagination_slider');
    window._creativeprogrammingawesomepag = {
        previous: slider.data("current"), //initial page
        refElement: null,
        targetPageStartDomElm: [] //the only thread* safe!
    };



    slider.slider(
            {value: slider.data("current"),
                min: slider.data("min"),
                max: slider.data("max"),
                change: function(event, ui) {
                    _it_creativeprogramming_jsExecRateLimitFilterWithArgs(70, "_pagechange", function(event, ui) { //it's thread* safe but we debouce for  more lazy ajax requests 
                        var currentPage = window._creativeprogrammingawesomepag.previous;
                        var currentPageRef = jQuery(".creativeprogrammingAwesomePageStartOf_"
                                + currentPage);
                        if (!currentPageRef.hasClass("cpagebreak")) {
                            currentPageRef.addClass("cpagebreak");
                            currentPageRef.html(currentPageRef.data("page"));
                        } //add the smoothscroll reference class to first page (the only that misses it)Œ

                        var targetPage = ui.value;
                        var tid = targetPage; //for thread safe ajax resp
                        var targetJoomlaUriVar = (ui.value - 1) * slider.data("elementsperpage");
                        //console.debug(targetJoomlaUriVar);
                        var ajaxurl = location.href;

                        ajaxurl = ajaxurl.replace(/(&|\?)start\=([0-9]+)/g, "");
                        ajaxurl = ajaxurl.replace(/(&|\?)limitstart\=([0-9]+)/g, "");

                        //console.debug(ajaxurl);
                        if (ajaxurl.match(/\?/)) {
                            ajaxurl += "&start=" + targetJoomlaUriVar;
                        } else {
                            ajaxurl += "?start=" + targetJoomlaUriVar;
                        }

                       _it_creativeprogramming_addUrlToHistory(ajaxurl);
                        ajaxurl += "&tmpl=component&format=raw"; //not strictly needed but optimizes the joomla and network load...
                        // console.debug(ajaxurl);

                        //smoothly prepare destination position
                        window._creativeprogrammingawesomepag.previousPageStartDomElm =
                                jQuery(".creativeprogrammingAwesomePageStartOf_"
                                + window._creativeprogrammingawesomepag.previous);
                        window._creativeprogrammingawesomepag.previousPageEndDomElm =
                                jQuery(".creativeprogrammingAwesomePageEndOf_"
                                + window._creativeprogrammingawesomepag.previous);

                        window._creativeprogrammingawesomepag.targetPageStartDomElm[tid] =
                                jQuery(".creativeprogrammingAwesomePageStartOf_"
                                + targetPage);
                        window._creativeprogrammingawesomepag.targetPageEndDomElm =
                                jQuery(".creativeprogrammingAwesomePageEndOf_"
                                + targetPage);
                        if (window._creativeprogrammingawesomepag.targetPageEndDomElm.length > 0) { //we check the end node to be sure ajax was completed for the page
                            //page already loaded!!!
                            jQuery.smoothScroll({
                                //scrollElement: $('div.scrollme'),
                                offset: -100,
                                //direction: 'top', // one of 'top' or 'left'
                                scrollTarget: window._creativeprogrammingawesomepag.targetPageStartDomElm[tid], // only use if you want to override default behavior
                                //afterScroll: null,   // function to be called after scrolling occurs. "this" is the triggering element
                                //easing: 'swing',
                                speed: 460
                            });
                        } else { //we have to load the page
                            // jQuery.debounce( 250, function(event,ui){
                            _it_creativeprogramming_jsExecRateLimitFilterWithArgs(70, "_pagechange_ajax", function() {
                                jQuery.ajax({
                                    url: ajaxurl,
                                    success: function(tid) {  //closure func
                                        return function(data, textStatus) { //returns a pointer to a function like a standard jquery callback, see: http://stackoverflow.com/questions/939032/jquery-pass-more-parameters-into-callback
                                            init_creativeprogramming_it_updateawesomepage(data, tid, textStatus); //but we use our sticked param tid here in the async callback!
                                        };
                                    }(tid) //closure param
                                }
                                );
                            });
                            //  }(event,ui));

                            //But whe are smooth and we do some work while ajax request is pending server response (some millis should be sufficient do do this!)

                            var createHtml = '<li data-page="' + targetPage + '" class="cpagebreak creativeprogrammingAwesomePageStart creativeprogrammingAwesomePageStartOf_' + targetPage + '">page ' + targetPage + '</li>';

                            var timelineUl = jQuery(".cbp_tmtimeline");
                            //now we have to determine where to put this new page, up or down? and where exactley?


                            if (targetPage < window._creativeprogrammingawesomepag.previous) { //if target page is before current page we have to place the element up
                                //check if exist a loaded page lower than target (to insert it after the nearest lower )       
                                var possibleSolutions = jQuery(".creativeprogrammingAwesomePageEnd").filter(function() {
                                    var elmPage = jQuery(this).data('page');
                                    if (elmPage < targetPage) {
                                        return true;
                                    }
                                    return false;
                                });

                                if (possibleSolutions.length == 0) {
                                    //no solution? best case! add it before the lower page 

                                    timelineUl.prepend(createHtml);
                                } else {
                                    //get nearest solution
                                    window._creativeprogrammingawesomepag.tmpMinDiff = -1;
                                    var solution = null;
                                    possibleSolutions.each(function(index, elm) {
                                        var elmPage = jQuery(elm).data('page');
                                        var diff = Math.abs(elmPage - targetPage);
                                        if (diff < window._creativeprogrammingawesomepag.tmpMinDiff || window._creativeprogrammingawesomepag.tmpMinDiff == -1) {
                                            window._creativeprogrammingawesomepag.tmpMinDiff = diff;
                                            solution = jQuery(elm);
                                            //TODO: check jQuery.each order (if is valid) and break if possible to optimize cpu usage when many pages are loaded
                                        }
                                    });
                                    //and ad after it
                                    window._creativeprogrammingawesomepag.targetPageStartDomElm[tid] =
                                            solution.after(createHtml);
                                }
                            } else { //target page is after current page
                                //get nearest solution
                                //check if exist a loaded page bigger than target (to insert it before the nearest bigger)      
                                var possibleSolutions = jQuery(".creativeprogrammingAwesomePageStart").filter(function() {
                                    var elmPage = jQuery(this).data('page');
                                    if (elmPage > targetPage) {
                                        return true;
                                    }
                                    return false;
                                });
                                if (possibleSolutions.length == 0) {
                                    //no solution? best case! add it next to the highest page

                                    timelineUl.append(createHtml);
                                } else {
                                    window._creativeprogrammingawesomepag.tmpMinDiff = -1;
                                    var solution = null;
                                    possibleSolutions.each(function(index, elm) {
                                        var elmPage = jQuery(elm).data('page');
                                        var diff = Math.abs(elmPage - targetPage);
                                        if (diff < window._creativeprogrammingawesomepag.tmpMinDiff || window._creativeprogrammingawesomepag.tmpMinDiff == -1) {
                                            window._creativeprogrammingawesomepag.tmpMinDiff = diff;
                                            solution = jQuery(elm);
                                            //TODO: check jQuery.each order (if is valid) and break if possible to optimize cpu usage when many pages are loaded
                                        }
                                    });

                                    window._creativeprogrammingawesomepag.targetPageStartDomElm[tid] =
                                            solution.before(createHtml);
                                }
                            }

                            //update our insert point!
                            window._creativeprogrammingawesomepag.targetPageStartDomElm[tid] =
                                    jQuery(".cpagebreak.creativeprogrammingAwesomePageStartOf_"
                                    + targetPage);

                            jQuery.smoothScroll({
                                //scrollElement: $('div.scrollme'),
                                offset: -100,
                                //direction: 'top', // one of 'top' or 'left'
                                scrollTarget: window._creativeprogrammingawesomepag.targetPageStartDomElm[tid], //.prev(".cpagebreak"), // only use if you want to override default behavior
                                //afterScroll: null,   // function to be called after scrolling occurs. "this" is the triggering element
                                //easing: 'swing',
                                speed: 460
                            });


                        }
                        window._creativeprogrammingawesomepag.previous = targetPage;
                    }, event, ui); //schedule debounced function with args
                },
                step: 1,
                noconflictslide: function(event, ui) {
                    jQuery(".creativeprogramming_it_awesome_pagination_currentpage").html(ui.value);
                }
            });

//manually trigger a slider change:slider.slider('option', 'change').call($slider); see: http://stackoverflow.com/questions/1288824/trigger-a-jquery-ui-slider-event

    jQuery(".creativeprogramming_it_awesome_pagination_currentpage").html(slider.slider("value"));

    /* see slider examples here http://jqueryui.com/slider/#side-scroll */
}



function init_creativeprogramming_it_updateawesomepage(data, tid, textStatus) {
//console.debug(data);
    // console.debug("response for "+tid+" "+textStatus);
    if (textStatus == "200" || textStatus == "success") {
        // var targetElement=jQuery(".cbp_tmtimeline");
        var htmlJuicePart = jQuery(".cbp_tmtimeline", data);
        //targetElement.append("juice is"+htmlJuicePart.html());
        // console.debug(htmlJuicePart.html(),"inserting after", window._creativeprogrammingawesomepag.targetPageStartDomElm);
        window._creativeprogrammingawesomepag.targetPageStartDomElm[tid].after(htmlJuicePart.html());
        var article = window._creativeprogrammingawesomepag.targetPageStartDomElm[tid].nextUntil("article").next();
        // console.debug("inserted after",window._creativeprogrammingawesomepag.targetPageStartDomElm);
        init_creativeprogramming_it_linkhandler(); //now we have new elements

        var lastyear = jQuery("time.thedate", article).filter(function() {
            var time = jQuery.timeago.parse(jQuery(this).attr("datetime")).getTime();
            if (((new Date().getTime()) - time) < 1000 * 60 * 60 * 24 * 396) {
                // //we convert the time to human readable "timeago" 
                // /until it is "about a year ago" plus about one month (e.g. if today is may 2013 we write about a year ago to may 2012) this is my  "about a year ago" concept!)     
                return true;
            }
            return false;
        });

        var timeAgoOnlyLastYear = false;
        if (timeAgoOnlyLastYear) {
            lastyear.timeago();
        } else {
            jQuery("time.thedate", article).timeago();
        }

        var olderthan2daysago = jQuery("time.thehour", article).filter(function() {
            var time = jQuery.timeago.parse(jQuery(this).attr("datetime")).getTime();
            if (((new Date().getTime()) - time) >= 1000 * 60 * 60 * 24 * 2) {
                // //we convert the time to human readable "timeago" 
                // /until it is "about a year ago" plus about one month (e.g. if today is may 2013 we write about a year ago to may 2012) this is my  "about a year ago" concept!)     
                return true;
            }
            return false;
        });

        olderthan2daysago.each(function(idx, elm) {
            var parsedDate = jQuery.timeago.parse(jQuery(elm).attr("datetime"));
            if (!jQuery(elm).hasClass("creative_timeago_monthdayparsed")) {
                jQuery(elm).html("<span class='thehour_wrapper'>" + jQuery(elm).html() + "</span>");
                jQuery(elm).addClass("creative_timeago_monthdayparsed").prepend("<small class='glomonthday'>" + Globalize.format(parsedDate, "d MMM").toUpperCase() + "</small>");
            }
            //see formats here: https://github.com/creativeprogramming/globalize
        });

        var olderthan1yearssago = jQuery("time.thehour", article).filter(function() {
            var time = jQuery.timeago.parse(jQuery(this).attr("datetime")).getTime();
            if (((new Date().getTime()) - time) >= 1000 * 60 * 60 * 24 * 365 * 1) {
                // //we convert the time to human readable "timeago" 
                // /until it is "about a year ago" plus about one month (e.g. if today is may 2013 we write about a year ago to may 2012) this is my  "about a year ago" concept!)     
                return true;
            }
            return false;
        });

        olderthan1yearssago.each(function(idx, elm) {
            var parsedDate = jQuery.timeago.parse(jQuery(elm).attr("datetime"));
            if (!jQuery(".glomonthday", elm).hasClass("creative_timeago_monthdayparsed")) {
                jQuery(".thehour_wrapper", elm).hide(); //hour is not so relevant now...
                jQuery(".glomonthday", elm).addClass("creative_timeago_monthdayparsed").append("<br/><small style='margin:0 auto; text-align:center; width:100%;'>" + Globalize.format(parsedDate, "yyyy").toUpperCase() + "</small>");
            }
            //see formats here: https://github.com/creativeprogramming/globalize
        });
    }
    //  console.debug(htmlJuicePart.html(),"inserted after", window._creativeprogrammingawesomepag.targetPageStartDomElm);
    //console.debug("\n\n\n juice"+htmlJuicePart.html());
}


window._it_creativeprogramming_jsExecRateLimitFilterWithArgs = function(ms, fname, fn) {
    var args = Array.prototype.slice.call(arguments);
    //    console.debug(args+" -- ");
    _it_creativeprogramming_rateLimitTimer[fname] && clearTimeout(_it_creativeprogramming_rateLimitTimer[fname]);
    _it_creativeprogramming_rateLimitTimer[fname] = setTimeout(function() {
        //console.debug("calling:" +fn +" with arguments ("+args.slice(3,args.length)+")");
        fn.apply(this, args.slice(3, args.length)); //call the function with the remaning extra arguments
        _it_creativeprogramming_rateLimitTimer[fname] = null;
    }, ms);
}

window._it_creativeprogramming_rateLimitTimer = new Array();
