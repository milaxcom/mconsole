var Obj = {
		$ : function (id) { return document.getElementById(id); },
		is_ie:function(){return((this.clientPC.indexOf('msie') != -1) && (this.clientPC.indexOf('opera') == -1))},
		getKey:function(event){
			var Event	= (event||window.event),
				code	= (Event.keyCode||event.which||false),
				shift	= Event.shiftKey,
				alt		= Event.altKey,
				ctrl	= Event.ctrlKey;
			return {code:code, shift:shift, alt:alt, ctrl:ctrl};
		},
		createElement : function(tag, attribs, styles, parent, first) {
			var el = document.createElement(tag);
			if (attribs) this.setAttribs(el, attribs);
			if (styles) this.setStyles(el, styles);
			if (parent) {
				if(this.isElement(first))
					parent.insertBefore(el, first);
				else
					parent.appendChild(el);
			}
			return el;
		},
		isElement  : function(object) { return !!((object && object.nodeType == 1) || (object && object.nodeName)); },
		setAttribs : function(el, attribs) {
			if (!this.isElement(el)) { return; }
			for (var x in attribs) el[x] = attribs[x];
		},
		setStyles  : function(el, styles) {
			if(!this.isElement(el)) { return; }
			for(var x in styles) el.style[x] = styles[x];
		},
		echo : function(ob) {
				if (!this.add) this.$('Objtxt').value = "";
				else this.$('Objtxt').value += "\r\n---\r\n";
			if (typeof ob != "object") return this.$('Objtxt').value += ob;
			for (var x in ob) {
				if ( !this.type ) {
					this.set( x, ob[x] );
				}else{
					if ( typeof ob[x] == this.type )
						this.set( x, ob[x] );
						
				}
			}
		},
		
		set : function ( key, val ) {
			if ( this.list )
				this.$('Objtxt').value += key+ " - " + typeof val + "\r\n";
			else
				this.$('Objtxt').value += key+ " - " + val + "\r\n";
		},
		
		DOM : function(ob, add, type, list ) {
			this.add	= (add)		? true : false;
			this.type	= (type)	? type : false;
			this.list	= (list)	? true : false;
			if (!this.isElement( this.$('Objtxt') ) ) {
			
				var ObjInputValue = "[CurOBJ]";
				this.memory = ob;

				var ObjInput = this.createElement('input',{value : ObjInputValue, id:"ObjInput"},{width:"370px",position:"absolute",top:"45px", border:"2px solid green"},document.body, document.body.children[0]);
			
				this.Handle.add(ObjInput, "keydown", this.preObjSend);
				
				var ObjSend = this.createElement('input',{type:"button",value : ">>", id:"ObjSend"},{width:"31px",position:"absolute",top:"45px", border:"2px solid green",marginLeft:"373px"},document.body, document.body.children[0]);
				
				this.Handle.add(ObjSend, "mousedown", this.ObjSend);
			
				this.createElement("textarea", {id:"Objtxt"}, {width:"400px",height:"400px",position:"absolute",fontSize:"11px", top:"66px",border:"2px solid green"}, document.body, document.body.children[0]);
				
			}
			if (!this.isElement( this.$('Objtxt') )) return;
			var zindex = zIndex.set();
			this.setStyles(this.$('ObjSend'), {zIndex:zindex});
			this.setStyles(this.$('Objtxt'), {zIndex:zindex});
			this.setStyles(this.$('ObjInput'), {zIndex:zindex});
			
			
			this.echo(ob);
		},
		preObjSend : function(event) {
			if ( Obj.getKey(event).code == 13) Obj.ObjSend();		
		},
		ObjSend : function () {
			var This			= Obj,
				ObjInputValue	= This.$('ObjInput').value;
			This.$('ObjInput').value = ObjInputValue.replace(/ *$/,"");

			if ( ObjInputValue == "exit" ) {
				delete This.memory;
				return LS.remove( "ObjInput" ).remove( "ObjSend" ).remove( "Objtxt" );
			}
			
			This.add = false;
			if ( /\[CurOBJ\]/.test(ObjInputValue) ) {
				ObjInputValue = ObjInputValue.replace("[CurOBJ]", "");
				ObjInputValue = ObjInputValue.split(".");
				
				var nextEnter = This.memory;
				
				if (ObjInputValue.length >=2) {
					for (var i = 1 ; i < ObjInputValue.length ; i++){
						ObjInputValue[i] = ObjInputValue[i].replace(/ *$/,"");
						nextEnter = nextEnter[ObjInputValue[i]];
					}
				}
				This.echo(nextEnter);
			}
		},
		EHandle:[],
		NHandle:0,
		Handle:(function(){
			var guid=0;
			function commonHandle(event){var handlers=this.events[event.type];for(var g in handlers){var handler=handlers[g];if(handler.call(this,event)===false){
			if(!Obj.is_ie()){event.preventDefault();event.stopPropagation();}
			} } }
			return{
				add:function(elem,type,handler,memory){
					if(elem.setInterval&&(elem!=window&&!elem.frameElement)){elem=window;}if(!handler.guid){handler.guid=++guid;}if(!elem.events){elem.events={};elem.handle=function(event){if(typeof Obj.Handle!=="undefined"){return commonHandle.call(elem,event);} };}if(!elem.events[type]){elem.events[type]={};if(elem.addEventListener)elem.addEventListener(type,elem.handle,false);else if(elem.attachEvent)elem.attachEvent("on"+type,elem.handle);}
					if(memory){elem.LSmem=memory;elem.LSmem.el=elem;}
					elem.events[type][handler.guid]=handler;Obj.EHandle[Obj.NHandle++]=[elem,type,handler];},
				remove:function(elem,type,handler){
					var handlers=elem.events&&elem.events[type];
					if(!handlers)return;
					delete handlers[handler.guid];for(var any in handlers)return;if(elem.removeEventListener)elem.removeEventListener(type,elem.handle,false);else if(elem.detachEvent)elem.detachEvent("on"+type,elem.handle);delete elem.events[type];for(var any in elem.events)return;try{delete elem.handle;delete elem.events;}catch(e){} }
		};})()
	};
	var set_zIndex = {
		zIndex : 999998,
		zIndex : function() {
			this.zIndex = 999998;
			this.set = function() { return(++this.zIndex); }
		}
	};
	var zIndex = new set_zIndex.zIndex();
	
	function PP( data, rWrite, type, list ) {
		rWrite	= (rWrite)	?true:false;
		type	= (type)	?type:false;
		list	= (list)	?true:false;
		Obj.DOM( data, rWrite, type, list );
	}
	
	
	
	var LS = {
		data:{}, //��������� ����������
		$:function(e){if(!e)return;return document.getElementById(e);},
		b:function(){return document.compatMode&&document.compatMode!='BackCompat'?document.documentElement:document.body;},
		clientPC:navigator.userAgent.toLowerCase(),
		clientVer:parseInt(navigator.appVersion),
		blockSelect:function(){if(window.getSelection){window.getSelection().removeAllRanges();}else if(document.selection&&document.selection.clear)document.selection.clear();},
		e :function(event){return(event||window.event);},
		dE :(document.documentElement),
		h : function(){ return (this.b().getElementsByTagName('head')[0]||false);},
		P:function(e){var e=this.e(e);if(e.pageX==null&&e.clientX!=null){var b=this.b();e.pageX=e.clientX+(b&&b.scrollLeft||0)-(b.clientLeft||0);e.pageY=e.clientY+(b&&b.scrollTop||0)-(b.clientTop||0);}return e;},
		Elem:function(e){return(e.srcElement||e.target);},
		createElement:function(tag,attribs,styles,parent,first,afterFirst){
			if (attribs.id)
				if ( this.isElement( this.$(attribs.id) ) ) return this.$(attribs.id);
			var el = (tag == '#text') ? document.createTextNode(attribs) : document.createElement(tag);
			if (this.isObject(attribs)) this.setAttribs(el, attribs);
			if (this.isObject(styles))  this.setStyles(el,  styles);
			if (parent) {
				if (this.isElement(first)) {
					first = (afterFirst) ? first.nextSibling : first;
					parent.insertBefore(el, first);
				}
				else { parent.appendChild(el); }
			}
			return el;
		},
		
		createIframe:function(attribs,styles,parent){
			if(attribs.id)if(this.isElement(this.$(attribs.id)))return this.$(attribs.id);
			if(window.ActiveXObject){
				var Attribs='';
				for(var name in attribs)Attribs += name+'="'+attribs[name]+'" ';
				var el = document.createElement('<iframe '+Attribs+'>');
				this.setStyles(el,styles);
				if(parent)parent.appendChild(el);
			}else return this.createElement("iframe",attribs,styles,parent);
			return el;
		},
		createForm:function(attribs,styles,parent){
			if(attribs.id)if(this.isElement(this.$(attribs.id)))return this.$(attribs.id);
			if(window.ActiveXObject){
				var Attribs='';
				for(var name in attribs)Attribs += name+'="'+attribs[name]+'" ';
				var el = document.createElement('<form '+Attribs+'>');
				this.setStyles(el,styles);
				if(parent)parent.appendChild(el);
			}else return this.createElement("form",attribs,styles,parent);
			return el;
		},
		dellArrElem:function(arr,n){var obj=[];var j=0;for (var i in arr){if(n!=i){obj[j]=arr[i];j++;}}return obj;},
		getCenter:function(){
			var W=(this.is_ie?LS.b().clientWidth:self.innerWidth)+LS.b().scrollLeft;
			var H=(this.is_ie()?LS.b().clientHeight:self.innerHeight)+LS.b().scrollTop;
			return {W:W,H:H};
		},
		getKey:function(event){
			var Event = (event||window.event);
			var code = (Event.keyCode||event.which||false);
			var shift = Event.shiftKey;
			var alt = Event.altKey;
			var ctrl = Event.ctrlKey;
			return {code:code, shift:shift, alt:alt, ctrl:ctrl};
		},
		getNum:function(){return Math.floor(Math.random()*999999)},
		getRandomNum:function( min, max ) {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		},
		getPosition:function(el,event,parent){var e=this.P(event);if((e.offsetX||e.offsetY)&&parent){x=e.offsetX;y=e.offsetY;}else{x=e.pageX-el.offsetLeft;y=e.pageY-el.offsetTop;}return{x:x,y:y};},
		isBoolean:function(obj){return(typeof(obj)=='boolean');},
		isElement:function(object){
			/* object = (LS.isString(object)) ? LS.$(object) : object; */
			return!!(object&&object.nodeType==1);
		},
		is_ie:function(){return((this.clientPC.indexOf('msie') != -1) && (this.clientPC.indexOf('opera') == -1))},
		isNum:function(n){
			n = this.setNum(n);
			return (typeof(n) == 'number' && !/NaN/.test(n));
		},
		isObject:function(obj){return(typeof(obj)=='object');},
		isString:function(obj){return(typeof(obj)=='string');},
		LoadClass:{
			init:function(var_){
				if(typeof window[var_]!='undefined')return;
				new AJAX.ContentLoader({value:"",url:"/jsload/",com:var_},LS.LoadClass.Oncall);return false;
			},
			set:function(var_,str,init){if(typeof window[var_]!='undefined')return;window[var_]=str;if(typeof init=="function")init.call();},
			Oncall:function(){
				var obj=this.objData;
				if(typeof obj.Global=="string"&&typeof obj.data=="object"){
					init=(typeof obj.init=="function")?obj.init:false;
					LS.LoadClass.set(obj.Global,obj.data,init);
				}
			}
		},
		pressInit:function(KeyList,Func,e,main){
			if(typeof KeyList!="string"||typeof Func!="function")return;
			KeyList=KeyList.split(",");
			Key=this.getKey(e).code;
			for(var v in KeyList){
				if(Key==KeyList[v]){
					Func.call((main)?main:false);
					//Obj.DOM(main.LS);
				}
			}
		},
		remElement:function(el,parent){if(!this.isElement(el)||!this.isElement(parent))return;parent.removeChild(el);},
		remObjects:function(parent){if(!this.isElement(parent))return;for(i=0;i=parent.childNodes.length;i++){parent.removeChild(parent.childNodes[0]);}},
		remove:function(el){
			el=(this.isString(el))?this.$(el):el;
			if(!this.isElement(el))return this;
			var parent = el.parentNode
			if(typeof parent!="object")return this;
			this.remElement(el,parent);
			return this;
		},
		setAttribs:function(el,attribs){if(!this.isElement(el))return;
			for(var x in attribs)
				if(/^\$/.test(x))
					el[x.replace(/^\$/,"")] += attribs[x];
					else el[x]=attribs[x];
		},
		setId:function(id){
			var Id = id+this.getNum();
			if(this.isElement(this.$(Id)))return this.setId(id);
			return Id;
		},
		setNum:function(n){return(n-1)+1;},
		setStyles:function(el,styles){if(!this.isElement(el))return;for(var x in styles)el.style[x]=styles[x];},
		URIc:function(t){return encodeURIComponent(t);},
		EHandle:[],
		NHandle:0,
		Handle:(function(){
			var guid=0;
			function commonHandle(event){var handlers=this.events[event.type];for(var g in handlers){var handler=handlers[g];if(handler.call(this,event)===false){
			if(!LS.is_ie()){event.preventDefault();event.stopPropagation();}
			} } }
			return{
				add:function(elem,type,handler,memory){
					if(elem.setInterval&&(elem!=window&&!elem.frameElement)){elem=window;}if(!handler.guid){handler.guid=++guid;}if(!elem.events){elem.events={};elem.handle=function(event){if(typeof LS.Handle!=="undefined"){return commonHandle.call(elem,event);} };}if(!elem.events[type]){elem.events[type]={};if(elem.addEventListener)elem.addEventListener(type,elem.handle,false);else if(elem.attachEvent)elem.attachEvent("on"+type,elem.handle);}
					if(memory){elem.LSmem=memory;elem.LSmem.el=elem;}
					elem.events[type][handler.guid]=handler;LS.EHandle[LS.NHandle++]=[elem,type,handler];},
				remove:function(elem,type,handler){
					var handlers=elem.events&&elem.events[type];
					if(!handlers)return;
					delete handlers[handler.guid];for(var any in handlers)return;if(elem.removeEventListener)elem.removeEventListener(type,elem.handle,false);else if(elem.detachEvent)elem.detachEvent("on"+type,elem.handle);delete elem.events[type];for(var any in elem.events)return;try{delete elem.handle;delete elem.events;}catch(e){} }
			};})()
	};