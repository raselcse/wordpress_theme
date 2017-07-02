/*
* copyright (C) www.devn.co
*/
var doc = document;
var obj = function(i,n){
	var elm = doc.getElementById(i);
	if( n>0 ){
		while( elm = elm.parentNode )n--;
	};
	return elm;
}	
var elm = function( tag ){ return doc.createElement( tag ); };
var dsa = {
	out : {
		timeOut : null,
		event : {
			clickEdit : function( el ){
				
				var items = el.querySelectorAll('.cssproperty,.cssvalue,.disable-btn');
				for( var i=0; i < items.length; i++ )
				{
					if( items[i].className == 'disable-btn' ){
					
						items[i].onclick = function(e){
							var p = this.parentNode;
							if( p.className == 'cssProperty-row' )
								p.className = 'cssProperty-row disable';
							else p.className = 'cssProperty-row';
						};
						
					}else{
						items[i].onclick = function(e){
						
							dsa.out.event.edit( this );
							
						};
					};
				};
			},
			edit : function( el ){
			
				
			
				if( el.innerHTML.indexOf('<input') > -1 )
					return;
				var inp = elm('input');
				inp.className = 'property-input';
				inp.style.width = dsa.fn.inputWidth( el.innerHTML )+'px';
				inp.onkeypress = function(event){
					this.style.width = dsa.fn.inputWidth(this.value)+'px';
					if( event.keyCode == 13 || event.keyCode == 9 )
						return dsa.out.next(this);
				};

				inp.onkeyup = function(event){
						
					if( this.parentNode.className == 'cssproperty' )
						cpa.slectorComplete( event , this );
					else cpa.propertiesComplete( event , this );	
					
					var vl = this.value;
					this.value=dsa.fn.trim(this.value);
					if( ( vl.indexOf(':') > -1 && this.parentNode.className == 'cssproperty' ) || ( vl.indexOf(';') > -1 && this.parentNode.className == 'cssvalue' ) )
						return dsa.out.next(this);
					
					dsa.out.applyCss( this );
					
				};
				
				inp.onblur=function(){ dsa.out.event.blur(this); };
				inp.value = el.innerHTML.replace('"','\"');
				
				el.innerHTML = '';
				el.appendChild( inp );
				
				inp.select();
				
				
				if( el.className != 'cssproperty' ){
					inp.onkeydown = function(event){
						cpa.propertiesComplete( event , this , 'keyDown' );
					};
				};	
				
				clearTimeout( dsa.out.timeOut );
				/*don't reload output while editing*/
				
			},
			blur : function( el ){

				if( el.value == '' )
				{
					el.parentNode.parentNode.parentNode.removeChild(el.parentNode.parentNode);
					dsa.out.reload();
					return;
				};	
				el.parentNode.innerHTML = el.value;
				
				dsa.out.timeOut = setTimeout("dsa.out.reload()",100);
				
			}
		},
		next : function( el ){
		
			var span = el.parentNode ;
			var li = span.parentNode ;
			var nextSpan = dsa.fn.next( span );
			var lastestLi = li.parentNode.querySelector('.lastestRow');
			if( nextSpan ){
				dsa.out.event.edit( nextSpan );
			}else{
				nextLi = dsa.fn.next( li );
				if( nextLi && nextLi.className == 'cssProperty-row' ){
					var np = nextLi.querySelector('.cssproperty') 
					if( np )dsa.out.event.edit( np );
				}else{
				
					var newLi = elm('li');
					newLi.className = "cssProperty-row";
					newLi.innerHTML = '<disable class="disable-btn"></disable> <span class="cssproperty"></span>: <span class="cssvalue"></span>;';
					
					li.parentNode.insertBefore( newLi , lastestLi );

					dsa.out.event.clickEdit( obj('content-demo') );
					
					dsa.out.event.edit( newLi.querySelector('.cssproperty') );
					
				};
			};
			
		},
		applyCss : function( inp ){
			
			var li  = inp.parentNode.parentNode;
			var index = parseInt( li.parentNode.className.split('index-')[1] );
			var property = li.querySelector('.cssproperty').innerHTML;
			if( inp.parentNode.className == 'cssproperty' )
				property = inp.value;	
			
			property = dsa.fn.cssProperty( property );
			
			var value = li.querySelector('.cssvalue').innerHTML;
			if( inp.parentNode.className == 'cssvalue' )
				value = inp.value;
			
			if( property!= '' )
				eval('rules['+index+'].style.'+property+'="'+value+'"');	
				
		},
		reload : function(){

			document.getElementById('iFrameInspect').contentWindow.onInspect( innerDoc.targetInspect );
					
		}
	},
	fn : {
		inputWidth : function( text ) {
			
			var tmp = document.createElement("span");
			tmp.className = "input-element tmp-element";
			tmp.innerHTML = text.replace([/&/g,/</g,/>/g,/ /g,/'/g,/"/g,/\(/g,/\)/g],['&amp;','&lt;','&gt;',' &nbsp; &nbsp; ',' &nbsp; &nbsp; ',' &nbsp; &nbsp; ',' &nbsp; &nbsp; ',' &nbsp; &nbsp; ']);
			document.body.appendChild(tmp);
			var theWidth = tmp.offsetWidth;
			document.body.removeChild(tmp);
			return theWidth+3;
			
		},
		cssProperty : function( input ){
			var input = input.split('-');
			for( var i=1; i < input.length; i++)
				input[i] = this.ucfirst( input[i] );
			return input.join('')	
		},
		ucfirst : function(str) {
			str += '';
			var f = str.charAt(0).toUpperCase();
			return f + str.substr(1);
		},
		next : function( el ){

			var nextSibling = el.nextSibling;
			while(nextSibling && nextSibling.nodeType != 1) {
				nextSibling = nextSibling.nextSibling
			}
			return nextSibling;
		},		
		prev : function( el ){

			var prevSibling = el.previousSibling;
			while( prevSibling && prevSibling.nodeType != 1) {
				prevSibling = prevSibling.previousSibling
			}
			return prevSibling;
		},
		trim : function( inp ){
			var specialChars = "@$^&*+=[]{}|:<>?;";
			//^a-zA-Z0-9 '-"%,#.,
			for (var i = 0; i < specialChars.length; i++) {
				inp = inp .replace(new RegExp("\\" + specialChars[i], 'gi'), '');
			}
			return inp;
		}
	}
};