<script>
$(function(){
    'use strict'
    $(document).ready(function(){
        const 
            post_id = <?php echo $post_id;?>,
            today   = (new Date().toJSON().slice(0,10).replace(/-/g,'-'));
        // var ls = window.localStorage;
        // var lastVisit = ls.getItem('lastVisit');
        // if(lastVisit != today){
        //     ls.clear();
        //     ls.setItem('lastVisit',today);
        //     ls.setItem('readPosts',JSON.stringify([]));
        // }
        
        $.ajax({
            type: 'POST', 
            url: 'post-count',
            data: { 
                pk: post_id,
                type: 'read_count'
            }
        });

        // var readPosts = JSON.parse(ls.getItem('readPosts'));
        // readPosts = readPosts.filter((item,index) => readPosts.indexOf(item) === index);

        // var count_read = false;        
        // setTimeout(function(){
        //     count_read = true;
        // },5000);
        // $(window).scroll(function(e){
        //     e.preventDefault();
        //     if( $(this).scrollTop() >= 300 && count_read == true && !readPosts.includes(post_id)){
        //     if( $(this).scrollTop() >= 300 && count_read == true){    
        //         count_read = false;
        //         readPosts.push(post_id);
        //         ls.setItem('readPosts', JSON.stringify(readPosts));
        //         $.ajax({
        //             type: 'POST', 
        //             url: 'post-count',
        //             data: { 
        //                 pk: post_id,
        //                 type: 'read_count'
        //             }
        //         });
        //     }           
        // });
        $('.facebook').click(function(){
            $.ajax({
                type: 'POST', 
                url: 'post-count',
                data: { 
                    pk:<?php echo $post_id;?>,
                    type: 'share_count_facebook'
                }
            });
        });
        $('.twitter').click(function(){
            $.ajax({
                type: 'POST', 
                url: 'post-count',
                data: { 
                    pk:<?php echo $post_id;?>,
                    type: 'share_count_twitter'
                }
            });
        });
        $('.whatsapp').click(function(){
            $.ajax({
                type: 'POST', 
                url: 'post-count',
                data: { 
                    pk:<?php echo $post_id;?>,
                    type: 'share_count_whatsapp'
                }
            });
        });
    });
});
</script>