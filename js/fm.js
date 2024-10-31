var tumblrFm={

	user:null,
	limit:null,
	size:null,

	init:function(){
		var params=jQuery('#tumblrScript').attr('src').split('?')[1].split('&');
		document.write("<div id = 'lastfmblock'></div>");
		this.user=params[0].split('=')[1];
		this.limit=params[1].split('=')[1];
		this.size=params[2].split('=')[1];
		this.url=params[3].split('=')[1];
		jQuery("#lastfmblock").html("Loading tracks ...");

		jQuery.ajax({
			type:"POST",
			url:this.url+"/wp-content/plugins/recent-lastfm-tracks/php/recentLastFmTracks.php",
			data:"user="+this.user+"&limit="+this.limit
			}).success(function(msg){
			var response=msg;
			var appendHtml="<ul>";
			jQuery(response).find('track').each(function(){
			var name=jQuery(this).find('artist').text();
			var chanson=jQuery(this).find('name').text();
			var album=jQuery(this).find('album').text();
			var url=jQuery(this).find('url').text();
			var image=jQuery(this).find('image');image=image.eq(2).text();

			if(image=="undefined"||image=="")
			{
				image=tumblrFm.url+"/wp-content/plugins/recent-lastfm-tracks/images/nodisc.png"
			}

			appendHtml+='<li><a target = "blank" title = "'+name+', '+chanson+', '+album+'" href = "'+url+'"><img src = "'+image+'" alt = "'+name+', '+chanson+', '+album+'" width = "'+tumblrFm.size+'" height = "'+tumblrFm.size+'"/></a></li>'
		});
			jQuery("#lastfmblock").html(appendHtml+"</ul><div class = 'cleaner'></div>");
			jQuery("#lastfmblock").css("font-family","verdana");
			jQuery("#lastfmblock ul").css("list-style-type","none");
			jQuery("#lastfmblock ul li").css("float","left");
			jQuery("#lastfmblock ul li img").css("width",this.size+"px");
			jQuery("#lastfmblock ul li img").css("height",this.size+"px");
			jQuery("#lastfmblock ul li").css("margin","2px");
			jQuery("#lastfmblock ul li").css("text-align","center");
			jQuery("#lastfmblock cleaner").css("display","block");
			jQuery("#lastfmblock cleaner").css("width","100%");
			jQuery("#lastfmblock cleaner").css("height","1px");
			jQuery("#lastfmblock cleaner").css("clear","both")

	})

}


};

jQuery('document').ready(tumblrFm.init());