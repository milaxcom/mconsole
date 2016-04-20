var FormMultiUpload=function(e){this.element=e,this.init()};FormMultiUpload.prototype.init=function(){var e=this.element,t=e.find('input[type="file"]').prop("multiple");this.element.find("button.description").on("click",function(){e.find("div.description").map(function(e,t){$(t).hasClass("hide")?$(t).removeClass("hide"):$(t).addClass("hide")})}),this.element.find("tbody.files").sortable({axis:"y",handle:".drag"});var i={disableImageResize:!0,autoUpload:!0,maxNumberOfFiles:50,disableImageResize:/Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),maxFileSize:3e7,singleFileUploads:!1,url:"/mconsole/api/uploads/upload",uploadTemplateId:"template-upload-"+this.element.find("input.uploadable-group").val(),downloadTemplateId:"template-download-"+this.element.find("input.uploadable-group").val()};t||(i.maxNumberOfFiles=1),this.element.fileupload(i),this.element.bind("fileuploaddestroy",function(e,t){e.preventDefault();var i=$(t.context.context).parents("tr"),l=i.find("button.delete");i.find("input.uploadable-filename").val();l.hasClass("disabled")||(l.html('<i class="fa fa-spin fa-spinner"></i>'),l.addClass("disabled"),$.ajax({type:t.type,url:t.url}).success(function(){i.fadeOut("normal",function(){this.remove()})}))}),t||this.element.find('input[type="file"]').on("change",function(){var t=this.value;e.find("tbody.ui-sortable tr").map(function(e,i){$(i).find("p.name").text()!=t&&$(i).remove()})}),this.element.find("input.uploadable-id").val().length>0&&this.loadFiles()},FormMultiUpload.prototype.loadFiles=function(){this.element.addClass("fileupload-processing"),$.ajax({url:"/mconsole/api/uploads/get/",data:{type:this.element.find("input.uploadable-type").val(),related_class:this.element.find("input.uploadable-class").val(),related_id:this.element.find("input.uploadable-id").val(),group:this.element.find("input.uploadable-group").val()},dataType:"json",context:this.element[0]}).always(function(){$(this).removeClass("fileupload-processing")}).done(function(e){$(this).fileupload("option","done").call(this,$.Event("done"),{result:e}),$(this).find("tbody.files tr").map(function(e,t){var i=$(t).find("input.uploadable-language-id").val();$(t).find("select").val(i)})}).error(function(){this.loadFiles()}.bind(this))},$(function(){var e=$(".uploadable");e.length>0&&e.map(function(t){new FormMultiUpload(e.eq(t))})});