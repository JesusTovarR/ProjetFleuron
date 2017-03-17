(function($){
    $.fn.extend({
                unloadSubtitle:function(srt_file){

                },

		loadSubtitle: function(srt_file, video_id){
			this.each(function(){

				subtitleElement = jQuery(this);
				var videoId = video_id;
				if(!videoId) return;
				var srtUrl = srt_file;
				if(srtUrl) {
				  jQuery(this).load(srtUrl, function (responseText, textStatus, req) {
//                                      alert(responseText);
//                                      alert(textStatus);
//                                      alert(req);
                                      playSubtitles(subtitleElement, videoId)});
                                 
				}
                                else {
                                    alert(subtitleElement.text());
				  playSubtitles(subtitleElement);
				}
			});
			
			function toSeconds(t) {
				var s = 0.0
				if(t){
					var p = t.split(':');
					for(i=0;i<p.length;i++)
						s = s * 60 + parseFloat(p[i].replace(',', '.'))
				}
				return s;
			}
			function strip(s) {
				return s.replace(/^\s+|\s+$/g,"");
			}
			function playSubtitles(subtitleElement, videoId) {
				var srt = subtitleElement.text();
				subtitleElement.text('');
				srt = srt.replace('\r\n|\r|\n', '\n')
				
				var subtitles = {};
				srt = strip(srt);
				var srt_ = srt.split('\n\n');
				for(s in srt_) {
					st = srt_[s].split('\n');
					if(st.length >=2) {
					  n = st[0];
					  i = strip(st[1].split(' --> ')[0]);
					  o = strip(st[1].split(' --> ')[1]);
					  t = st[2];
					  if(st.length > 2) {
						for(j=3; j<st.length;j++)
						  t += '\n'+st[j];
					  }
					  is = toSeconds(i);
					  os = toSeconds(o);
					  subtitles[is] = {i:i, o: o, t: t};
					}
				}
				var currentSubtitle = -1;
				var ival = setInterval(function() {
				  var currentTime = document.getElementById(videoId).currentTime;
				  var subtitle = -1;
				  for(s in subtitles) {
					if(s > currentTime)
					  break
					subtitle = s;
				  }
				  if(subtitle > 0) {
					if(subtitle != currentSubtitle) {
					  subtitleElement.html(subtitles[subtitle].t);
					  currentSubtitle=subtitle;
					} else if(subtitles[subtitle].o < currentTime) {
					  subtitleElement.html('');
					}
				  }
				}, 100);
			  }
			  
		}

                /*Deuxime Subtitre*/
//                loadSubtitle2: function(srt_file, video_id){
//			this.each(function(){
//				subtitleElement = jQuery(this);
//				var videoId = video_id;
//				if(!videoId) return;
//				var srtUrl = srt_file;
//				if(srtUrl) {
//				  jQuery(this).load(srtUrl, function (responseText, textStatus, req) { playSubtitles(subtitleElement, videoId)})
//				} else {
//				  playSubtitles(subtitleElement);
//				}
//			});
//
//			function toSeconds(t) {
//				var s = 0.0
//				if(t){
//					var p = t.split(':');
//					for(i=0;i<p.length;i++)
//						s = s * 60 + parseFloat(p[i].replace(',', '.'))
//				}
//				return s;
//			}
//			function strip(s) {
//				return s.replace(/^\s+|\s+$/g,"");
//			}
//			function playSubtitles(subtitleElement, videoId) {
//				var srt = subtitleElement.text();
//				subtitleElement.text('');
//				srt = srt.replace('\r\n|\r|\n', '\n')
//
//				var subtitles = {};
//				srt = strip(srt);
//				var srt_ = srt.split('\n\n');
//				for(s in srt_) {
//					st = srt_[s].split('\n');
//					if(st.length >=2) {
//					  n = st[0];
//					  i = strip(st[1].split(' --> ')[0]);
//					  o = strip(st[1].split(' --> ')[1]);
//					  t = st[2];
//					  if(st.length > 2) {
//						for(j=3; j<st.length;j++)
//						  t += '\n'+st[j];
//					  }
//					  is = toSeconds(i);
//					  os = toSeconds(o);
//					  subtitles[is] = {i:i, o: o, t: t};
//					}
//				}
//				var currentSubtitle = -1;
//				var ival = setInterval(function() {
//				  var currentTime = document.getElementById(videoId).currentTime;
//				  var subtitle = -1;
//				  for(s in subtitles) {
//					if(s > currentTime)
//					  break
//					subtitle = s;
//				  }
//				  if(subtitle > 0) {
//					if(subtitle != currentSubtitle) {
//					      subtitleElement.html("<font size='4'>"+subtitles[subtitle].t+"</font>");
//					  currentSubtitle=subtitle;
//					} else if(subtitles[subtitle].o < currentTime) {
//					  subtitleElement.html('');
//					}
//				  }
//				}, 100);
//			  }
//
//		}
	})

        

        


})(jQuery);