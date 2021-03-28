let host = window.location.protocol + "//" + window.location.host;

//record like and dislike

$('.like').click(function(){
    let id = $(this).attr('value');

    let n =  parseInt($(this).find('span').text()) ;
   
    $.post(host + "/blog/LikeDislike", {
        id: id,
        type: "like"
        
    }, function(data){
        response = JSON.parse(data);

        if(response.status == 'success'){
            $("#like-" + response.id).find('span').text(++n);
            $("#like-" + response.id).attr('disabled', true);
            $("#dis_like-" + response.id).attr('disabled', true);
        } else {
            alert ("ERROR");
        }
    });
});

$('.dis_like').click(function(){
    let id = $(this).attr('value');

    let n =  parseInt($(this).find('span').text()) ;
   
    $.post(host + "/blog/LikeDislike", {
        id: id,
        type: "dis_like"
        
    }, function(data){
        response = JSON.parse(data);

        if(response.status == 'success'){
            $("#dis_like-" + response.id).find('span').text(++n);
            $("#dis_like-" + response.id).attr('disabled', true);
            $("#like-" + response.id).attr('disabled', true);
        } else {
            alert ("ERROR");
        }
    });
});

// comment like and dis like
$('.comment_like').click(function(){
    let id = $(this).attr('value');

    let n =  parseInt($(this).find('span').text()) ;
   
    $.post(host + "/comment/LikeDislike", {
        id: id,
        type: "like"
        
    }, function(data){
        response = JSON.parse(data);

        if(response.status == 'success'){
            $("#comment_like-" + response.id).find('span').text(++n);
            $("#comment_like-" + response.id).attr('disabled', true);
            $("#comment_dis_like-" + response.id).attr('disabled', true);
        } else {
            alert ("ERROR");
        }
    });
});

$('.comment_dis_like').click(function(){
    let id = $(this).attr('value');

    let n =  parseInt($(this).find('span').text()) ;
   
    $.post(host + "/comment/LikeDislike", {
        id: id,
        type: "dis_like"
        
    }, function(data){
        response = JSON.parse(data);

        if(response.status == 'success'){
            $("#comment_dis_like-" + response.id).find('span').text(++n);
            $("#comment_dis_like-" + response.id).attr('disabled', true);
            $("#comment_like-" + response.id).attr('disabled', true);
        } else {
            alert ("ERROR");
        }
    });
});