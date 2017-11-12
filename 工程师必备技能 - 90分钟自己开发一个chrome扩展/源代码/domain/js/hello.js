$.getJSON('http://nai8.me/t-hello.html',{},function(d){
	$('#hello').html(d.data);      
});