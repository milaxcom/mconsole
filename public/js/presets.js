var Presets=function(){if(this.json=$('input[name="operations"]'),this.add=$(".preset-add-operation"),this.list=$(".operations-list"),this["switch"]=$('select[name="type"]'),this.switchType(),this.json.val().length>5){var t=JSON.parse(this.json.val());for(var e in t)this.appendPresetOperation(t[e])}this["switch"].on("change",this.switchType.bind(this)),this.add.on("click",function(){this.appendPresetOperation()}.bind(this)),this.switchType(),this.list.on("keyup change click","input, select",this.evalJSON.bind(this))};Presets.prototype.switchType=function(){var t=this["switch"].val(),e=$(".dependent");e.addClass("hide"),"image"==t?e.filter('[data-only="image"]').removeClass("hide"):e.filter('[data-only="any"]').removeClass("hide")},Presets.prototype.evalJSON=function(){var t=[];this.list.find("form").map(function(e,i){var s={},n=$(i).serializeArray();for(var e in n)s[n[e].name]=n[e].value;t.push(s)}),this.json.val(JSON.stringify(t))},Presets.prototype.appendPresetOperation=function(t){var e=new PresetOperation(this.evalJSON.bind(this),t);this.list.append(e.selector)};var PresetOperation=function(t,e){this.updateCallback=t,this.templates=$(".preset-operation-template"),this.selector=this.makeElement(e),this.selector.find('select[name="operation"]').on("change",this.switchOperationType.bind(this))};PresetOperation.prototype.makeElement=function(t){var e=$(this.templates.find('div[data-type="types"]')).clone();return t&&(e.find('select[name="operation"]').val(t.operation),this.switchOperationType(e.find('select[name="operation"]'),t)),e.on("click",".remove-operation",function(){this.selector.remove(),this.updateCallback&&this.updateCallback()}.bind(this)),e},PresetOperation.prototype.switchOperationType=function(t,e){var i=t.target?$(t.target):$(t),s=i.parent().next();s.html("");var n=$(this.templates.find('div[data-type="'+i.val()+'"]')).clone();if(e)for(var a in e)n.find('[name="'+a+'"]').val(e[a]);n.length>0&&(n.find(".popovers").popover(),s.html(n))},$(function(){new Presets});