var initMenu=function(){var e="li:not(.toggle-blade-helper)",t=function(e,n){var l=[];return e.children(n).map(function(e,a){var o={key:$(a).data("key")};$(a).children("ul").length>0&&(o.children=t($(a).children("ul"),n)),l.push(o)}),l},n=$("#main-menu");n.sortable({containment:"parent",items:e,stop:function(l){var a=t(n,e);$.ajax({url:n.data("ajax"),headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")},type:"POST",data:{menus:JSON.stringify(a)}})}})};$(function(){$(".delete-confirm").on("click",function(){var e=new Confirm("mconsole-table-delete",trans("delete-modal-title"),trans("delete-modal-body"),trans("delete-modal-ok"),trans("delete-modal-cancel"),"btn-danger");return e.show(function(){$(this).closest("form").submit()}.bind(this)),!1}),$(".color-picker").length>0&&$(".color-picker").map(function(e,t){$(t).minicolors({defaultValue:"#0088cc",theme:"bootstrap"})}),$(".multi-select:not(.grouped)").length>0&&$(".multi-select").map(function(e,t){$(t).multiSelect()}),$(".multi-select.grouped").length>0&&$(".multi-select.grouped").map(function(e,t){$(t).multiSelect({selectableOptgroup:!0})}),initMenu()});