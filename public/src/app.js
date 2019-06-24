var postId = 0;
var postBodyElement = '';

$('.post').find('.interaction').find('.edit').on('click', function(event) {
    event.preventDefault();

    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    let postBody = postBodyElement.textContent;
    postId = event.target.parentNode.parentNode.dataset['postid'];
    $('#edit-body').val(postBody);
    $('#edit-modal').modal();
});

$('#modal-save').on('click', function() {
   $.ajax({
     method: 'POST',
     url: urlEdit,
     data: {body: $('#edit-body').val(), postId: postId, _token: token}
   }).done(function(msg) {
       $(postBodyElement).text(msg['new_body']);
       $('#edit-modal').modal('hide');
   });
});

$('.delete').on('click', function(e){
    e.preventDefault();
    postBodyElement = e.target.parentNode.parentNode;
    postId = e.target.parentNode.parentNode.dataset['postid'];
    $('#delete-modal').modal();
});

$('#modal-delete').on('click', function(){
   $.ajax({
       method: 'GET',
       url: 'deletepost/' + postId,
       // data: {postId: '12'}
   }).done(function(msg){
       $('#delete-modal').modal('hide');
       $(postBodyElement).hide();
       // $('.deltoast').find('.toast-body').find('.notifp').text(msg['message']);
       // console.log(msg['message']);
       // $('.deltoast').toast('show');
       $.ajax({
           method: 'POST',
           url: urlNotif,
           data: {message: msg['message'], _token: token}
       }).done(function(mssg){
           location.reload();
       })
   });
});

$('.like').on('click', function(event){
    event.preventDefault();
    var isLike = event.target.previousElementSibling == null;
    postId = event.target.parentNode.parentNode.dataset['postid'];
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: {isLike: isLike, postId: postId, _token: token}
    }).done(function(){
    });
});