/*
*	(c) www.devn.co
*/


var $ = jQuery,
    doc = document;
var grid = {
	changed : false,
    index: 100,
    scanOverlap: function () {
        var arrgs = doc.querySelectorAll('#grid-wrapest .block-wrpest');
        $('#grid-wrapest .overlap').removeClass('overlap');
        for (var i = 0; i < arrgs.length; i++) {
            for (var j = 0; j < arrgs.length; j++) {
                if (i != j) {
                    if (grid.checkOverlap(arrgs[i], arrgs[j])) $(arrgs[i]).addClass('overlap')
                }
            }
        }
    },
    epo: function (x, y) {
        return doc.elementFromPoint(x, y)
    },
    checkOverlap: function (elm1, elm2) {
        var rect1 = {
            top: elm1.offsetTop,
            left: elm1.offsetLeft,
            right: elm1.offsetLeft + elm1.offsetWidth,
            bottom: elm1.offsetTop + elm1.offsetHeight
        };
        var rect2 = {
            top: elm2.offsetTop,
            left: elm2.offsetLeft,
            right: elm2.offsetLeft + elm2.offsetWidth,
            bottom: elm2.offsetTop + elm2.offsetHeight
        };
        var overlap = !(rect1.right < rect2.left || rect1.left > rect2.right || rect1.bottom < rect2.top + 1 || rect1.top + 1 > rect2.bottom);
        return overlap
    },
    scan: function (e, el) {
        var topCurso = !document.all ? e.clientY : event.clientY;
        var leftCurso = !document.all ? e.clientX : event.clientX;
        $T(el).setOffsetPage();
        leftCurso -= el.pageLeft - $T('core').fn.getScroll().left;
        topCurso -= el.pageTop - $T('core').fn.getScroll().top;
        leftCurso -= (leftCurso % 80) - 20;
        topCurso -= (topCurso % 10);
        $T('#mask-dragin').add.style('height:0px;width:0px;top:' + topCurso + 'px;left:' + leftCurso + 'px');
        $T('#mask-dragin').drag({
            begin: this.onMoving,
            cmd: this.onMoving,
            end: function () {
                this.elm.style.height = (this.elm.offsetHeight - (this.elm.offsetHeight % 10)) + 'px';
                this.elm.style.top = (this.elm.offsetTop - (this.elm.offsetTop % 10)) + 'px'
            },
            type: 'scan',
        });
    },
    onMoving: function (dir) {
        var ot = this.elm.offsetTop;
        var ol = this.elm.offsetLeft;
        var or = this.elm.parentNode.offsetWidth - this.curLeft - this.curWidth;
        var ob = this.elm.parentNode.offsetHeight - this.curTop - this.curHeight;
        if (ol + this.elm.offsetWidth > this.elm.parentNode.offsetWidth) {
            this.elm.style.width = (this.elm.parentNode.offsetWidth - ol) + 'px'
        }
        if (ot + this.elm.offsetHeight > this.elm.parentNode.offsetHeight || ot < 0) {
            this.elm.style.height = (this.elm.parentNode.offsetHeight - ot) + 'px'
        }
        if (ol < 0) {
            this.elm.style.width = (this.elm.parentNode.offsetWidth - or) + 'px';
            this.elm.style.left = '0px'
        };
        if (ot < 0) {
            this.elm.style.height = (this.elm.parentNode.offsetHeight - ob) + 'px';
            this.elm.style.top = '0px'
        };
        this.elm.style.height = (this.elm.offsetHeight - (this.elm.offsetHeight % 10)) + 'px';
        this.elm.style.top = (this.elm.offsetTop - (this.elm.offsetTop % 10)) + 'px';
        if (dir == 'overleft') {
            this.elm.style.width = (this.elm.offsetWidth - 20) + 'px';
            var curLeft = this.elm.offsetLeft;
            var curWidth = this.elm.offsetWidth;
            if (this.elm.offsetWidth % 80 > 25) this.elm.style.width = (this.elm.offsetWidth + (80 - (this.elm.offsetWidth % 80) - 20)) + 'px';
            else this.elm.style.width = (this.elm.offsetWidth - (this.elm.offsetWidth % 80) - 20) + 'px';
            var btwWidth = this.elm.offsetWidth - curWidth;
            this.elm.style.left = (curLeft - btwWidth) + 'px'
        } else {
            if (this.elm.offsetWidth % 80 > 25) this.elm.style.width = (this.elm.offsetWidth + (80 - (this.elm.offsetWidth % 80) - 20)) + 'px';
            else this.elm.style.width = (this.elm.offsetWidth - (this.elm.offsetWidth % 80) - 20) + 'px'
        }
    },
    split: {
        arrgs: [],
        layoutHorizontal: [],
        layout: [],
        setBounding: function () {
            var bod = {}, arrgs = [],
                id = 0,
                sid, cfg;
            $('#grid-wrapest .block-wrpest').each(function () {
                sid = this.querySelector('.widgets-sortables');
                if (sid) sid = sid.id;
                else{
                	var cusAre = this.querySelector('textarea.customize');
                	var customize = '';
                	var custLabel = '';
					if( this.querySelector('.sidebar-type-group') ){
						sid = this.querySelector('.sidebar-type-group').id;
					}else if( cusAre ){
						sid = cusAre.id.replace('groups[DS]','_grp_');
						customize = 'pre-saved';
						custLabel = $(this).find('.selectSidebarBtn').html().trim();
					}	
					else sid = 'undefined';
				
				};
				
                cfg = this.querySelector('.sidebar-inner');
                if (cfg && $(cfg).attr('cfg') ) cfg = JSON.parse($(cfg).attr('cfg'));
                else cfg = {
                        className: '',
                        fullWidth: 0,
                        css:''
                };
                arrgs.push({
                    "id": id++,
                    "sid": sid,
                    "customize": customize,
                    "custLabel": custLabel,
                    "cfg": cfg,
                    "height": this.offsetHeight,
                    "width": this.offsetWidth,
                    "top": this.offsetTop,
                    "left": this.offsetLeft,
                    "bottom": this.offsetTop + this.offsetHeight,
                    "right": this.offsetLeft + this.offsetWidth
                })
            });
            return arrgs
        },
        cleave: function () {
		
            var arrgs = this.fn.order(this.setBounding());
            var vitual = JSON.stringify(arrgs, replacer);
            var cleave = this.DoCleave(arrgs, 0);
            for (var k = 0; k < cleave.length; k++) {
                for (var l = 0; l < cleave[k].length; l++) {
                    if (cleave[k][l]['column'].length >= 2) {
                        cleave[k][l]['column'] = this.DoCleave(cleave[k][l]['column'], cleave[k][l]['left'])
                    }
                }
            };
            var real = JSON.stringify(cleave, replacer);
            $('#cleave-result').val(real);
            return {
                "vitual": vitual,
                "real": real,
                "height": $('#grid-wrapest').height()
            }
        },
        DoCleave: function (arrgs, leftFrom) {
            var from = 0;
            var j = 0;
            var stackH = [];
            var stackVertical = [];
            while (arrgs.length > 0 && j++ < 50) {
                from = this.cleaveHorizontal(from, arrgs, stackH)
            };
            for (var i = 0; i < stackH.length; i++) {
                stackVertical[i] = [];
                j = 0;
                from = leftFrom;
                while (stackH[i].length > 0 && j++ < 50) {
                    from = this.cleaveVertical(i, from, stackH[i], stackVertical)
                }
            };
            return stackVertical
        },
        cleaveHorizontal: function (from, arrgs, stack) {
            return this.fn.findAllNearestByTop(from, arrgs, stack)
        },
        cleaveVertical: function (index, from, arrgs, stack) {
            return this.fn.findAllNearestByLeft(index, from, arrgs, stack)
        },
        fn: {
            canCleave: [],
            order: function (arrgs) {
                var tg = null;
                for (var i = 0; i < arrgs.length; i++) {
                    for (var j = i + 1; j < arrgs.length; j++) {
                        if (arrgs[j].top < arrgs[i].top) {
                            tg = arrgs[j];
                            arrgs[j] = arrgs[i];
                            arrgs[i] = tg
                        }
                    }
                };
                return arrgs
            },
            findNearestByTop: function (from, arrgs) {
                if (!arrgs.length) return false;
                var nearest = arrgs[0];
                for (var i = 1; i < arrgs.length; i++) {
                    if (arrgs[i].top < nearest.top && arrgs[i].top > from) nearest = arrgs[i]
                };
                return nearest
            },
            findAllNearestByTop: function (from, arrgs, stack) {
                if (!arrgs.length) return false;
                var returnPart = [];
                var nearest = this.findNearestByTop(from, arrgs);
                this.canCleave[nearest.id] = false;
                while (!this.canCleave[nearest.id]) {
                    nearest = this.checkCanCleaveHori(from, nearest, arrgs)
                };
                var bottomOfWrap = nearest.bottom;
                for (var i = 0; i < arrgs.length; i++) {
                    if (bottomOfWrap >= arrgs[i].bottom && arrgs[i].top >= from) {
                        returnPart.push(arrgs[i]);
                        arrgs.splice(i--, 1)
                    }
                };
                stack.push(returnPart);
                return bottomOfWrap
            },
            checkCanCleaveHori: function (from, nearest, arrgs) {
                this.canCleave[nearest.id] = true;
                for (var i = 0; i < arrgs.length; i++) {
                    if (nearest.id !== arrgs[i].id && (arrgs[i].top >= from && arrgs[i].top < nearest.bottom && 
                    	arrgs[i].bottom > nearest.bottom)) {
                        this.canCleave[nearest.id] = false;
                        nearest = arrgs[i];
                        this.canCleave[nearest.id] = false
                    }
                };
                return nearest
            },
            smartOrder: function (arrgs) {},
            findNearestByLeft: function (from, arrgs) {
                if (!arrgs.length) return false;
                var nearest = arrgs[0];
                for (var i = 1; i < arrgs.length; i++) {
                    if (arrgs[i].left < nearest.left && arrgs[i].left > from) nearest = arrgs[i]
                };
                return nearest
            },
            findAllNearestByLeft: function (index, from, arrgs, stack) {
                if (!arrgs.length) return false;
                var returnPart = [];
                var nearest = this.findNearestByLeft(from, arrgs);
                this.canCleave[nearest.id] = false;
                while (!this.canCleave[nearest.id]) {
                    nearest = this.checkCanCleaveVertical(from, nearest, arrgs)
                };
                var rightOfWrap = nearest.right;
                for (var i = 0; i < arrgs.length; i++) {
                    if (rightOfWrap >= arrgs[i].right && arrgs[i].left >= from) {
                        returnPart.push(arrgs[i]);
                        arrgs.splice(i--, 1)
                    }
                };
                stack[index].push({
                    'width': (rightOfWrap - from),
                    'left': from,
                    'column': returnPart
                });
                return rightOfWrap
            },
            checkCanCleaveVertical: function (from, nearest, arrgs) {
                this.canCleave[nearest.id] = true;
                for (var i = 0; i < arrgs.length; i++) {
                    if (nearest.id !== arrgs[i].id && (arrgs[i].left >= from && arrgs[i].left < nearest.right && 
                    	arrgs[i].right > nearest.right)) {
                        this.canCleave[nearest.id] = false;
                        nearest = arrgs[i];
                        this.canCleave[nearest.id] = false
                    }
                };
                return nearest
            }
        }
    },
    fn: {
        select: function (sel, sid, idReturn) {
            switch (sid) {
                case 'selectSidebar':
                    $(sel).parent().find('li').removeClass('active');
					$(sel).addClass('active');
                    break;
                case 'checSideExist':
                    var ops = ID('positions-list-wrp').querySelector('select').options;
                    var j = 0;
                    for (var i = 0; i < ops.length; i++) {
                        if (ops[i].value == sel.value) {
                            ops[i].selected = true;
                            j = 1
                        }
                    };
                    if (j == 0) ops[0].selected = true;
                    break;
                case 'build':
                    var select = '<select onchange="grid.fn.select(this,\'selectSidebar\')" style="width:235px;">';
                    if (sel) select += '<option selected value="' + sel + '">' + sel + '</option>';
                    else select += '<option value=""> --- Select Sidebar ---</option>';
                    var pcur = ID('list-inactive-position').querySelectorAll('.widgets-sortables');
                    for (var i = 0; i < pcur.length; i++) {
                        if (pcur[i].id != 'wp_inactive_widgets') {
                            select += '<option ';
                            if (pcur[i].id == sel) select += ' selected ';
                            select += 'value="' + pcur[i].id + '">' + pcur[i].id + '</option>'
                        }
                    }
                    select += '</select>';
                    return select;
                    break;
                case 'list':
                    var al = ID('list-inactive-position').querySelectorAll('.widgets-sortables');
                    var ul = ID('left-ul-list-inactive-position'),
                        sid;
                    ul.innerHTML = '';
                    if (al.length > 0) {
                        for (var i = -1; i < al.length; i++) {
                            li = document.createElement('li');
                            li.className = 'sidebarinlist';
                            sid = al[i] ? al[i].id : null;
                            if (i == -1) {
                                li.id = 'inList-' + sel;
                                li.innerHTML = '<span class="ui-icon ui-icon-flag"></span>' + sel + '<remove id="remove-' + sel + 
                                '" class="ui-icon ui-icon-close tag-remove" title="Delete this sidebar"></remove>';
                                li.className = 'active sidebarinlist'
                            } else {
                                li.innerHTML = '<span class="ui-icon ui-icon-extlink"></span>' + sid + '<remove id="remove-' + sid + 
                                '" class="ui-icon ui-icon-close tag-remove" title="Delete this sidebar"></remove>';
                                li.id = 'inList-' + sid
                            };
                            li.title = 'Click to active this sidebar for selected block';
                            try {
                                if (sid != 'wp_inactive_widgets') ul.appendChild(li)
                            } catch (e) {}
                        }
                    } else {
                        var h3 = document.createElement('li');
                        h3.innerHTML = 'No Widget available';
                        ul.appendChild(h3)
                    }
                    break;
                case 'listCat':
                
                    sel.options[sel.selectedIndex].disabled = 'disabled';
                    
                    $(sel.parentNode).append('<div catid="' + sel.value + 
                    '" class="alignleft catitem"><span>' + 
                    sel.options[sel.selectedIndex].innerHTML + 
                    ' </span><span onclick="this.sid=' + 
                    sel.selectedIndex + ';grid.fn.select(this,\'removeCat\')" class="ui-icon ui-icon-close"></span></div>');
                    
                    if(idReturn){
                    
	                    var ops = sel.options.length;
	                    var ids = [];
	                    for( var i=0; i<ops; i++ ){
		                    if( sel.options[i].disabled == true )
		                    	ids[ids.length] = sel.options[i].value;
	                    }
	  
	                    ID(idReturn).value = ids.join(',');
                    
                    }
                    
                    break;
                case 'listCatCur':
                
               		 if(idReturn){
               		 
               		 	idReturn = idReturn.split(',');
			   		 	for( var i=0; i < idReturn.length; i++ )
			   		 	{
			   		 		for( var j=0; j<sel.options.length; j++){
				   		 		if(sel.options[j].value==idReturn[i])
				   		 		{
					   		 		sel.options[j].disabled = 'disabled';
		                    
				                    $(sel.parentNode).append('<div catid="' + sel.value + 
				                    '" class="alignleft catitem"><span>' + 
				                    sel.options[j].innerHTML + 
				                    ' </span><span onclick="this.sid=' + 
				                    j + ';grid.fn.select(this,\'removeCat\')" class="ui-icon ui-icon-close"></span></div>');
				                    
				   		 		}	
			   		 		}

		                 }   
                    }
                    
                break;
                    
                case 'removeCat':
                    var select = $(sel).closest('.contentAdvanced').find('select').get(0);
                    if(select.options[sel.sid])select.options[sel.sid].disabled = '';
                    $(sel.parentNode).remove();
                    break               
				case 'listSidebar':
                    var select = '<select onchange="grid.fn.select(this,\'selectSidebar\')" style="width:235px;">';
					var ul = '<ul class="availabe-sidebar">';
					
					/* sel is selected */
					
					
                    var pcur = ID('list-inactive-position').querySelectorAll('.widgets-sortables');
                    for (var i = 0; i < pcur.length; i++) {
                        if (pcur[i].id != 'wp_inactive_widgets') {
                            ul += '<li ';
                            if (pcur[i].id == sel) ul += ' class="activepl" ';
							ul += '>';
                            ul +=  ' &nbsp; <input type="radio" value="'+pcur[i].id+'"';
                             if (pcur[i].id == sel) ul += ' checked ';
                            ul +=  ' name="sidebar-list" /><span>'+pcur[i].id+'</span><i class="icon icon-remove alignright"></i></li>'
                        }
                    }
                    ul += '</ul>';
                    
                    $('#positions-list-wrp').html(ul);
					$('#positions-list-wrp li').off("click").click(function(){
						if( $(this).find('input') ){
							$(this).find('input').get(0).checked = true;
							$('#positions-list-wrp li.activepl').removeClass('activepl');
							$(this).addClass('activepl');
						}	
					});
                    
                    $('#positions-list-wrp li .icon').off("click").click(function(){
						if( confirm('Are you sure you want to delete this sidebar?') ){
							var sdi = $(this.parentNode).find('input').val();
							$('#sidebar-'+sdi).remove();
							$(this.parentNode).remove();
							re_init(jQuery);
							wpWidgets.saveOrder();
						}
						return false;
					});
                    
                    return ul;
                    break
            }
        },
        
        sidebar: {
			
                save	:	function( arguments ){
					
					var obj = ID('position-settings').currentBlock;
					
					/**
						Save for group
					*/
					if( ID('siderbars-list').style.display == 'none' ){
						grid.fn.groups.insert( $('#groups-list .activepl input').val() );
						return;
					}
					/**
						Save for custom code
					*/
					if( ID('sidebar-code-editor').style.display != 'none' ){
						
						var edi = ID('sidebar-code-editor').editor;
						var texa = $( obj ).find( 'textarea.customize' ).get(0);
						var sid = jQuery.parseJSON( $('#layout_editting').attr('data').replace('}\\','}').replace(/'/g,'"') ).id;
						
						sid = sid.replace('groups[DS]','_grp_');
						
						if( texa ){
							texa.value = Base64.encode( edi.getValue() );
							if( texa.id.indexOf( 'devn_customize_'+sid ) == -1 ){
								texa.id = 'devn_customize_'+sid+'_'+Math.floor( new Date().getTime() / 1000 );
							}
							var label = ID('sidebar-code-label').value;
							if( label != '' ){
								$( obj ).find( '.selectSidebarBtn').html( label );
							}
						}else{

							sid = 'devn_customize_'+sid+'_'+Math.floor( new Date().getTime() / 1000 );
							
							var label = ID('sidebar-code-label').value;
							if( label == '' ){
								label = 'Code Customization';
							}
							
							var html =	'<div class="sidebar-wrpest btn-group">'+
										'<div class="widgets-holder-wrap sidebar-inner"  cfg="{&quot;className&quot;:&quot;&quot;}" >'+
										'<a href="#sidebar|edit|'+(obj.id.replace('sidebar-',''))+'" class="btn btn-default add-code-btn">'+
										'<i class="fa fa-pencil"></i> <span class="selectSidebarBtn">'+label+'</span>'+
										'</a><textarea id="'+sid+'" class="customize" style="display:none;">'+
										Base64.encode( edi.getValue() )+'</textarea></div></div>';
							$( obj ).find( '.block-center' ).html( html );
						}
						
						grid.fn.sidebar.update();
						/*
							Save custom code before save layout to avoid 500 error
						*/
						
						var idCusto = $( obj ).find( '.block-center .customize' ).get(0);
						if( !idCusto ){
							return;
						}
						$('#position-settings-body .saveSidebar').html('Saving...').addClass('loading-eff').css({'width':'130px'});
						jQuery.post(ajaxurl, {
							'action': 'saveCustomize',
							'id': idCusto.id,
							'value': idCusto.value
						}, function (result) {
							$('#position-settings-body .saveSidebar').
								html('<i class="fa fa-check"></i>Choose').
								removeClass('loading-eff').
								css({'width':''});
								
							grid.fn.layout.save();
							
						});
						
						return;
					}
					/**
						Save for sidebar
					*/
                    var selected = $('#siderbars-list .activepl input');
                    var sideWrp = $( obj ).find('.block-body').get(0);
                    
                    if( !selected.get(0) ){
	                    alert('Error! You must select a sidebar');
	                    return;
                    }
                    
                    $('#position-settings').hide();
                         
					if($(sideWrp.querySelector('.sidebar-inner')).attr('cfg')=='')
						$(sideWrp.querySelector('.sidebar-inner')).attr('cfg','{"className":"'+sideWrp.
						querySelector('.sidebar-inner').id.replace('sidebar-','')+'"}');
				
					grid.fn.sidebar.update();
					
					var sidebar = ID(selected.val(), 1);
                    if( !sidebar )
                    	return;
                    /*Move sidebar back to inactive list*/
                    $('#list-inactive-position').append( $( obj ).find('.sidebar-inner').get(0) );
                    /*Move sidebar selected from inactive list to current area editing*/
                    sideWrp.innerHTML = '';
                    sideWrp.appendChild( sidebar );
                    
					$(sideWrp).closest('.block-wrpest').css({'z-index':''});
				}
					
				,
                
                remove	:	function( arguments ){
                
                    var sidebar = arguments.elm.find('.sidebar-inner');
                    if (sidebar.get(0)) ID('list-inactive-position').appendChild(sidebar.get(0));
                    arguments.elm.remove();
				
				}   
				
                ,
                
                vAlign	:	function( arguments ){
                
                    $('#grid-wrapest .widgets-sortables').each(function () {
                        var hw = this.parentNode.offsetHeight - $(this).height();
                        this.style.padding = (hw / 2) + 'px 0'
                    });
                    
                }
                
                ,
                
                html	:	function( arguments ){
                
                    var html = '<div cfg=\'{"className":"' + arguments.className + 
                    			'","fullWidth":"0"}\' id="sidebar-' + arguments.name.replace(/ /g, '-') + 
                    			'" class="widgets-holder-wrap sidebar-inner">' + 
                    			'<h2 class="sidebar-label">' + arguments.name + '</h2>' + 
                    			'<div id="' + arguments.name.replace(/ /g, '-') + '" class="widgets-sortables ui-sortable"></div>' + 
                    			'</div>';
                    return html;
                    
                }
                
                ,
                
                update	:	function(){
                
                    var sidebar = $(ID('position-settings').currentBlock).find('.sidebar-inner').get(0);
                    if (!sidebar) return;
                    grid.fn.cfg.update(sidebar, {
                        className: ID('classCfg').value,
                        fullWidth: ID('rowWidthCfg').value,
                        status: ID('statusCfg').value,
                        customCss: Base64.encode(ID('customCssCfg').value)
                    });
                    
                    if( ID('statusCfg').value == 'unpublish' ){
	                    $(ID('position-settings').currentBlock).removeClass('publish').addClass('unpublish');
                    }else{
	                    $(ID('position-settings').currentBlock).removeClass('unpublish').addClass('publish');
                    }
                    
               }
               
				,
				
				edit	:	function( arguments ){
                
                    $('#position-settings,#position-settings-body').fadeIn();
					grid.fn.select(null, 'listSidebar');
					
					ID('position-settings').currentBlock = $('#sidebar-'+arguments.id).get(0);
					ID('classCfg').value = '';
					ID('rowWidthCfg').options[0].selected = true;
					
					if( $('#sidebar-'+arguments.id+' .sidebar-type-group').get(0) ){
						
						$('#siderbars-list').hide();
						$('#groups-list').show();
						var gid = $('#sidebar-'+arguments.id+' .sidebar-type-group').attr('id').replace('[DS]','_');
						$('#'+gid).click();
						
					}else{
					
						var sidebarCur = $('#sidebar-'+arguments.id+' .sidebar-inner');

						if(sidebarCur.find('.sidebar-label').get(0)){
							$('#positions-list-wrp ul').prepend('<li class="activepl"> &nbsp; '+
								'<input type="radio" checked value="" name="sidebar-list"><span>'+
								sidebarCur.find('.sidebar-label').html()+
								'</span><i class="icon icon-remove alignright"></i></li>');
						};
						
						var cfgattr = sidebarCur.attr('cfg');
						
	                    if(cfgattr)var cfg = JSON.parse(cfgattr);
						else{
							cfg = {'className':sidebarCur.get(0)?sidebarCur.attr('id').replace('sidebar-',''):''};
							sidebarCur.attr('cfg','{"className":"'+cfg.className+'"}');	
						};	
						
	                    ID('classCfg').value = cfg.className;
	                    
	                    if ( $('#sidebar-'+arguments.id).get(0).offsetLeft > 20 ) {
	                    
	                        $('#rowWidthCfg').parent().hide();
	                        if (cfg.fullWidth != 0) {
	                            cfg.fullWidth = 0;
	                            sidebarCur.attr('cfg', JSON.stringify(cfg, replacer))
	                        }
	                        
	                    } else {
	                    
	                        $('#rowWidthCfg').parent().show();
	                        try {
	                            ID('rowWidthCfg').options[cfg.fullWidth].selected = true;
	                        } catch (e) {}
	                        
	                    }
	                    
	                    try {
	                    
	                    	if( cfg.status == 'unpublish' ){
		                    	ID('statusCfg').options[1].selected = true;
	                    	}else{
		                    	 ID('statusCfg').options[0].selected = true;
	                    	}
	                       
	                    } catch (e) {}
	                    
	                    
	                    if(cfg.customCss){
		                    ID('customCssCfg').value = Base64.decode(cfg.customCss);
	                    }else{
		                 	ID('customCssCfg').value = '';   
	                    }

						$('#siderbars-list,#list-of-sidebars').show();
						$('#groups-list,#sidebar-code-editor').hide();

					}	
                    
                    if( $('#sidebar-'+arguments.id+' textarea.customize').get(0) ){
                    	arguments.ignorEdit = true;
						grid.fn.sidebar.custom( arguments );
					}
					
				}  
				  
				,
				  
				custom	:	function( arguments ){
                    	
                    	if( arguments.ignorEdit != true ){
                    		grid.fn.sidebar.edit({'id': arguments.id });
                    	}
                    	
                    	$('#list-of-sidebars').hide();
						$('#sidebar-code-editor').show();
						if( $('#sidebar-'+arguments.id+' .selectSidebarBtn').length == 1 ){
                    		ID('sidebar-code-label').value = $('#sidebar-'+arguments.id+' .selectSidebarBtn').html().trim();
                    	}else{
	                    	ID('sidebar-code-label').value = '';
                    	}
                    	if( !$('#sidebar-code-editor .CodeMirror').get(0) ){
							
							CodeMirror.modeURL = "codemirror/mode/%N/%N.js";
							ID('sidebar-code-editor').editor = CodeMirror.fromTextArea( ID('sidebar-code-temple') , {
								lineNumbers: true,
								autofocus: true,
								autoCloseTags: true,
								mode: 'application/x-httpd-php',
								indentUnit: 4,
								indentWithTabs: true,
								theme: 'eclipse',
								electricChars: true,
								lineWrapping: true
							});
						}
					
					var edi = ID('sidebar-code-editor').editor;
					var val = $('#sidebar-'+arguments.id+' textarea.customize').get(0);
					
					if( val ){
						val = Base64.decode( val.value );
					}else{
						val = "\n";
					}	
					edi.setValue( val );
					autoFormatCodeMirrors( edi );

                    	
                 }
              
            
        },
        
        cfg: {
            update: function (elm, obj) {
                var cfg = JSON.parse($(elm).attr('cfg'));
                for (n in obj) eval('cfg.' + n + ' = obj.' + n);
                $(elm).attr('cfg', JSON.stringify(cfg))
            },
            content: function (form, source) {

                var blog = $('.contentOptions .blog').hasClass('btn-success');
                this.update(source, {
                    'showBlog': blog?1:0
                })
            },
            advanced: function ( elm ) {
            
	            $( elm ).parent().find('.btn-success').removeClass('btn-success');
	            $( elm ).addClass('btn-success');
	            if( $(elm).hasClass('blog') ){
		            $('.blogLinkSett').show();
	            }else{
		            $('.blogLinkSett').hide();
	            }
                
            }
        },
        dragStart: function () {
            $T('#grid-wrapest').setOffsetPage();
            $('#grid-wrapest').on({
                'mousedown': function (event) {
                    if (event.target.id != 'grid-wrapest') return;
                    grid.scan(event, this);
                    this.dragtable = true;
                    try {
                        event.originalEvent.preventDefault()
                    } catch (e) {}
                }
            })
        },
		/**
		*	ON HOLD
		*	truoc day la dinh nghia nhom cac sidebar, bay gio chuyen thanh nhom fn.group{}
		*/
		blocks : {
		
			edit : function( id, arg ){
			/*
				if(ID(id).className.indexOf('btn_red') > -1)
					return;*/
				
				if( grid.changed )
					if( !confirm("ARE YOU SURE?\n\nThe layout has been changed, press OK  if you still want to continues without saving.") )return false;
				
				grid.changed = false;
				
				ID('container').innerHTML = '<center style="margin-top:200px"><span class="loading-eff">loading</span></center>';
				/**
				* show loading and remove current edit
				*/
				while( ID('layout_editting') ){			
					$('#layout_editting').attr({'id':null});
				}
				
				var name = id;
				if( !arg ){
					var alias = '<span style=color:maroon>Group </span>';
					var task = 'block'
				}else{
					var alias = arg[0];
					var task = arg[1];
				}
				jQuery.post(ajaxurl, {
					'action': 'loadLayout',
					'name': name,
					'alias': alias,
					'task': task,
					'title': id,
				}, function (result) {
					$('#grid-wrapest').resizable('destroy');
					ID('container').innerHTML = result;
					$('#grid-wrapest').resizable({
						grid: [100, 0],
						handles: 's',
						minHeight: 700,
					});
					re_init(jQuery);
					grid.fn.dragStart();
					/* Re add icons and sub title for new widgets */
					/*addIcon2widgets();*/
				});
				
			},
			create : function(){
			

				
			},
			heightest : function(){
			
				var hmax = 50;
				var hmin = 'start';

				$('#grid-wrapest .block-wrpest').each(function(){
					if( this.offsetTop+this.offsetHeight > hmax )
						hmax = this.offsetTop+this.offsetHeight;
					if(hmin=='start')
						hmin = this.offsetTop;
					if( hmin > this.offsetTop )	
						hmin = this.offsetTop;
				});
				var hre = hmax - hmin;
				if( !hre )
					 return 50;
				if( hre < 50 )
					return 50
				return hre;
			},			
			bottomtest : function(){
			
				var hmax = 50;

				$('#grid-wrapest .block-wrpest').each(function(){
					if( this.offsetTop+this.offsetHeight > hmax )
						hmax = this.offsetTop+this.offsetHeight;
				});
				return hmax;
			},
			remove : function(){

			}
			
		},
		/**
		*	block wrapper (gross sidebars)
		*/
		groups : {
			init: function(){
				$('#groups-list li').off("click").click(function(){
					if( $(this).find('input') ){
						$(this).find('input').get(0).checked = true;
						$('#groups-list li.activepl').removeClass('activepl');
						$(this).addClass('activepl');
					}	
				});	
				$('#groups-list li .icon').off("click").click(function(){
					
					if( confirm('Are you sure you want to delete this group?') ){
						var grp = $(this.parentNode).find('input').val();
						grid.fn.groups.delete(grp);
					}
					return false;	
				});	
				
			},
			create : function(){
				var find = '';
				var msg = "Please enter group's name";
				while(find != null)
				{
					var newGroup = prompt(msg,"");
					newGroup = newGroup.replace(/[^a-zA-Z0-9 ]/g,'').toLowerCase();
					var find = document.getElementById('groups[DS]'+newGroup.replace(' ','-'));

					msg = 'This block already exists, please choose a different name';
					
					if(newGroup==false)
						return false;
					
				};		
			
				$('#availabel-groups').append('<li><span></span>'+newGroup+'<a href="#layout|edit|groups[DS]'+newGroup.replace(' ','-')+'" title="Edit '+newGroup+'" class="edit groups-'+newGroup.replace(' ','-')+'" data="{\'id\':\'groups[DS]'+newGroup.replace(' ','-')+'\',\'title\':\''+newGroup+'\'}"></a></li>');
				
				$('#groups-list ul').append('<li id="groups_'+newGroup.replace(' ','-')+'">&nbsp; <input type="radio" value="'+newGroup.replace(' ','-')+'" name="groups-list" /><span>'+newGroup+'</span><i class="icon icon-remove alignright"></i></li>');
				
				jQuery.post(ajaxurl, {
					'action': 'saveLayout',
					"vitual": '',
					"real": '',
					"blockHeight" : 50,
					"height": 500,
					"title": newGroup,
					"name": 'groups[DS]'+newGroup.replace(' ','-')
				}, function (result) {
					/*grid.fn.blocks.edit( 'groups[DS]'+newBlock.replace(' ','-') );*/
				});
				
				grid.fn.groups.init();
				
				$('#position-settings').hide();
				window.location = window.location.href.split('#')[0]+'#layout|edit|groups[DS]'+newGroup.replace(' ','-');
				
			},
			insert : function(gid){
				if( !gid ){
					alert('Error! You must select a group');
					return;
				}
				var obj = ID('position-settings').currentBlock;
				var binner = '<div id="groups[DS]'+gid+'" title="Click to edit group '+gid.replace(/-/g,' ')+'" class="sidebar-type-group sidebar-wrpest btn btn-primary"><a href="#layout|edit|groups[DS]'+gid+'"><i class="fa fa-pencil "></i> Edit Group '+gid.replace(/-/g,' ')+'</a></div>';	
				$(obj).find('.block-body').html( binner );
				$('#position-settings').hide();
				grid.changed = true;
			},
			delete : function(gid){

				$('#availabel-groups a').each(function(){
					if($(this).hasClass('groups-'+gid))
						$(this).parent().remove();
				});
				
				$('#groups_'+gid).remove();

				jQuery.post(ajaxurl, {
					'action': 'loadLayout',
					'name': 'general',
					'alias': 'groups[DS]'+gid,
					'task': 'clearLayout',
					'title': 'delete layout',
				}, function (result) {
					 grid.changed = true;
				});
			
			}
		},
		layout : {
		
			save : function(){
			
				grid.changed = false;
			
	            if (doc.querySelector('#grid-wrapest .overlap')) {
	                alert('We detect some blocks are overlapping, You need to separate them before saving.');
	                return
	            };
				var cleave = grid.split.cleave();
	            $('#saveLLoading').show();
	            $('#saveLayout').hide();
	            var data = JSON.parse($('#layout_editting').attr('data').replace('}\\','}').replace(/'/g,'"'));
	            var name = data.id;
	            var private = ID('privateLayout');
				if( private ){
					if( private.checked ){
						private = 'yes';
					}else{
						private = 'no';
					}
				}else{
					private = 'no';
				}
				var title = ID('layout_editting').parentNode.innerHTML.replace(/(<([^>]+)>)/ig,"").replace(/(\(([^\)]+)\))/ig,"").trim();
	            jQuery.post(ajaxurl, {
	                'action': 'saveLayout',
	                "vitual": cleave.vitual,
					"real": cleave.real,
					"blockHeight" : grid.fn.blocks.heightest(),
					"height": cleave.height,
					"private": private,
					"title": title,
					"customHeader": ID('customHeader')?ID('customHeader').value:'',
					"customFooter": ID('customFooter')?ID('customFooter').value:'',
					"groupid": ID('groupID')?ID('groupID').value:'',
					"groupclass": ID('groupClass')?ID('groupClass').value:'',
	                "name": name
	            }, function (result) {
	                $('#saveLLoading').hide();
	                $('#saveLayout').show();
	                if( ID('control-visual-li').style.display != 'none' )
	                {
		                ID('design-iframe_ifr').src = ID('design-iframe_ifr').src;
	                }
	            });
	            
	            wpWidgets.saveOrder();
	            
	            return;
	            
			}
		},
		/**
		*	get layout for edit page or group (clear, copy)
		*/
		load : function( id, arg ){
			/*
			if(ID(id).className.indexOf('btn_red') > -1)
				return;*/
			
			if( grid.changed != false )
				if( !confirm("ARE YOU SURE?\n\nThe layout has been changed, press OK  if you still want to continues without saving.") )return false;
				
			$('#control-pages-li').removeClass('active');	
			
			grid.changed = false;
			
			ID('container').innerHTML = '<center style="margin-top:200px"><span class="loading-eff">loading...</span></center>';
			/**
			* show loading and remove current edit
			*/				
			
			while( ID('layout_editting') ){
				$('#layout_editting').attr({'id':null});
			}
			
			var name = id;
			if( !arg ){
				var alias = '<span style=color:maroon>Group </span>';
				var task = 'group'
			}else{
				var alias = arg[0];
				var task = arg[1];
			}
			jQuery.post(ajaxurl, {
				'action': 'loadLayout',
				'name': name,
				'alias': alias,
				'task': task,
				'title': id,
			}, function (result) {
				
				if( result.indexOf('reload:') === 0 ){
					
					result = result.split(':');
					
					alert('You have choosed "'+result[2]+'" as Front Page.'+"\n\nTo change what to show in front page: \nWP-Admin -> Settings -> Reading");

					window.location = $('#listPages .edit.'+result[1]).eq(0).attr('href');
					return;
					
				}
				
				$('#grid-wrapest').resizable('destroy');
				$('#container').css({opacity:0});
				ID('container').innerHTML = result;
				$('#container').animate({opacity: 1});
				$('#grid-wrapest').resizable({
					grid: [100, 0],
					handles: 's',
					minHeight: 700
				});
				re_init(jQuery);
				grid.fn.dragStart();

				if( !ID('link-live-view') ){
				
					$('#control-grid-li > a.mnhrefli').click();
				
				}else if( arg[2] == 'visual' ){
					if( ID('control-visual-li').style.display == 'inline-block' ){
						$('#control-visual-li a').click();
					}
				}
				/* Re add icons and sub title for new widgets */
				/*addIcon2widgets();*/
			});
		},
		
		/**
		*	Show or hide widgets list
		*/
		
		widgets : function( fn ){
			
			sizeRefresh();
			
			var iframe = $('#design-iframe_ifr').get(0).contentWindow;
			var ist = iframe.document.getElementById('live-design-widgets');
			var istst = ist ? ist.style.display : null;
			if( ID('widgets-right').style.display != 'none' ){
				istst = $('#control-widgets-li .control-body').get(0).style.display;
			}
			if( fn == 'show' )
			{
				if( istst == 'block' )
				{
					fn = 'hide';
				}else{
					
					$('#widgets-right').css({'margin-left':'250px'});
					$(iframe.document.getElementById('live-design-widgets')).css({display:'block'});
					$(iframe.document.getElementsByTagName('body')[0]).css({marginLeft: '240px'});
					if( $('#control-grid-li').hasClass('active') ){
						$('#control-widgets-li .control-body').css({display:'block'});
					}else $('#control-widgets-li .control-body').css({display:'none'});
					$('#control-widgets-li').addClass('active');
					$('#control-pages-li').removeClass('active');
				}
			}
			if( fn == 'hide' ){
				$('#control-widgets-li .control-body').css({display:'none'});
				$('#widgets-right').css({marginLeft: '0'});
				$('#control-widgets-li').removeClass('active');
				$(iframe.document.getElementById('live-design-widgets')).css({display:'none'});
				$(iframe.document.getElementsByTagName('body')[0]).css({marginLeft: '0'});
			}
	
		},
		/**
		*	@devn: Open settings of widget via id
		*/
		openWGsettings: function( id ){
			
			var ij = getIJ();
			if( id.indexOf('execphp-') > -1 ){
				ij('#'+id+' .execphpwidget').dblclick();
				return;
			}
			if( id.indexOf('contents-') > -1 &&  ij('.widget-content-component article').length == 1 ){
				ij('#'+id+' .entry-content').dblclick();
				return;
			}
			
			$('#widgets-right .widget input.widget-id').each(function (){
				if( this.value == id )
				{
					$(this).closest('.widget').find('.widget-title-action a').eq(0).click();
				}
			});
		},
		openWGdelete: function( id ){
			//if( !confirm('Are you sure you want to delete this widget?') )
			//	return;
			var iframe = $('#design-iframe_ifr').contents();
			iframe.find('#'+id).removeClass('bounceIn').removeClass('animated').addClass('bounceOut animated')
			.delay(1000).queue(function() { 
				
				this.parentNode.removeChild(this); 
				 $(this).dequeue();
			});
			
			
			$('.widget .widget-id').each(function(){
				if( this.value == id ){
					var wgg = $(this).closest('.widget');
					wpWidgets.save( wgg , 1, 0, 0 );
				}
			});
		}
    }
};


jQuery(doc).ready(function ($) {

    grid.fn.dragStart();

    $('#listPages').accordion({
        collapsible: true,
        heightStyle: "content",
		header: 'h3:not(.ignore)'
    });
	
	$('#listPages .edit,#listPages .add').click(function (event) {
        event.stopImmediatePropagation();
	});
	
	/**
	*	event click to edit block
	*/
    $('#grid-wrapest').resizable({
        grid: [100, 0],
        handles: 's',
        minHeight: 700
    });
    
    grid.fn.groups.init();
	
	$('#createGroup').click(grid.fn.groups.create);
    
    $(doc).on('mouseup', function (event) {
        var is = function (sl) {
            var slk = sl.replace('#', '').replace('.', '');
            if (sl.indexOf('#') > -1) return (event.target.id == slk);
            else if (sl.indexOf('.') > -1) return ($(event.target).hasClass(slk))
        };
     
		if (is('#addNewLayout')) {		
			
			var find = '';
			var msg = "Please enter layout's name";
			while(find != null)
			{
				var newLayout = prompt(msg,"");
				newLayout = newLayout.replace(/[^a-zA-Z0-9 ]/g,'').toLowerCase();
				find = document.querySelector('#availabel-layouts li edit.'+newLayout.replace(' ','-'));

				msg = 'This layout already exists, please choose a different name';
				
				if(newLayout==false)
					return false;
				
			};	
			
			$('#availabel-layouts').append('<li><span></span>'+newLayout+'<edit title="Edit this page" class="'+newLayout.replace(' ','-')+'"></edit></li>');
			/**
			*	Activate tab layout created
			*/
			var index = $('#listPages > h3').length;
			$('#listPages').accordion("activate", index-1);
			
			$('edit.'+newLayout.replace(' ','-')).click();
			
            return false;
        };
		if( is('.block-item') ){
			grid.fn.blocks.insert(event.target);
			return false;
		};	
		if( event.target.id == 'delete-group-layout' || event.target.parentNode.id == 'delete-group-layout' ){
			grid.fn.groups.remove();
			return false;
		};
        if (event.target.id == 'saveLayout' || event.target.parentNode.id == 'saveLayout') {
            
			grid.fn.layout.save();
			
        };
        if (is('.tag-remove') && event.target.nodeName == 'REMOVE') {
            
            if (!confirm("BE CAREFUL!!!\n\nAre you sure you want to delete this sidebar? \nAll widgets and settings in this sidebar will be lost.")){
	            return;
            }
            
            vid = event.target.id.replace('remove-', '');
            event.target.parentNode.parentNode.removeChild(event.target.parentNode);
            if (ID(vid, 1)) ID(vid, 2).removeChild(ID(vid, 1));
            
            wpWidgets.saveOrder();
            
        };
		
		var wrp = $('#grid-wrapest').get(0);
		if( !wrp ){
			return;
		}
        if (!wrp.dragtable ){
	        return;
        }
        
        $('#grid-wrapest').get(0).dragtable = false;
        if ($("#mask-dragin").width() < 60 || $("#mask-dragin").height() < 50) {
        
            $("#mask-dragin").css({
                width: '0px',
                height: '0px',
                top: '0px',
                left: '0px'
            });
            return;
        }
        
        var div = doc.createElement('div');
        div.className = 'block-wrpest';
		if( ID('mask-dragin').offsetWidth == 940 )
			div.className += ' max-width'; 
		var sid = $('#sidebar-id').val();
		
		if( sid ){
			div.id = 'sidebar-'+sid;
			$('#sidebar-id').val( eval(sid)+1 );
		};
		
        div.setAttribute('style', $("#mask-dragin").attr('style'));
        var binner = '<span title="Width x Height of this block" class="height-of-block">' + 
        	(ID('mask-dragin').offsetWidth + ' x ' + 
        	ID('mask-dragin').offsetHeight) + '</span>' +
        	
        	'<ul class="ui-widget functions-btn">'+ 
        	'<li class="ui-state"><a title="Edit" href="#sidebar|edit|'+sid+'"><i class="fa fa-wrench"></i></a></li>' + 
        	'<li class="ui-state"><a title="Remove" href="#sidebar|remove|'+sid+'"><i class="fa fa-times"></i></a></li>' + 
        	'</ul><div class="block-body"><div class="block-center"><div class="sidebar-wrpest btn-group">'+
        	'<a href="#sidebar|add|'+sid+'" class="btn btn-default add-sidebar-btn"><i class="fa fa-plus"></i> '+
        	'<span class="selectSidebarBtn">Sidebar</span></a>'+
        	'<a href="#group|add|'+sid+
        	'" class="btn btn-default add-group-btn"><i class="fa fa-plus"></i> <span class="selectSidebarBtn">Group</span></a>'+
        	'<a href="#sidebar|code|'+sid+'" class="btn btn-default add-code-btn"><i class="fa fa-pencil"></i> '+
        	'<span class="selectSidebarBtn">Code</span></a>'+
        	'</div></div></div>';
        	
        div.innerHTML = binner;
        $("#mask-dragin").css({
            width: '0px',
            height: '0px',
            top: '0px',
            left: '0px'
        });
        $('#grid-wrapest').append(div);
        $('#grid-wrapest').sortable();
        $(div).draggable({
            grid: [80, 10],
            start: function () {
                this.style.zIndex = grid.index++;
				grid.changed = true;
            },
            containment: "parent",
            stop: grid.scanOverlap,
            cancel: '.editBlock'
        }).resizable({
            grid: [80, 10],
            handles: 'n, e, s, w',
            stop: grid.scanOverlap,
            containment: "parent",
            minHeight: 30,
            minWidth: 60
        }).on('resize', function () {
            this.querySelector('.height-of-block').innerHTML = this.offsetWidth + ' x ' + this.offsetHeight;
			grid.changed = true;
			if( this.offsetWidth == 940 ){
				$(this).addClass('max-width');
			}else{
				$(this).removeClass('max-width');
			}
        });
		
		grid.changed = true;
		
    });
	
	$(document).mousedown(function(e){
		var elm = e.target, foundWidgets = false, foundPages = false;
		if( !elm || elm == null )
			return;
		while( elm.nodeName != 'BODY' && elm.parentNode != null ){
			if( elm.id == 'control-widgets-li' )
				foundWidgets = true;		
			if( elm.id == 'control-pages-li' )
				foundPages = true;
				
			elm = elm.parentNode;	
		}

		if( foundWidgets == false )
		{
			//$('#control-widgets-li').removeClass('active');
			//grid.fn.widgets('hide');	
		}	
		
		if( foundPages == false )
		{
			$('#control-pages-li').removeClass('active');
		}
		
		
	});
	
	$('.closeSideList').click(function(){
         $('#position-settings').hide();
         window.location = window.location.href.split('#')[0]+'#close';
	});
	$('.saveSidebar').click(function(){
		if( ID('position-settings').currentBlock == undefined && ID('groups-list').style.display != 'none' ){
			if( !$('#groups-list .activepl').get(0) )
			{	alert('You must choose a group first'); return; }
			var group = $('#groups-list .activepl input').val();
			window.location = '#layout|edit|groups[DS]'+group;
			$('#position-settings').hide();
			return;
		}
		grid.fn.sidebar.save();
		 window.location = window.location.href.split('#')[0]+'#save';
    });
    $('.sidebarinlist').click(function(){
        grid.fn.sidebar.change( {
            elm: event.target
        });
    });
        
	/*Control menu click event*/
	
	$('#control-pages-li > a.mnhrefli').click(function(){
		if( !$('#control-pages-li').hasClass('active') )
			$('#control-pages-li').addClass('active');
		else $('#control-pages-li').removeClass('active');	
		grid.fn.widgets('hide');
	});
	
	$('#control-widgets-li > a.mnhrefli').click(function(){
		$('#control-pages-li').removeClass('active');			
		grid.fn.widgets('show');
		sizeRefresh();
	});	
	
	$('#control-grid-li > a.mnhrefli').click(function(){
		$('#controls .control-li').removeClass('active');
		$('#control-grid-li').addClass('active');
		$('#live-design-frame,#instant-editor-controls').hide();
		$('#widgets-right').show();
		grid.fn.widgets('hide');
	});	
	
	$('#control-visual-li > a.mnhrefli').click(function(){
		$('#controls .control-li').removeClass('active');
		$('#control-visual-li').addClass('active');
		$('#live-design-frame').show();
		$('#widgets-right').hide();
		grid.fn.widgets('hide');
		if( grid.changed == true ){
			var ifr = ID('design-iframe_ifr');
			ifr.src = ifr.src;
			$('#iframe-visual-loading').css({display: 'block'});
			grid.changed = 'loaded';
		}
	});	
	
	/* Live ricktext editor */
	$('#instant-editor-controls .btn-boo').click(function(){
		var title = $(this).attr('rel');
		if( typeof title == 'undefined' || title == '' )
			return;
		var value = '';
		if(this.typeof == 'SELECT'){
			var value = formatDoc(title,this.value);
		}
		if(title.indexOf(':')>-1){
			value = title.split(':')[1];
			title = title.split(':')[0];
		}
		formatDoc(title,value);
	});
	/* Refresh frame */
	$('#iframeRefresh').click(function(){
		ID('iframe-visual-loading').style.display = 'block';
		ID('design-iframe_ifr').src = ID('design-iframe_ifr').src;
	});
	
	$('#edit-code-visual-btn').click(function(){
	
		$('#edit-code-visualmode').show();
		if( !$('#edit-code-visualmode .CodeMirror').get(0) ){
			CodeMirror.modeURL = "codemirror/mode/%N/%N.js";
			ID('edit-code-visualmode').editor = CodeMirror.fromTextArea( $('#edit-code-visualmode textarea').get(0) , {
				lineNumbers: true,
				autofocus: true,
				autoCloseTags: true,
				mode: 'application/x-httpd-php',
				indentUnit: 4,
				indentWithTabs: true,
				theme: 'eclipse',
				electricChars: true,
				lineWrapping: true
			});
		}
		
		var elm = getIJ('.eblink .elmSelected');

		if( elm.get(0) ){
			var convertHtml =  elm.clone().removeClass('elmSelected');
			if( convertHtml.attr('class') == '' )
				convertHtml.removeAttr('class');
				
			convertHtml = convertHtml.wrap('<p>').parent().html();
			var editor = ID('edit-code-visualmode').editor;
			editor.setValue( convertHtml );
			autoFormatCodeMirrors( editor );

		}	
		
		if(iframeContenteditable){	
			//ID('edit-code-visualmode').editor.setValue( iframeContenteditable.innerHTML );
		}	
	});	
	
	
	$('#edit-code-visualmode a.save').click(function(){
		
		$('#edit-code-visualmode').hide();
		var newTxt = ID('edit-code-visualmode').editor.getValue();
		var elm = getIJ('.eblink .elmSelected');
		if( !elm.get(0) )
			return;
			
		if( newTxt != '' ){
			var newelm = getIJ( newTxt ).addClass('elmSelected');
			elm.after( newelm ).remove();
		}else{
			elm.remove();
		}

	});
	
	
	$('#edit-code-visualmode a.cancel').click(function(){
		$('#edit-code-visualmode').hide();
	});
	
	/*Insert media into visual mode*/
	var custom_uploader_bg;
    $('#selectImagebs2').click(function(e) {
 
        e.preventDefault();
		
		ID('dropdown-boxstyle').style.display = 'block';
		
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader_bg) {
            custom_uploader_bg.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader_bg = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Set Background'
            },
            multiple: false,
			editing:   true,
			allowLocalEdits: true,
            displaySettings: true,
            displayUserSettings: true,
            
        });
 
        custom_uploader_bg.on('select', function() {
        	
            attachments = custom_uploader_bg.state().get('selection');
			var txt = '';
			attachments.each(function(attachment) {
				attachment = attachment.toJSON();
				txt = ID('bgcol-bs2').value+" url("+attachment.url+") no-repeat left top";
				ID('bgfull-bs2').value = txt;
				$('#bgfull-bs2').change();
			});


        });
 
        //Open the uploader dialog
        custom_uploader_bg.open();
 
    });

	/*Insert media into visual mode*/
	var custom_uploader;
    $('#upload_image_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: true,
			editing:   true,
			allowLocalEdits: true,
            displaySettings: true,
            displayUserSettings: true,
            
        });
 
        custom_uploader.on('select', function() {
        
            attachments = custom_uploader.state().get('selection');
			var txt = '';
            attachments.map( function( attachment ) {
		     	 attachment = attachment.toJSON();
		         txt += '<img src="'+attachment.url+'" />';
		         formatDoc( 'insertImage', attachment.url );
		    });
		    
		   // alert(txt);

        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
    
    /*Responsive drag options*/
	var $val = $('#widthValInp'),
		min = $val.attr('min'),
		max = $val.attr('max'),
		step = $val.attr('step');

	$val.simpleSlider({
		snap: true,
		step: step,
		range: [min, max]
	});
	$val.attr('type', 'text').show();
	$val.on('keyup blur', function (e) {
		$val.simpleSlider('setValue', $val.val());
	});
	$val.on('change', function (e) {
		var wBody = document.getElementsByTagName('body')[0].offsetWidth;
		var newW = parseInt($val.val());
		var marG = (wBody-newW-62)/2;
		$('#design-iframe_ifr').stop().animate({ width : newW, marginLeft : (marG>0)?marG:0 },300);
		$('#responsive-options .active').removeClass('active');
	});
	
	setUpSplSl(0,100,1);
	
	/* publish change and exit real builder mode */
	
	$('#save-realBuilderMode').click(function(){

		var ij = getIJ();
		var elmBlur = ij( '.curentLiveEdittingMode .eblink' );
		var sid = elmBlur.parent().attr('id');
		
		elmBlur.find('.devnConColbody').removeAttr('contenteditable');
		elmBlur.find('.elmSelected').removeClass('elmSelected');
		
		elmBlur.find('.compElm-livCon iframe').each(function(){
			var shortcode = ij(this).parent().attr('code');
			if( !shortcode )
				return;
			ij(this).parent().removeAttr('code');	
			ij(this).parent().addClass('compElm-iframe');	
			shortcode = Base64.decode( shortcode );
			this.parentNode.innerHTML = shortcode;
		});
		
		elmBlur.find('.compElm-livCon').removeAttr('code');
		
		var content = elmBlur.html().replace(/&lt\;\?/g,'<?').replace(/\?&gt\;/g,'?>').replace(/&gt\;/g,'>').replace(/&lt\;/g,'<');

		if( elmBlur.hasClass('devn-code-customize') ){
			
			var re1 = new RegExp(theme, 'g');
			var re2 = new RegExp(site_uri, 'g');
			
			var re3 = new RegExp(theme.replace( /\&/g,'&amp;' ), 'g');
			var re4 = new RegExp(site_uri.replace( /\&/g,'&amp;' ), 'g');
			
			content = content.replace( re1 , '<?php echo THEME_URI; ?>' ).replace( re2 , '<?php echo SITE_URI; ?>' ).replace( re3 , '<?php echo THEME_URI; ?>' ).replace( re4 , '<?php echo SITE_URI; ?>' );
			content = Base64.encode( content );
			
			ID( elmBlur.attr('id') ).value = content;
			
			jQuery.post(ajaxurl, {
				'action': 'saveCustomize',
				'id': elmBlur.attr('id'),
				'value': content
			}, function (result) {
				 $('#iframeRefresh').click();
			});
			
		}else if( elmBlur.hasClass('execphpwidget') ){
			$('#widgets-right .widget .widget-id').each(function(){
				if(this.value ==sid){
					$(this).parent().find('textarea.phpxcode').val( content );
					wpWidgets.save( $(this).closest('.widget') , 0, 0, 1 );	
				}
			});
		}else if( elmBlur.hasClass('entry-content') ){	
		
			var ctraw = ID('page-content-raw');
			var evl = content;
	
			if( ctraw ){
			
				if( ctraw.value != evl )
				{
					ctraw.value = evl;
					top.saveChangePageContent();
				}	
			}
		}
		
		$('#cancel-realBuilderMode').click();
		
	});
	
	/* cancel real builder mode */
	
	$('#cancel-realBuilderMode').click(function(){
		
		scroll2cur();
		
		var ij = getIJ();
		var elmBlur = ij( '.curentLiveEdittingMode .eblink' );

		elmBlur.get(0).onmouseup = null;
		moveFromRaw2Live( elmBlur.get(0) );
		
		ij('body').removeClass('builderModeEnable');
		
		elmBlur.removeClass('eblink').attr({'contenteditable':false});
		ij('.curentLiveEdittingMode').removeClass('curentLiveEdittingMode');
		ij('.elmSelected').removeClass('elmSelected');
		ij('h1.entry-title a').attr({'contenteditable':false});
		ij( ".widgetdevn" ).sortable('enable');
		$('#instant-editor-controls').hide();
		$('#controls').css({display:''});
		
		$('#live-design-frame').animate({'margin-left':62});
		
		if( $('#design-iframe_ifr').css('margin-left') == '0px' ){
			$('#responsive-options .respon').last().click();
		}
		
		ID('responsive-options').style.top = '1px';
				
	});
	
	$('#restore-realBuilderMode').click(function(){
		var ij = getIJ();
		var elmBlur = ij( '.curentLiveEdittingMode .eblink' );
		moveFromRaw2Live( elmBlur.get(0) );
	});
	
	/*Update value from list-box2prop-view*/
	$('#list-box2prop-view input,#list-box2prop-view select').on('change',function(){
		
		var ij = getIJ();
		var sElm = ij('.curentLiveEdittingMode .elmSelected');
		
		if( this.id == 'css3effects-bs2' ){
			var clasz = sElm.attr('class').split(' ');
			var effs = ID('css3effects-bs2');
			for( var i = 0; i < clasz.length; i++ ){
				for( var j = 0; j < effs.options.length; j++ ){
					if( clasz[i] == effs.options[j].value ){
						sElm.removeClass( clasz[i] );
					}
				}	
			}
			
			sElm.removeClass( 'animated' );
			
			if( this.value != ''  ){
				sElm.addClass( 'animated '+this.value );
			}
			
			return;
		}
		
		var prop = $(this).attr('rel');
		var after = $(this).attr('after');
		var before = $(this).attr('before');
		
		var value = this.value;
		if( before )
			value = ID(before).value +' '+ this.value;		
		if( after )
			value = this.value +' '+ ID(after).value;
		
		eval( "sElm.css({'"+prop+"':'"+value+"'})" );

	});
	
	/*Add rows into live content*/
	
	$('#addRowsIntoLiveContent').click(function(){
		
		var inFrame = ID('design-iframe_ifr').contentWindow;
		var ij = getIJ();
		var node = ij('.curentLiveEdittingMode .eblink .elmSelected').get(0);
		
		if( !node ){
			node = inFrame.document.getSelection().anchorNode;
			if( node )node = (node.nodeType == 3 ? node.parentNode : node);
		}else{
			ij('.elmSelected').removeClass('elmSelected');
		}
		var nodeTeLe = ij( node ).text().length;
		
		if( node ){
			/* Step 1: find if in any another row node*/
			var finder = node;
			while( !ij( finder ).hasClass('eblink') && !ij( finder ).hasClass('devn-LvCRow') && finder.parentNode ){
				finder = finder.parentNode;
			}
		}else{
			finder = ij('.curentLiveEdittingMode .eblink').get(0);
		}	
		
		var setCols = parseInt( $('#numberOfCols2AddLive').val() );
		var colHtml = '<div class="devnContentCol col-md-'+setCols+
					'"><div class="devnConColbody elmSelected" contenteditable="true">Hello! I am new column</div></div>';
		var rowColsHtml = '<div class="devn-LvCRow" contenteditable="false">'+colHtml+'</div>';		
		
		if( ij( finder ).hasClass('devn-LvCRow') || !node ){
			/*The cursor is in one row OR there are no node was found -> insert col into that row*/
			var cols = 0;
			ij( finder ).find('.devnContentCol').each(function(){
				var classz = this.className.split(' ');
				for( var i=0; i<classz.length; i++ ){
					if( classz[i].indexOf('col-md') > -1 ){
						cols += parseInt( classz[i].replace('col-md-','') );
					}
				}
			});
			
			if( cols + setCols <= 12 ){
			
				if( setCols > 12-cols )
					setCols = 12-cols;
				
				ij( finder ).append( '<div class="devnContentCol col-md-'+setCols+
					'"><div class="devnConColbody elmSelected" contenteditable="true">Hello! I am new column</div></div>' );
			
			}else{
				
				ij(finder).after( rowColsHtml );
				
			}
			
		}else if( ij(node).hasClass('eblink') ){
		
			colHtml = rowColsHtml+'<p><br /></p>';
			ij( node ).append( colHtml );
			/*formatDoc( 'insertHTML', colHtml );*/
			
		}else if( ij(finder).hasClass('eblink') ){
		
			/*There are no any row, insert new row with col into cursor position*/
			
			if( nodeTeLe > 0 || node.tagName == 'IMG' || ij(node).find('img').get(0) ){
			
				var chk = node.nextSibling?node.nextSibling.tagName:false;
				if( !chk )
					rowColsHtml += '<p><br /></p>';	
				ij( node ).after( rowColsHtml );
			
			}else ij( node ).before( rowColsHtml );
			
		}
		ij('.devn-LvCRow').attr({ 'contenteditable' : false });
		ij('.devn-LvCRow .devnConColbody').attr({ 'contenteditable' : true });
		scroll2cur();
		/*formatDoc( 'insertHTML', '<div class="row">I am div</div>' );*/
		
	});
	
	$('#removeElmSelected').click(function(){
		getIJ('.curentLiveEdittingMode .elmSelected').remove();
		$('#elmSelectedFuncs').hide();
	});	
	
	$('#doubleElmSelected').click(function(){
		var elm = getIJ('.curentLiveEdittingMode .elmSelected');
		if( !elm.get(0) ){
			$('#elmSelectedFuncs').hide();
			return;
		}
		elm.after( elm.clone() );
		getIJ('.curentLiveEdittingMode .elmSelected').removeClass('elmSelected').last().addClass('elmSelected');
	});
	
	$('#addSpacingInsEdi').click(function(){
		getIJ('.curentLiveEdittingMode .eblink').append('<div class="clearfix"></div><p><br /></p>');
		scroll2cur();
	});	
	
	$('#addSpacingInsEdiNext').click(function(){
		getIJ('.curentLiveEdittingMode .eblink .elmSelected').after('<br />');
		scroll2cur();
	});
	
	/* Keep popup alive when open selection */
	$('.keepParentonFocus').on('focus',function(){
		//clearTimeout(document.keepAliveTimer);
		$(this).closest('.dropdown-menu').css({display:'block'});
	});
	
	
	$('#boxRowSett button.btn').click(function(){
	
		var rel = $(this).attr('rel');
		if( rel == null || rel == '' )
			return;
		var ij = getIJ();	
		var node = ij('.elmSelected').get(0);
		if( !node )
			node = getNode(false);
		
		if( !node )
			return false;
		
		var finder = node;
		
		while( !ij( finder ).hasClass('eblink') && !ij( finder ).hasClass('devnContentCol') && finder.parentNode ){
			finder = finder.parentNode;
		}	
		if( !ij( finder ).hasClass('devnContentCol') )
			return;

		var col = parseInt( finder.className.substring( finder.className.indexOf('col-md-')+7, finder.length).split(' ')[0] );
		
		scroll2cur();
		
		switch( rel ){
			case 'delete':

				/*if( !confirm('Are you sure?') )
					return;*/
				if( finder.parentNode.children.length == 1  ){
					ij( finder.parentNode ).remove();
					return;
				}
				ij( finder ).remove();
				$('#elmSelectedFuncs').hide();
			break;
			case 'double':
				ij( finder ).after( ij( finder ).clone() );
				ij( '.elmSelected' ).removeClass('elmSelected').last().addClass('elmSelected');
			break;			
			case 'reduced':
				if( col > 1 ){
					ij( finder ).removeClass( 'col-md-'+col ).addClass( 'col-md-'+(col-1) );
				}	
			break;
			case 'increased':
				if( col < 12 ){
					ij( finder ).removeClass( 'col-md-'+col ).addClass( 'col-md-'+(col+1) );
				}
			break;
		}
		
	});
	
	/*Insert component into live content*/
	ID('add-component-live-content').callBack = function( shortcode, current ){

		var shcEditable = [
			'heading',
			'label',
			'button',
			'quote',
			'service',
			'pullquote',
			'box',
			'dropcap',
			'note',
			'divider',
			'row',
			'column',
			'spacer',
			'table',
			'highlight',
			'list',
			'permalink'];
				
	
		var ij = getIJ();
		var shcId = Math.floor( new Date().getTime() / 1000 );
		var previewIFr = $('#su-generator-preview iframe').get(0);
		var shc = '<div class="compElm-livCon" code="'+Base64.encode(shortcode)+'" id="compElm-livCon-'+shcId+'"></div>';
		var elm = ij('.elmSelected');
		var checkIns = '';
		
		try{
			checkIns = elm.text().length;
		}catch(e){}	

		if( current != null ){
			
			ij( current ).attr({
				'class' : 'compElm-livCon',
				'id'	: 'compElm-livCon-'+shcId,
				'code'	: Base64.encode(shortcode),
				'contenteditable'	: 'false'
			}).html('');	
			
		}else if( checkIns == 0 && elm .get(0) ){
			 elm.prepend( shc );
		}else{
			formatDoc( 'insertHTML', shc );
		}
		
		previewIFr.scrolling = 'no';	
		
		var shcName = $('#su-generator-breadcrumbs span').html().toLowerCase();

		if( shcEditable.indexOf(shcName) == -1 ){
		
			/*Add shortcode as iframe preview*/
			var elmShc = ij( '#compElm-livCon-'+shcId );
			
			var checkParent = elmShc.closest('.compElm-livCon.compElm-iframe');
			if( checkParent.get(0) )
				checkParent.after( elmShc );
			
			elmShc.addClass( 'compElm-iframe' );
			
			ij( previewIFr ).removeAttr( 'onload' );
			previewIFr.onload = function(){	onloadShortcodePreview(this); };
			
			ij( '#compElm-livCon-'+shcId ).append(previewIFr).append('<div contenteditable="false" class="shc-func-btns btn-group"><button class="btn btn-default" title="Edit this element" onclick="top.shcPrevFunc(this,\'edit\')"><i class="fa fa-pencil"></i></button><button  title="Remove this element" onclick="top.shcPrevFunc(this,\'remove\')" class="btn btn-default"><i class="fa fa-times"></i></button></div>').addClass('animated bounceIn');
		
		}else{
		
			/*Add shortcode content into live content*/
			ij(previewIFr).contents().find('link').each(function(){
				
				var found = false;
				var theLink = this.href;
				ij('head link').each(function(){
					if( this.href == theLink )
						found = true;
				});
				
				if( !found ){
					ij('head').append( this );
				}
				
			});
			ij( '#compElm-livCon-'+shcId ).append(ij(previewIFr).contents().find('body > div').get(0)).addClass('animated bounceIn');
			
		}	
		
		ij( '#compElm-livCon-'+shcId ).delay(2000).queue(function() {
                           $(this).removeClass("animated").removeClass("bounceIn");
                           $(this).dequeue();
                       });
		
		scroll2cur();
		
	}
	
	ID('editShorcodePrev').callBack = function( shortcode ){
	
		var node = getNode(),ij = getIJ();
		if( ij(node).hasClass('compElm-livCon') ){
			ID('add-component-live-content').callBack( shortcode, node );
		}
	}
	
	
	/*Show screen size*/
	$('#showScreenSizePanel').click(function(){
		if( ID('responsive-options').style.top != '36px' )
			ID('responsive-options').style.top = '36px';
		else ID('responsive-options').style.top = '1px';
	});
	
	
	/*Responsive options*/
	$('#responsive-options .respon').click(function(){
		var val = $(this).attr('rel');
		if( val == 1500 )
			val = document.getElementsByTagName('body')[0].offsetWidth-62;
		$('#widthValInp').get(0).value = val;
		$('#widthValInp').blur();
		$('#responsive-options .active').removeClass('active');
		$(this).addClass('active');
		
		setTimeout(function(){
			var ij = getIJ();
			ij('.ls-wp-container,.flexslider').resize();
			
		}, 1500)
		
	});
	
	ID('select_page_for_edit_layout').onchange = function(){
		window.location = window.location.href.split('#')[0]+'#layout|edit|page-'+this.options[this.selectedIndex].value;
	}
		
});

function getNode( useJquery ){

	var inFrame = ID('design-iframe_ifr').contentWindow;
	var ij = getIJ();
	var elm = ij('.curentLiveEdittingMode .eblink .elmSelected');
	if( !elm.get(0) ){
		elm = ij('.curentLiveEdittingMode .eblink').get(0);
		elm = elm.children[0];
	}

	if( useJquery == true )
		return ij( elm );
	return elm;
	
}

function getIJ( selector ){
	var inFrame = ID('design-iframe_ifr').contentWindow;
	if(!selector)return inFrame.jQuery;
	else return inFrame.jQuery( selector );
}

function ID(id, parent) {
    if (!parent) return document.getElementById(id);
    if (parent > 0) {
        var elm = document.getElementById(id);
        if(!elm)
        	return null;
        while (parent-- > 0) elm = elm.parentNode;
        return elm
    }
};

function Q(selector, parent) {
    if (!parent) return document.querySelector(selector);
    else return parent.querySelector(selector)
};

function QA(selector, parent) {
    if (!parent) return document.querySelectorAll(selector);
    else return parent.querySelectorAll(selector)
};

function replacer(key, value) {
    if (typeof value === 'number' && !isFinite(value)) {
        return String(value)
    }
    return value
};
var currentHeight = 0;
var minHeight = 600;

function sizeRefresh() {

    if (currentHeight == document.body.offsetHeight) 
    	return;
    currentHeight = document.body.offsetHeight;
    frm = $('#design-iframe_ifr');
	frm.css({ height : (currentHeight-35)+'px' });
	
	if( frm.css('margin-left') == '0px' )
		frm.css({ width: ($('#wpwrap').width()-66)+'px' });
	
	frm.contents().find('#available-widgets').height(frm.height());
	
};

//setInterval('heightable()', 5000);


window.onload = function () {
    re_init(jQuery);
    sizeRefresh();
    processHash(window.location.hash);
};

/* Start hash tag listener */
if ("onhashchange" in window) {
	 window.onhashchange = function (event) {
		  processHash(window.location.hash);
		  event.preventDefault();
	 }
}
else { 
	var prevHash = window.location.hash;
	window.setInterval(function () {
	   if (window.location.hash != prevHash) {
		  processHash(window.location.hash);
	   }
	}, 100);
}


function processHash( hash ){
	
	/*window.location = '#devn';*/
	
	/*#object|task|id*/
	
	hash = hash.replace(/#/g,'').split('|');
	var obj = hash[0];
	var task = hash[1];
	var id = hash[2];
	var ext = hash[3];
	
	switch( obj ){
	
		case 'sidebar':
			/**
			*	Sidebars for selected area
			*/
			switch( task ){
				case 'add':

					grid.fn.sidebar.edit({'id': id});
					
				break;
				case 'remove':
				
					grid.fn.sidebar.remove({
						elm: $('#sidebar-'+id)
					});
				

				break;
				case 'create':
				
					var sidebar = prompt('Enter new sidebar name','' );
					if( sidebar != null && sidebar != '' ){
						sidebar = sidebar.replace(/[^a-zA-Z0-9 -_]/g,'').replace(/ /g,'-').toLowerCase();
						
						if( sidebar.length > 28 )
						{
							alert("Error! The maximum characters of name is 28");
							return false;
						}
						
						$('#positions-list-wrp .availabe-sidebar input').each(function(){
							if( this.value == sidebar ){
								this.checked = true;
								$('#positions-list-wrp .activepl').removeClass('activepl');
								$(this).parent().addClass('activepl');
								sidebar = null;
								return false;
							}
						});
						
						if(sidebar==null)
							return false;
						
						/* add new sidebar into list */
						$('#list-inactive-position').append('<div id="sidebar-'+sidebar+'" class="widgets-holder-wrap sidebar-inner" cfg=""><h2 class="sidebar-label">'+sidebar.replace(/-/g,' ')+'</h2><div id="'+sidebar+'" class="widgets-sortables ui-sortable"></div></div>');
						/*Re-Initdrag widgets*/
						re_init( jQuery );
						
						
						/* reload sidebars list */
						grid.fn.select(sidebar, 'listSidebar');
						$('#positions-list-wrp ul').prepend($('#positions-list-wrp').find('.activepl'));
						
						
					}
					if(sidebar == ''){
						alert("Error! Invalid sidebar's name");
					}
				
				break;
				case 'edit':
					
					grid.fn.sidebar.edit({'id': id});
				
				break;
				case 'code':
					
					grid.fn.sidebar.custom({'id': id});
				
				break;
			}
			
		break;
		
		case 'layout' : 
		
			switch( task ){
				case 'add':
				
					var lid = prompt('Input layout\'s name', '');
					lid = lid.replace(/[^[0-9a-zA-Z _-]]*/g,'');
					if( lid == '' || lid == null ){
						return;
					}
					var lidz = lid.replace(/ /g,'-');
					if( $('#listPages .edit.'+lidz).get(0) ){
						alert("Error!\nLayout's name already exists");
						return;
					}
					
					$('#availabel-layouts').append('<li><span></span>'+lid+'<a href="#layout|edit|'+lidz+'" title="Edit '+lid+'" class="edit '+lidz+'" data="{\'id\':\''+lidz+'\',\'title\':\''+lid+'\'}"></a></li>');
				
				break;
				case 'remove':

				break;
				case 'edit':
					
					var current = $('#listPages a.edit.'+id.replace('[DS]','-'));
					var data = current.attr('data').replace('}\\','}');
					eval('var data = '+data);
					
					if( current.get(0) && data ){
						var alias = data.title;
					}else{
						alias = '';
					}
					var task = ''
					grid.fn.load(id, [alias,task,ext]);
					if( current.get(0) ){
						while( ID('layout_editting') ){
							$('#layout_editting').attr({'id':null});
						}	
						current.attr({id:'layout_editting'});
					};	
					
					if( id.indexOf('page-') > -1 ){
						$('#select_page_for_edit_layout').val( id.substr(id.indexOf('page-')+5, id.length)  );
					}else{
						ID('select_page_for_edit_layout').options[0].selected = true;
					}
						
				break;
				case 'using':
						
					if( id == 'empty' ){
						if (!confirm("ARE YOU SURE?")) return;
						
						$('#grid-wrapest .block-wrpest .sidebar-inner').each(function(){
							$('#list-inactive-position').append(this);
						});
						$('#grid-wrapest .block-wrpest').remove();
						grid.changed = true;
						return;
					}
					if( id == 'delete' ){
						
						if (!confirm("ARE YOU SURE YOU WANT TO DELETE?")) return;
						
						var lid = $('#do-delete-layout').attr('rel');
						if( !lid || lid == 'general' ){
							return;
						}	
							
						grid.fn.load('general', [lid,'clearLayout']);
						
						grid.changed = false;
						return;
					}
					
					if( id == 'general' ){
						if (!confirm("ARE YOU SURE?\n\nThis layout will be deleted")) return;
					}
					
					var cur = $('#layout_editting');
					var data = JSON.parse( cur.attr('data').replace('}\\','}').replace(/'/g,'"') );
					
					grid.fn.load(id,[cur.parent().text(),'loadFor-'+data.id]);
				
					cur.attr({id: 'layout_editting'});
					
				break;
				
			}
			
		break;
		
		case 'group':
			/**
			*	Sidebars for selected area
			*/
			switch( task ){
				case 'add':
				
					$('#position-settings,#position-settings-body').fadeIn();
					if( id != undefined )
						ID('position-settings').currentBlock = ID('sidebar-'+id);
					else ID('position-settings').currentBlock = undefined;
					$('#siderbars-list').hide();
					$('#groups-list').show();
					
				break;
			}	
		break;	
		
		case 'grids':
			/**
			*	Sidebars for selected area
			*/
			switch( task ){
				case 'custom':
					
					if( id == 'close' ){
						$('#customHeadFootBtn .popup-overlay').hide();
						return;
					}
					
					$('#customHeadFootBtn .popup-overlay').show();
					
					if( !$('#customHeadFootBtn .CodeMirror').get(0) ){
					
						$('#customHeadFootBtn .popup-body').css({height: '500px','maxHeight':'500px'});
						
						CodeMirror.modeURL = "codemirror/mode/%N/%N.js";
						ID('customHeadFootBtn').editor = CodeMirror.fromTextArea( ID('customHeader') , {
							lineNumbers: true,
							autofocus: true,
							autoCloseTags: true,
							mode: 'application/x-httpd-php',
							indentUnit: 4,
							indentWithTabs: true,
							theme: 'eclipse',
							electricChars: true,
							lineWrapping: true
						});
					}
					
					var edi = ID('customHeadFootBtn').editor;
					if( id == 'header' ){
						edi.setValue( Base64.decode( ID('customHeader').value ) );
						ID('customHeadFootBtn').obj = 'customHeader';
						$('#customHeadFootBtn .poptit').html('Custom Header (php,css,meta,html,javascript)');
						autoFormatCodeMirrors( edi );
	
					}else if( id == 'footer' ){
						edi.setValue( Base64.decode( ID('customFooter').value ) );
						ID('customHeadFootBtn').obj = 'customFooter';
						$('#customHeadFootBtn .poptit').html('Custom Footer (php,css,html,javascript)');
						autoFormatCodeMirrors( edi );
	
					}else if( id == 'save' ){
						if( ID('customHeadFootBtn').obj != null ){
							ID(ID('customHeadFootBtn').obj).value = Base64.encode( edi.getValue() );
							ID('customHeadFootBtn').obj = null;
							grid.fn.layout.save();
							$('#customHeadFootBtn .popup-overlay').hide();
						}
					}
					

				break;
			}	
		break;	
		
	}
	
	
}


/*
$(window).bind("beforeunload", function(){
        return confirm("Do you really want to refresh?"); 
});*/