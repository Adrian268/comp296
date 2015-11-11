
$edit_list_form.submit('click', function(e){
    e.preventDefault();
    saveList();
});

$delete_btn.on('click', function(){
    deleteList();
});

function saveList(){

    var list_id = $list_id.val();
    var list_name = $list_name.val();
    var list_option = 'list_option';
    var $list = $('.'+list_id+'');

    var post = $.post("controllers/ListController.php", {

        list_id: list_id,
        list_name: list_name,
        list_option: 'save'
    });

    post.done(function(data){
        $list.text(data);
        closeModal($modal)
    }

    );

}

function deleteList(){
    var list_id = $list_id.val();
    var list_option = 'list_option';
    var $list = $('.'+list_id+'');

    var post = $.post("controllers/ListController.php", {

        list_id: list_id,
        list_option: 'delete'
    });

    post.done(
        $list.closest('.list-wrapper').remove(),
        $list.remove()
    );
}

