$(function(){$(".delete-confirm").on("click",function(){var e=new Confirm("mconsole-table-delete",trans("delete-modal-title"),trans("delete-modal-body"),trans("delete-modal-ok"),trans("delete-modal-cancel"),"btn-danger");return e.show(function(){$(this).closest("form").submit()}.bind(this)),!1})});