/**
 * 
 */
$(document).ready(function(){
	$("nav li a").click(function(event){
		navUrl = $(this).attr("href")
		$("nav li a").attr("class", "")
		$(this).attr("class", "clicked")
		$("main").load(navUrl)
		event.preventDefault()
	})
})