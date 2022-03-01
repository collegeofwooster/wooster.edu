function forceDownload(e,n){var t=new XMLHttpRequest;t.open("GET",e,!0),t.responseType="blob",t.onload=function(){var e=(window.URL||window.webkitURL).createObjectURL(this.response),t=document.createElement("a");t.href=e,t.download=n,document.body.appendChild(t),t.click(),document.body.removeChild(t)},t.send()}!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e("object"==typeof exports?require("jquery"):window.jQuery||window.Zepto)}(function(l){function e(){}function u(e,t){m.ev.on(n+e+w,t)}function d(e,t,n,i){var o=document.createElement("div");return o.className="mfp-"+e,n&&(o.innerHTML=n),i?t&&t.appendChild(o):(o=l(o),t&&o.appendTo(t)),o}function p(e,t){m.ev.triggerHandler(n+e,t),m.st.callbacks&&(e=e.charAt(0).toLowerCase()+e.slice(1),m.st.callbacks[e]&&m.st.callbacks[e].apply(m,l.isArray(t)?t:[t]))}function f(e){return e===t&&m.currTemplate.closeBtn||(m.currTemplate.closeBtn=l(m.st.closeMarkup.replace("%title%",m.st.tClose)),t=e),m.currTemplate.closeBtn}function r(){l.magnificPopup.instance||((m=new e).init(),l.magnificPopup.instance=m)}var m,i,h,o,g,t,c="Close",v="BeforeClose",y="MarkupParse",b="Open",a="Change",n="mfp",w="."+n,C="mfp-ready",s="mfp-removing",k="mfp-prevent-close",x=!!window.jQuery,I=l(window);e.prototype={constructor:e,init:function(){var e=navigator.appVersion;m.isLowIE=m.isIE8=document.all&&!document.addEventListener,m.isAndroid=/android/gi.test(e),m.isIOS=/iphone|ipad|ipod/gi.test(e),m.supportsTransition=function(){var e=document.createElement("p").style,t=["ms","O","Moz","Webkit"];if(void 0!==e.transition)return!0;for(;t.length;)if(t.pop()+"Transition"in e)return!0;return!1}(),m.probablyMobile=m.isAndroid||m.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),h=l(document),m.popupsCache={}},open:function(e){if(!1===e.isObj){m.items=e.items.toArray(),m.index=0;for(var t,n=e.items,i=0;i<n.length;i++)if((t=(t=n[i]).parsed?t.el[0]:t)===e.el[0]){m.index=i;break}}else m.items=l.isArray(e.items)?e.items:[e.items],m.index=e.index||0;if(!m.isOpen){m.types=[],g="",e.mainEl&&e.mainEl.length?m.ev=e.mainEl.eq(0):m.ev=h,e.key?(m.popupsCache[e.key]||(m.popupsCache[e.key]={}),m.currTemplate=m.popupsCache[e.key]):m.currTemplate={},m.st=l.extend(!0,{},l.magnificPopup.defaults,e),m.fixedContentPos="auto"===m.st.fixedContentPos?!m.probablyMobile:m.st.fixedContentPos,m.st.modal&&(m.st.closeOnContentClick=!1,m.st.closeOnBgClick=!1,m.st.showCloseBtn=!1,m.st.enableEscapeKey=!1),m.bgOverlay||(m.bgOverlay=d("bg").on("click"+w,function(){m.close()}),m.wrap=d("wrap").attr("tabindex",-1).on("click"+w,function(e){m._checkIfClose(e.target)&&m.close()}),m.container=d("container",m.wrap)),m.contentContainer=d("content"),m.st.preloader&&(m.preloader=d("preloader",m.container,m.st.tLoading));var o=l.magnificPopup.modules;for(i=0;i<o.length;i++){var r=(r=o[i]).charAt(0).toUpperCase()+r.slice(1);m["init"+r].call(m)}p("BeforeOpen"),m.st.showCloseBtn&&(m.st.closeBtnInside?(u(y,function(e,t,n,i){n.close_replaceWith=f(i.type)}),g+=" mfp-close-btn-in"):m.wrap.append(f())),m.st.alignTop&&(g+=" mfp-align-top"),m.fixedContentPos?m.wrap.css({overflow:m.st.overflowY,overflowX:"hidden",overflowY:m.st.overflowY}):m.wrap.css({top:I.scrollTop(),position:"absolute"}),!1!==m.st.fixedBgPos&&("auto"!==m.st.fixedBgPos||m.fixedContentPos)||m.bgOverlay.css({height:h.height(),position:"absolute"}),m.st.enableEscapeKey&&h.on("keyup"+w,function(e){27===e.keyCode&&m.close()}),I.on("resize"+w,function(){m.updateSize()}),m.st.closeOnContentClick||(g+=" mfp-auto-cursor"),g&&m.wrap.addClass(g);var a=m.wH=I.height(),s={};m.fixedContentPos&&m._hasScrollBar(a)&&((c=m._getScrollbarSize())&&(s.marginRight=c)),m.fixedContentPos&&(m.isIE7?l("body, html").css("overflow","hidden"):s.overflow="hidden");var c=m.st.mainClass;return m.isIE7&&(c+=" mfp-ie7"),c&&m._addClassToMFP(c),m.updateItemHTML(),p("BuildControls"),l("html").css(s),m.bgOverlay.add(m.wrap).prependTo(m.st.prependTo||l(document.body)),m._lastFocusedEl=document.activeElement,setTimeout(function(){m.content?(m._addClassToMFP(C),m._setFocus()):m.bgOverlay.addClass(C),h.on("focusin"+w,m._onFocusIn)},16),m.isOpen=!0,m.updateSize(a),p(b),e}m.updateItemHTML()},close:function(){m.isOpen&&(p(v),m.isOpen=!1,m.st.removalDelay&&!m.isLowIE&&m.supportsTransition?(m._addClassToMFP(s),setTimeout(function(){m._close()},m.st.removalDelay)):m._close())},_close:function(){p(c);var e=s+" "+C+" ";m.bgOverlay.detach(),m.wrap.detach(),m.container.empty(),m.st.mainClass&&(e+=m.st.mainClass+" "),m._removeClassFromMFP(e),m.fixedContentPos&&(e={marginRight:""},m.isIE7?l("body, html").css("overflow",""):e.overflow="",l("html").css(e)),h.off("keyup.mfp focusin"+w),m.ev.off(w),m.wrap.attr("class","mfp-wrap").removeAttr("style"),m.bgOverlay.attr("class","mfp-bg"),m.container.attr("class","mfp-container"),!m.st.showCloseBtn||m.st.closeBtnInside&&!0!==m.currTemplate[m.currItem.type]||m.currTemplate.closeBtn&&m.currTemplate.closeBtn.detach(),m.st.autoFocusLast&&m._lastFocusedEl&&l(m._lastFocusedEl).focus(),m.currItem=null,m.content=null,m.currTemplate=null,m.prevHeight=0,p("AfterClose")},updateSize:function(e){var t;m.isIOS?(t=document.documentElement.clientWidth/window.innerWidth,t=window.innerHeight*t,m.wrap.css("height",t),m.wH=t):m.wH=e||I.height(),m.fixedContentPos||m.wrap.css("height",m.wH),p("Resize")},updateItemHTML:function(){var e=m.items[m.index];m.contentContainer.detach(),m.content&&m.content.detach();var t=(e=!e.parsed?m.parseEl(m.index):e).type;p("BeforeChange",[m.currItem?m.currItem.type:"",t]),m.currItem=e,m.currTemplate[t]||(n=!!m.st[t]&&m.st[t].markup,p("FirstMarkupParse",n),m.currTemplate[t]=!n||l(n)),o&&o!==e.type&&m.container.removeClass("mfp-"+o+"-holder");var n=m["get"+t.charAt(0).toUpperCase()+t.slice(1)](e,m.currTemplate[t]);m.appendContent(n,t),e.preloaded=!0,p(a,e),o=e.type,m.container.prepend(m.contentContainer),p("AfterChange")},appendContent:function(e,t){(m.content=e)?m.st.showCloseBtn&&m.st.closeBtnInside&&!0===m.currTemplate[t]?m.content.find(".mfp-close").length||m.content.append(f()):m.content=e:m.content="",p("BeforeAppend"),m.container.addClass("mfp-"+t+"-holder"),m.contentContainer.append(m.content)},parseEl:function(e){var t,n=m.items[e];if((n=n.tagName?{el:l(n)}:(t=n.type,{data:n,src:n.src})).el){for(var i=m.types,o=0;o<i.length;o++)if(n.el.hasClass("mfp-"+i[o])){t=i[o];break}n.src=n.el.attr("data-mfp-src"),n.src||(n.src=n.el.attr("href"))}return n.type=t||m.st.type||"inline",n.index=e,n.parsed=!0,m.items[e]=n,p("ElementParse",n),m.items[e]},addGroup:function(t,n){function e(e){e.mfpEl=this,m._openClick(e,t,n)}var i="click.magnificPopup";(n=n||{}).mainEl=t,n.items?(n.isObj=!0,t.off(i).on(i,e)):(n.isObj=!1,n.delegate?t.off(i).on(i,n.delegate,e):(n.items=t).off(i).on(i,e))},_openClick:function(e,t,n){if((void 0!==n.midClick?n:l.magnificPopup.defaults).midClick||!(2===e.which||e.ctrlKey||e.metaKey||e.altKey||e.shiftKey)){var i=(void 0!==n.disableOn?n:l.magnificPopup.defaults).disableOn;if(i)if(l.isFunction(i)){if(!i.call(m))return!0}else if(I.width()<i)return!0;e.type&&(e.preventDefault(),m.isOpen&&e.stopPropagation()),n.el=l(e.mfpEl),n.delegate&&(n.items=t.find(n.delegate)),m.open(n)}},updateStatus:function(e,t){var n;m.preloader&&(i!==e&&m.container.removeClass("mfp-s-"+i),n={status:e,text:t=!t&&"loading"===e?m.st.tLoading:t},p("UpdateStatus",n),e=n.status,m.preloader.html(t=n.text),m.preloader.find("a").on("click",function(e){e.stopImmediatePropagation()}),m.container.addClass("mfp-s-"+e),i=e)},_checkIfClose:function(e){if(!l(e).hasClass(k)){var t=m.st.closeOnContentClick,n=m.st.closeOnBgClick;if(t&&n)return!0;if(!m.content||l(e).hasClass("mfp-close")||m.preloader&&e===m.preloader[0])return!0;if(e===m.content[0]||l.contains(m.content[0],e)){if(t)return!0}else if(n&&l.contains(document,e))return!0;return!1}},_addClassToMFP:function(e){m.bgOverlay.addClass(e),m.wrap.addClass(e)},_removeClassFromMFP:function(e){this.bgOverlay.removeClass(e),m.wrap.removeClass(e)},_hasScrollBar:function(e){return(m.isIE7?h.height():document.body.scrollHeight)>(e||I.height())},_setFocus:function(){(m.st.focus?m.content.find(m.st.focus).eq(0):m.wrap).focus()},_onFocusIn:function(e){return e.target===m.wrap[0]||l.contains(m.wrap[0],e.target)?void 0:(m._setFocus(),!1)},_parseMarkup:function(o,e,t){var r;t.data&&(e=l.extend(t.data,e)),p(y,[o,e,t]),l.each(e,function(e,t){return void 0===t||!1===t||void(1<(r=e.split("_")).length?0<(n=o.find(w+"-"+r[0])).length&&("replaceWith"===(i=r[1])?n[0]!==t[0]&&n.replaceWith(t):"img"===i?n.is("img")?n.attr("src",t):n.replaceWith(l("<img>").attr("src",t).attr("class",n.attr("class"))):n.attr(r[1],t)):o.find(w+"-"+e).html(t));var n,i})},_getScrollbarSize:function(){var e;return void 0===m.scrollbarSize&&((e=document.createElement("div")).style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(e),m.scrollbarSize=e.offsetWidth-e.clientWidth,document.body.removeChild(e)),m.scrollbarSize}},l.magnificPopup={instance:null,proto:e.prototype,modules:[],open:function(e,t){return r(),(e=e?l.extend(!0,{},e):{}).isObj=!0,e.index=t||0,this.instance.open(e)},close:function(){return l.magnificPopup.instance&&l.magnificPopup.instance.close()},registerModule:function(e,t){t.options&&(l.magnificPopup.defaults[e]=t.options),l.extend(this.proto,t.proto),this.modules.push(e)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,prependTo:null,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&#215;</button>',tClose:"Close (Esc)",tLoading:"Loading...",autoFocusLast:!0}},l.fn.magnificPopup=function(e){r();var t,n,i,o=l(this);return"string"==typeof e?"open"===e?(t=x?o.data("magnificPopup"):o[0].magnificPopup,n=parseInt(arguments[1],10)||0,i=t.items?t.items[n]:(i=o,(i=t.delegate?i.find(t.delegate):i).eq(n)),m._openClick({mfpEl:i},o,t)):m.isOpen&&m[e].apply(m,Array.prototype.slice.call(arguments,1)):(e=l.extend(!0,{},e),x?o.data("magnificPopup",e):o[0].magnificPopup=e,m.addGroup(o,e)),o};function T(){_&&(S.after(_.addClass(j)).detach(),_=null)}var j,S,_,E="inline";l.magnificPopup.registerModule(E,{options:{hiddenClass:"hide",markup:"",tNotFound:"Content not found"},proto:{initInline:function(){m.types.push(E),u(c+"."+E,function(){T()})},getInline:function(e,t){if(T(),e.src){var n,i=m.st.inline,o=l(e.src);return o.length?((n=o[0].parentNode)&&n.tagName&&(S||(j=i.hiddenClass,S=d(j),j="mfp-"+j),_=o.after(S).detach().removeClass(j)),m.updateStatus("ready")):(m.updateStatus("error",i.tNotFound),o=l("<div>")),e.inlineElement=o}return m.updateStatus("ready"),m._parseMarkup(t,{},e),t}}});function O(){z&&l(document.body).removeClass(z)}function P(){O(),m.req&&m.req.abort()}var z,A="ajax";l.magnificPopup.registerModule(A,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){m.types.push(A),z=m.st.ajax.cursor,u(c+"."+A,P),u("BeforeChange."+A,P)},getAjax:function(i){z&&l(document.body).addClass(z),m.updateStatus("loading");var e=l.extend({url:i.src,success:function(e,t,n){n={data:e,xhr:n};p("ParseAjax",n),m.appendContent(l(n.data),A),i.finished=!0,O(),m._setFocus(),setTimeout(function(){m.wrap.addClass(C)},16),m.updateStatus("ready"),p("AjaxContentAdded")},error:function(){O(),i.finished=i.loadError=!0,m.updateStatus("error",m.st.ajax.tError.replace("%url%",i.src))}},m.st.ajax.settings);return m.req=l.ajax(e),""}}});var M;l.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var e=m.st.image,t=".image";m.types.push("image"),u(b+t,function(){"image"===m.currItem.type&&e.cursor&&l(document.body).addClass(e.cursor)}),u(c+t,function(){e.cursor&&l(document.body).removeClass(e.cursor),I.off("resize"+w)}),u("Resize"+t,m.resizeImage),m.isLowIE&&u("AfterChange",m.resizeImage)},resizeImage:function(){var e,t=m.currItem;t&&t.img&&m.st.image.verticalFit&&(e=0,m.isLowIE&&(e=parseInt(t.img.css("padding-top"),10)+parseInt(t.img.css("padding-bottom"),10)),t.img.css("max-height",m.wH-e))},_onImageHasSize:function(e){e.img&&(e.hasSize=!0,M&&clearInterval(M),e.isCheckingImgSize=!1,p("ImageHasSize",e),e.imgHidden&&(m.content&&m.content.removeClass("mfp-loading"),e.imgHidden=!1))},findImageSize:function(t){var n=0,i=t.img[0],o=function(e){M&&clearInterval(M),M=setInterval(function(){return 0<i.naturalWidth?void m._onImageHasSize(t):(200<n&&clearInterval(M),void(3===++n?o(10):40===n?o(50):100===n&&o(500)))},e)};o(1)},getImage:function(e,t){var n,i=0,o=function(){e&&(e.img[0].complete?(e.img.off(".mfploader"),e===m.currItem&&(m._onImageHasSize(e),m.updateStatus("ready")),e.hasSize=!0,e.loaded=!0,p("ImageLoadComplete")):++i<200?setTimeout(o,100):r())},r=function(){e&&(e.img.off(".mfploader"),e===m.currItem&&(m._onImageHasSize(e),m.updateStatus("error",a.tError.replace("%url%",e.src))),e.hasSize=!0,e.loaded=!0,e.loadError=!0)},a=m.st.image,s=t.find(".mfp-img");return s.length&&((n=document.createElement("img")).className="mfp-img",e.el&&e.el.find("img").length&&(n.alt=e.el.find("img").attr("alt")),e.img=l(n).on("load.mfploader",o).on("error.mfploader",r),n.src=e.src,s.is("img")&&(e.img=e.img.clone()),0<(n=e.img[0]).naturalWidth?e.hasSize=!0:n.width||(e.hasSize=!1)),m._parseMarkup(t,{title:function(e){if(e.data&&void 0!==e.data.title)return e.data.title;var t=m.st.image.titleSrc;if(t){if(l.isFunction(t))return t.call(m,e);if(e.el)return e.el.attr(t)||""}return""}(e),img_replaceWith:e.img},e),m.resizeImage(),e.hasSize?(M&&clearInterval(M),e.loadError?(t.addClass("mfp-loading"),m.updateStatus("error",a.tError.replace("%url%",e.src))):(t.removeClass("mfp-loading"),m.updateStatus("ready"))):(m.updateStatus("loading"),e.loading=!0,e.hasSize||(e.imgHidden=!0,t.addClass("mfp-loading"),m.findImageSize(e))),t}}});var L;l.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(e){return e.is("img")?e:e.find("img")}},proto:{initZoom:function(){var e,t,n,i,o,r,a=m.st.zoom,s=".zoom";a.enabled&&m.supportsTransition&&(i=a.duration,o=function(e){var t=e.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),n="all "+a.duration/1e3+"s "+a.easing,i={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},e="transition";return i["-webkit-"+e]=i["-moz-"+e]=i["-o-"+e]=i[e]=n,t.css(i),t},r=function(){m.content.css("visibility","visible")},u("BuildControls"+s,function(){m._allowZoom()&&(clearTimeout(t),m.content.css("visibility","hidden"),(e=m._getItemToZoom())?((n=o(e)).css(m._getOffset()),m.wrap.append(n),t=setTimeout(function(){n.css(m._getOffset(!0)),t=setTimeout(function(){r(),setTimeout(function(){n.remove(),e=n=null,p("ZoomAnimationEnded")},16)},i)},16)):r())}),u(v+s,function(){if(m._allowZoom()){if(clearTimeout(t),m.st.removalDelay=i,!e){if(!(e=m._getItemToZoom()))return;n=o(e)}n.css(m._getOffset(!0)),m.wrap.append(n),m.content.css("visibility","hidden"),setTimeout(function(){n.css(m._getOffset())},16)}}),u(c+s,function(){m._allowZoom()&&(r(),n&&n.remove(),e=null)}))},_allowZoom:function(){return"image"===m.currItem.type},_getItemToZoom:function(){return!!m.currItem.hasSize&&m.currItem.img},_getOffset:function(e){var t=e?m.currItem.img:m.st.zoom.opener(m.currItem.el||m.currItem),n=t.offset(),i=parseInt(t.css("padding-top"),10),e=parseInt(t.css("padding-bottom"),10);n.top-=l(window).scrollTop()-i;i={width:t.width(),height:(x?t.innerHeight():t[0].offsetHeight)-e-i};return(L=void 0===L?void 0!==document.createElement("p").style.MozTransform:L)?i["-moz-transform"]=i.transform="translate("+n.left+"px,"+n.top+"px)":(i.left=n.left,i.top=n.top),i}}});function N(e){var t;!m.currTemplate[B]||(t=m.currTemplate[B].find("iframe")).length&&(e||(t[0].src="//about:blank"),m.isIE8&&t.css("display",e?"block":"none"))}var B="iframe";l.magnificPopup.registerModule(B,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){m.types.push(B),u("BeforeChange",function(e,t,n){t!==n&&(t===B?N():n===B&&N(!0))}),u(c+"."+B,function(){N()})},getIframe:function(e,t){var n=e.src,i=m.st.iframe;l.each(i.patterns,function(){return-1<n.indexOf(this.index)?(this.id&&(n="string"==typeof this.id?n.substr(n.lastIndexOf(this.id)+this.id.length,n.length):this.id.call(this,n)),n=this.src.replace("%id%",n),!1):void 0});var o={};return i.srcAction&&(o[i.srcAction]=n),m._parseMarkup(t,o,e),m.updateStatus("ready"),t}}});function Q(e){var t=m.items.length;return t-1<e?e-t:e<0?t+e:e}function F(e,t,n){return e.replace(/%curr%/gi,t+1).replace(/%total%/gi,n)}l.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var r=m.st.gallery,e=".mfp-gallery";return m.direction=!0,!(!r||!r.enabled)&&(g+=" mfp-gallery",u(b+e,function(){r.navigateByImgClick&&m.wrap.on("click"+e,".mfp-img",function(){return 1<m.items.length?(m.next(),!1):void 0}),h.on("keydown"+e,function(e){37===e.keyCode?m.prev():39===e.keyCode&&m.next()})}),u("UpdateStatus"+e,function(e,t){t.text&&(t.text=F(t.text,m.currItem.index,m.items.length))}),u(y+e,function(e,t,n,i){var o=m.items.length;n.counter=1<o?F(r.tCounter,i.index,o):""}),u("BuildControls"+e,function(){var e,t;1<m.items.length&&r.arrows&&!m.arrowLeft&&(t=r.arrowMarkup,e=m.arrowLeft=l(t.replace(/%title%/gi,r.tPrev).replace(/%dir%/gi,"left")).addClass(k),t=m.arrowRight=l(t.replace(/%title%/gi,r.tNext).replace(/%dir%/gi,"right")).addClass(k),e.click(function(){m.prev()}),t.click(function(){m.next()}),m.container.append(e.add(t)))}),u(a+e,function(){m._preloadTimeout&&clearTimeout(m._preloadTimeout),m._preloadTimeout=setTimeout(function(){m.preloadNearbyImages(),m._preloadTimeout=null},16)}),void u(c+e,function(){h.off(e),m.wrap.off("click"+e),m.arrowRight=m.arrowLeft=null}))},next:function(){m.direction=!0,m.index=Q(m.index+1),m.updateItemHTML()},prev:function(){m.direction=!1,m.index=Q(m.index-1),m.updateItemHTML()},goTo:function(e){m.direction=e>=m.index,m.index=e,m.updateItemHTML()},preloadNearbyImages:function(){for(var e=m.st.gallery.preload,t=Math.min(e[0],m.items.length),n=Math.min(e[1],m.items.length),i=1;i<=(m.direction?n:t);i++)m._preloadItem(m.index+i);for(i=1;i<=(m.direction?t:n);i++)m._preloadItem(m.index-i)},_preloadItem:function(e){var t;e=Q(e),m.items[e].preloaded||((t=m.items[e]).parsed||(t=m.parseEl(e)),p("LazyLoad",t),"image"===t.type&&(t.img=l('<img class="mfp-img" />').on("load.mfploader",function(){t.hasSize=!0}).on("error.mfploader",function(){t.hasSize=!0,t.loadError=!0,p("LazyLoadError",t)}).attr("src",t.src)),t.preloaded=!0)}}});var H="retina";l.magnificPopup.registerModule(H,{options:{replaceSrc:function(e){return e.src.replace(/\.\w+$/,function(e){return"@2x"+e})},ratio:1},proto:{initRetina:function(){var n,i;1<window.devicePixelRatio&&(n=m.st.retina,i=n.ratio,1<(i=isNaN(i)?i():i)&&(u("ImageHasSize."+H,function(e,t){t.img.css({"max-width":t.img[0].naturalWidth/i,width:"100%"})}),u("ElementParse."+H,function(e,t){t.src=n.replaceSrc(t,i)})))}}}),r()}),function(r){"use strict";r.fn.fitVids=function(e){var t,n,o={customSelector:null,ignore:null};return document.getElementById("fit-vids-style")||(t=document.head||document.getElementsByTagName("head")[0],(n=document.createElement("div")).innerHTML='<p>x</p><style id="fit-vids-style">.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>',t.appendChild(n.childNodes[1])),e&&r.extend(o,e),this.each(function(){var e=['iframe[src*="player.vimeo.com"]','iframe[src*="youtube.com"]','iframe[src*="youtube-nocookie.com"]','iframe[src*="kickstarter.com"][src*="video.html"]',"object","embed"];o.customSelector&&e.push(o.customSelector);var i=".fitvidsignore";o.ignore&&(i=i+", "+o.ignore);e=r(this).find(e.join(","));(e=(e=e.not("object object")).not(i)).each(function(){var e,t,n=r(this);0<n.parents(i).length||"embed"===this.tagName.toLowerCase()&&n.parent("object").length||n.parent(".fluid-width-video-wrapper").length||(n.css("height")||n.css("width")||!isNaN(n.attr("height"))&&!isNaN(n.attr("width"))||(n.attr("height",9),n.attr("width",16)),e=("object"===this.tagName.toLowerCase()||n.attr("height")&&!isNaN(parseInt(n.attr("height"),10))?parseInt(n.attr("height"),10):n.height())/(isNaN(parseInt(n.attr("width"),10))?n.width():parseInt(n.attr("width"),10)),n.attr("name")||(t="fitvid"+r.fn.fitVids._count,n.attr("name",t),r.fn.fitVids._count++),n.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",100*e+"%"),n.removeAttr("height").removeAttr("width"))})})},r.fn.fitVids._count=0}(window.jQuery||window.Zepto),function(e){var t=e.separator||"&",l=!1!==e.spaces,n=(e.suffix,!1!==e.prefix?!0===e.hash?"#":"?":""),r=!1!==e.numbers;jQuery.query=new function(){function s(e,t){return null!=e&&null!==e&&(!t||e.constructor==t)}function o(e){for(var t,n=/\[([^[]*)\]/g,i=/^([^[]+)(\[.*\])?$/.exec(e),e=i[1],o=[];t=n.exec(i[2]);)o.push(t[1]);return[e,o]}function i(e){var n=this;return n.keys={},e.queryObject?jQuery.each(e.get(),function(e,t){n.SET(e,t)}):n.parseNew.apply(n,arguments),n}var c=function(e,t,n){var i=t.shift();if("object"!=typeof e&&(e=null),""===i)if(s(e=e||[],Array))e.push(0==t.length?n:c(null,t.slice(0),n));else if(s(e,Object)){for(var o=0;null!=e[o++];);e[--o]=0==t.length?n:c(e[o],t.slice(0),n)}else(e=[]).push(0==t.length?n:c(null,t.slice(0),n));else if(i&&i.match(/^\s*[0-9]+\s*$/))(e=e||[])[r=parseInt(i,10)]=0==t.length?n:c(e[r],t.slice(0),n);else{if(!i)return n;var r=i.replace(/^\s*|\s*$/g,"");if(s(e=e||{},Array)){for(var a={},o=0;o<e.length;++o)a[o]=e[o];e=a}e[r]=0==t.length?n:c(e[r],t.slice(0),n)}return e};return i.prototype={queryObject:!0,parseNew:function(){var n=this;return n.keys={},jQuery.each(arguments,function(){var e=""+this;e=(e=e.replace(/^[?#]/,"")).replace(/[;&]$/,""),l&&(e=e.replace(/[+]/g," ")),jQuery.each(e.split(/[&;]/),function(){var e=decodeURIComponent(this.split("=")[0]||""),t=decodeURIComponent(this.split("=")[1]||"");e&&(r&&(/^[+-]?[0-9]+\.[0-9]*$/.test(t)?t=parseFloat(t):/^[+-]?[1-9][0-9]*$/.test(t)&&(t=parseInt(t,10))),n.SET(e,t=!t&&0!==t||t))})}),n},has:function(e,t){e=this.get(e);return s(e,t)},GET:function(e){if(!s(e))return this.keys;for(var t=o(e),e=t[0],n=t[1],i=this.keys[e];null!=i&&0!=n.length;)i=i[n.shift()];return"number"==typeof i?i:i||""},get:function(e){e=this.GET(e);return s(e,Object)?jQuery.extend(!0,{},e):s(e,Array)?e.slice(0):e},SET:function(e,t){var n=s(t)?t:null,i=o(e),t=i[0],e=i[1],i=this.keys[t];return this.keys[t]=c(i,e.slice(0),n),this},set:function(e,t){return this.copy().SET(e,t)},REMOVE:function(e,t){if(t){var n=this.GET(e);if(s(n,Array)){for(tval in n)n[tval]=n[tval].toString();var i=$.inArray(t,n);if(!(0<=i))return;e=(e=n.splice(i,1))[i]}else if(t!=n)return}return this.SET(e,null).COMPACT()},remove:function(e,t){return this.copy().REMOVE(e,t)},EMPTY:function(){var n=this;return jQuery.each(n.keys,function(e,t){delete n.keys[e]}),n},load:function(e){var t=e.replace(/^.*?[#](.+?)(?:\?.+)?$/,"$1"),n=e.replace(/^.*?[?](.+?)(?:#.+)?$/,"$1");return new i(e.length==n.length?"":n,e.length==t.length?"":t)},empty:function(){return this.copy().EMPTY()},copy:function(){return new i(this)},COMPACT:function(){return this.keys=function i(e){var o="object"==typeof e?s(e,Array)?[]:{}:e;return"object"==typeof e&&jQuery.each(e,function(e,t){return!s(t)||(n=o,t=i(t),void(s(n,Array)?n.push(t):n[e]=t));var n}),o}(this.keys),this},compact:function(){return this.copy().COMPACT()},toString:function(){function o(e){return e+="",l&&(e=e.replace(/ /g,"+")),encodeURIComponent(e)}var e=[],r=[],a=function(e,t){function i(e){return(t&&""!=t?[t,"[",e,"]"]:[e]).join("")}jQuery.each(e,function(e,t){var n;"object"==typeof t?a(t,i(e)):(n=r,e=i(e),s(t=t)&&!1!==t&&(e=[o(e)],!0!==t&&(e.push("="),e.push(o(t))),n.push(e.join(""))))})};return a(this.keys),0<r.length&&e.push(n),e.push(r.join(t)),e.join("")}},new i(location.search,location.hash)}}(jQuery.query||{}),jQuery(document).ready(function(e){0<e(".accordion").length&&e(".accordion-handle").click(function(){e(this).parent(".accordion").toggleClass("open")})}),jQuery(document).ready(function(e){e(".open-alum-link").magnificPopup({type:"inline",midClick:!0}),e(".alum-add-story").on("click",function(){e(".alum-add-story-form").toggle(),e(".alum-add-story-form").is(":visible")?e(".alum-add-story").html("Hide Form"):e(".alum-add-story").html("Add My Story")}),e(".alum-back").on("click",function(){location.href="/alumni/"}),e(".alum-reset").on("click",function(){location.href="/classnotes"}),e(".year-more").on("click",function(){e(".year-more-details").show(),e(".year-more").hide()})}),jQuery(document).ready(function(t){function n(){t(".area-faculty .photo").height(t(".area-faculty .photo").width())}var i,o,e;t(".back-to-areas").click(function(){location.href="/areas-of-study"}),t(".area .tab-nav li").on("click",function(){t(".area .tab-nav li.active").removeClass("active");var e=t(this).attr("class");t(this).addClass("active"),t(".area .tab-content:visible").removeClass("active"),t(".area .tab-content."+e).addClass("active"),n()}),0<t(".area").length&&(i=t(".area").offset(),t(window).on("resize",function(){i=t(".area").offset(),n()}),t(window).on("scroll",function(){var e=t(window).scrollTop();768<=t(window).innerWidth()&&(e>i.top?t(".area .tab-nav").addClass("scrolled"):t(".area .tab-nav").removeClass("scrolled"))}),n()),0<t(".area-listing").length&&(o=t(".area-listing"),e=t(".area-filter select"),e.on("change",function(){o.find(".area").show();var e=t(this).val();"all"!=t(this).val()&&o.find(".area:not(."+e+")").each(function(){t(this).hide()})}))}),jQuery(document).ready(function(t){t(".boxes").length&&t(".boxes .abox").click(function(){var e=t(this).data("href");0<e.length&&(location.href=e)})}),jQuery(document).ready(function(t){t("a.btn[download]").on("click",function(e){e.preventDefault(),forceDownload(t(this).attr("href"),t(this).attr("download"))})}),jQuery(document).ready(function(t){t(".connected-learning-search")&&t(".connected-learning-search-form").on("submit",function(){event.preventDefault();var e=t(".connected-learning-search-term").val();t.ajax("/wp-json/wooster/v1/connections/?filter_term="+encodeURIComponent(e)).done(function(e){console.log(e),t(".result-box.areas li:not(.all)").remove();var n="";t.each(e.areas,function(e,t){n+='<li><a href="'+t.permalink+'">'+t.post_title+"</a></li>"}),t(".result-box.areas ul").prepend(n),e.experiential[0]&&(t(".result-box.experiential li a").html(e.experiential[0].post_title).attr("href",e.experiential[0].permalink),"false"!=e.experiential[0].thumbnail&&t(".result-box.experiential").css("background-image","url("+e.experiential[0].thumbnail+")")),e.experiential[0]&&(t(".result-box.independent li a").html(e.independent[0].post_title).attr("href",e.independent[0].permalink),"false"!=e.independent[0].thumbnail&&t(".result-box.independent").css("background-image","url("+e.independent[0].thumbnail+")")),e.news[0]&&(t(".result-bar.news .content a").html(e.news[0].post_title).attr("href",e.news[0].permalink),"false"!=e.news[0].thumbnail&&t(".result-bar.news .image").css("background-image","url("+e.news[0].thumbnail+")")),e.alumni[0]&&(t(".result-bar.profile .content a").html(e.alumni[0].post_title).attr("href",e.alumni[0].permalink),"false"!=e.alumni[0].thumbnail&&t(".result-bar.profile .image").css("background-image","url("+e.alumni[0].thumbnail+")")),t(".connected-learning-results").slideDown(500)})})}),jQuery(document).ready(function(t){t(".counselor-search-form").submit(function(){event.preventDefault();var e=t(".zip-search").val();t.get("/wp-content/themes/wooster/library/counselors/adm-zip-query.php?zip="+e,function(e){e=JSON.parse(e);void 0!==e.username?location.href="/bio/"+e.username:t(".counselor-search-form").append('<div class="error">No counselors found.</div>')})})}),jQuery(document).ready(function(e){e("table.display").dataTable()});var jaaulde=window.jaaulde||{};jaaulde.utils=jaaulde.utils||{},jaaulde.utils.cookies=function(){var i={expiresAt:null,path:"/",domain:null,secure:!1},t=function(e){var t,n;return"object"!=typeof e||null===e?t=i:(t={expiresAt:i.expiresAt,path:i.path,domain:i.domain,secure:i.secure},"object"==typeof e.expiresAt&&e.expiresAt instanceof Date?t.expiresAt=e.expiresAt:"number"==typeof e.hoursToLive&&0!==e.hoursToLive&&((n=new Date).setTime(n.getTime()+60*e.hoursToLive*60*1e3),t.expiresAt=n),"string"==typeof e.path&&""!==e.path&&(t.path=e.path),"string"==typeof e.domain&&""!==e.domain&&(t.domain=e.domain),!0===e.secure&&(t.secure=e.secure)),t},o=function(e){return("object"==typeof(e=t(e)).expiresAt&&e.expiresAt instanceof Date?"; expires="+e.expiresAt.toGMTString():"")+"; path="+e.path+("string"==typeof e.domain?"; domain="+e.domain:"")+(!0===e.secure?"; secure":"")},r=function(){for(var t,e,n,i,o={},r=document.cookie.split(";"),a=0;a<r.length;a+=1){e=(t=r[a].split("="))[0].replace(/^\s*/,"").replace(/\s*$/,"");try{n=decodeURIComponent(t[1])}catch(e){n=t[1]}if("object"==typeof JSON&&null!==JSON&&"function"==typeof JSON.parse)try{i=n,n=JSON.parse(n)}catch(e){n=i}o[e]=n}return o},e=function(){};return e.prototype.get=function(e){var t,n,i=r();if("string"==typeof e)t=void 0!==i[e]?i[e]:null;else if("object"==typeof e&&null!==e)for(n in t={},e)void 0!==i[e[n]]?t[e[n]]=i[e[n]]:t[e[n]]=null;else t=i;return t},e.prototype.filter=function(e){var t,n={},i=r();for(t in"string"==typeof e&&(e=new RegExp(e)),i)t.match(e)&&(n[t]=i[t]);return n},e.prototype.set=function(e,t,n){if("object"==typeof n&&null!==n||(n={}),null==t)t="",n.hoursToLive=-8760;else if("string"!=typeof t){if("object"!=typeof JSON||null===JSON||"function"!=typeof JSON.stringify)throw new Error("cookies.set() received non-string value and could not serialize.");t=JSON.stringify(t)}n=o(n);document.cookie=e+"="+encodeURIComponent(t)+n},e.prototype.del=function(e,t){var n,i={};for(n in"object"==typeof t&&null!==t||(t={}),"boolean"==typeof e&&!0===e?i=this.get():"string"==typeof e&&(i[e]=!0),i)"string"==typeof n&&""!==n&&this.set(n,null,t)},e.prototype.test=function(){var e=!1;return this.set("cT","data"),"data"===this.get("cT")&&(this.del("cT"),e=!0),e},e.prototype.setOptions=function(e){i=t(e="object"!=typeof e?null:e)},new e}(),window.jQuery&&function(a){a.cookies=jaaulde.utils.cookies;var e={cookify:function(r){return this.each(function(){var e,t,n,i=["name","id"],o=a(this);for(e in i)if(!isNaN(e)&&"string"==typeof(t=o.attr(i[e]))&&""!==t){o.is(":checkbox, :radio")?o.attr("checked")&&(n=o.val()):n=o.is(":input")?o.val():o.html(),"string"==typeof n&&""!==n||(n=null),a.cookies.set(t,n,r);break}})},cookieFill:function(){return this.each(function(){for(var e,t,n=["name","id"],i=a(this),o=function(){return!!(e=n.pop())};o();)if("string"==typeof(t=i.attr(e))&&""!==t){null!==(t=a.cookies.get(t))&&(i.is(":checkbox, :radio")?i.val()===t?i.attr("checked","checked"):i.removeAttr("checked"):i.is(":input")?i.val(t):i.html(t));break}})},cookieBind:function(t){return this.each(function(){var e=a(this);e.cookieFill().change(function(){e.cookify(t)})})}};a.each(e,function(e){a.fn[e]=this})}(window.jQuery),jQuery(document).ready(function(e){var t,n=e(".emergency-bar-container");n.length&&(t=n.attr("class").replace(" red-light","").replace(" red-dark","").replace(" orange","").replace(" yellow","").replace(" teal","").replace(" grey","").replace(" grey-light","").replace("emergency-bar-container",""),null==e.cookies.get("emergency-"+t+"shown")&&(e(".emergency-bar-container").addClass("show"),e(".emergency-bar-container .close").click(function(){e(".emergency-bar-container").removeClass("show"),e.cookies.set("emergency-"+t+"shown","true")})))}),jQuery(document).ready(function(e){e(".day-event-list").length&&e("table.calendar td").click(function(){e(".day-event-list").html(e(this).find(".day-events").html())}),e("select.event-category").change(function(){location.href=e.query.set("event_category",e(this).val())}),e("a.month-nav").click(function(){location.href=e.query.set("moyr",e(this).data("month")+"-"+e(this).data("year"))})}),jQuery.extend(jQuery.expr[":"],{icontains:function(e,t,n,i){return 0<=(e.textContent||e.innerText||"").toLowerCase().indexOf((n[3]||"").toLowerCase())}}),jQuery(document).ready(function(t){var n,i;t(".entry-job")&&(n=t(".job-count strong"),i=n.text(),t("#job-search").on("keyup",function(){var e=t(this).val();""==e?n.html(i):n.html("&nbsp;"),t(".entry-job:not(:icontains("+e+"))").each(function(e){t(this).hide()}),t(".entry-job:icontains("+e+")").each(function(e){t(this).show()})}))}),jQuery(document).ready(function(t){t("#google_translate_element").bind("DOMNodeInserted",function(e){t(".goog-te-menu-value span:first").html("Translate"),t(".goog-te-menu-frame.skiptranslate").load(function(){setTimeout(function(){t(".goog-te-menu-frame.skiptranslate").contents().find(".goog-te-menu2-item-selected .text").html("Translate")},100)})})}),jQuery(document).ready(function(e){e(".content img").removeAttr("width").removeAttr("height"),e(".lightbox-iframe, .lightbox-video, .video").magnificPopup({type:"iframe"}),e(".lightbox").magnificPopup({type:"image"}),e(".content").fitVids()}),jQuery(document).ready(function(n){var e=n("header").find(".menu-show"),t=n(".menu-overlay"),i=t.find(".close");e.click(function(){t.fadeIn(400)}),i.click(function(){t.fadeOut(400)}),t.find(".main-menu").find("a").click(function(){var e=n(this).parent("li"),t=n(this).next("ul");!t.is(":visible")&&e.hasClass("menu-item-has-children")&&(event.preventDefault(),e.addClass("open"),t.show())}),n("select.quick-nav").on("change",function(){""!=n(this).val()&&(location.href=n(this).val())});i=n(".sidebar ul.menu");i.find("a").click(function(){var e=n(this).parent("li"),t=n(this).next("ul");!t.is(":visible")&&e.hasClass("menu-item-has-children")&&(event.preventDefault(),e.addClass("open"),t.show())}),i.find("li").each(function(){var e=n(this);(e.hasClass("current_page_parent")||e.hasClass("current-menu-item")||e.hasClass("current-menu-ancestor"))&&(e.addClass("open"),e.find("ul.sub-menu").addClass("open"))}),n(".category-select").on("change",function(){location.href="/category/"+n(this).val()})}),jQuery.expr[":"].icontains=function(e,t,n){return 0<=jQuery(e).text().toUpperCase().indexOf(n[3].toUpperCase())},jQuery(document).ready(function(t){t(".people-search")&&t(".people-search input[type=text]").on("keyup",function(){t(".person-entry").addClass("visible"),t(".person-entry:not(:icontains('"+t(this).val()+"'))").removeClass("visible")}),t(".person-bio-link").click(function(){var e="#"+t(this).attr("rel"),e=t(e).html();console.log(e),t.magnificPopup.open({items:{src:e},type:"inline"})})}),jQuery(document).ready(function(l){l(".post-showcase").each(function(){var n,i,o,r,a,t=l(this),s=0,e=t.find(".slide"),c=e.size();void 0!==t&&(n=function(){return t.find(".slide.visible")},i=function(){var e=n().find("img").css("height");t.height(e)},(o=e.first()).addClass("visible"),setTimeout(function(){i()},500),r=e.last(),a=function(){var e=n(),t=e.next(".slide");t.length||(t=o),e.removeClass("visible"),t.addClass("visible"),i()},setTimeout(function(){1<c&&(s=setInterval(a,1e4))},500),t.find(".showcase-nav a").click(function(){var e,t;l(this).hasClass("previous")?(e=n(),(t=e.prev(".slide")).length||(t=r),e.removeClass("visible"),t.addClass("visible"),i()):a(),1<c&&clearInterval(s)}))})}),jQuery(document).ready(function(e){e("pre,code").each(function(){e(this).html(e(this).html().replace(/{/g,"[").replace(/}/g,"]"))})}),jQuery(document).ready(function(c){c(".showcase").each(function(){var n,i,o,r,e=c(this),a=0,t=e.find(".slide"),s=t.size();768<=c(window).innerWidth()&&t.each(function(){c(this).find(".slide-content")}),void 0!==e&&((n=t.first()).addClass("visible"),i=t.last(),o=function(){var e=r(),t=e.next(".slide");t.length||(t=n),e.removeClass("visible"),t.addClass("visible")},r=function(){return e.find(".slide.visible")},setTimeout(function(){1<s&&(a=setInterval(o,1e4))},500),e.find(".showcase-nav a").click(function(){var e,t;c(this).hasClass("previous")?(e=r(),(t=e.prev(".slide")).length||(t=i),e.removeClass("visible"),t.addClass("visible")):o(),1<s&&clearInterval(a)}))}),c(".slide").on("click",function(){var e,t;c(this).data("href")&&(e=c(this).data("href"),t=c(this).attr("class"),console.log(t),e.match(/youtube.com/g)||e.match(/youtu.be/g)||e.match(/vimeo.com/g)||t.match(/iframe/g)?c.magnificPopup.open({items:{src:e},type:"iframe"},0):location.href=c(this).data("href"))})});