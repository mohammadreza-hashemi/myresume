require('./bootstrap');




// Echo.channel('articles')
// .listen('ArticleEvent',function(e){
//   console.log(e);
// })


Echo.private('articles.admin')
.listen('ArticleEvent',function(e){
  alert('new eventing... ');
   document.getElementById("badgeuser").innerHTML='new message...';
   document.getElementById("badgeuser").style.backgroundcolor='blue';
   document.getElementById("badgeuser").style.color='red';
});
