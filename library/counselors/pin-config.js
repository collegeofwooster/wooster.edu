var pin_config = {
	'default':{
		'pinShadow':'#000', //shadow color below the points
		'pinShadowOpacity':'50', //shadow opacity, value, 0-100
	},
	'points':[
		{
		'shape':'rectangle',//choose the shape of the pin circle or rectangle
		'hover':'<p><span class="name">Catherine Finks &bull; Senior Associate Director of Admissions</span><br>330-263-2117 &bull; cfinks@wooster.edu</p>',//the content of the hover ppup
		'pos_X':672,//location of the pin on X axis
		'pos_Y':210,//location of the pin on Y axis
		'width':14,//width of the pin if rectangle (if circle use diameter)
		'height':14,//height of the pin if rectangle (if circle delete this line)
		'outline':'#9CA8B6',//outline color of the pin
		'thickness':1,//thickness of the line (0 to hide the line)
		'upColor':'#BF0000',//color of the pin when map loads
		'overColor':'#FFCC00',//color of the pin when mouse hover
	'downColor':'#BF0000',//color of the pin when clicked 
		//(trick, if you make this pin un-clickable > make the overColor and downColor the same)
		'url':'https://wooster.edu/bios/cfinks',//URL of this pin
		'target':'same_window',//'new_window' opens URL in new window//'same_window' opens URL in the same window //'none' pin is not clickable
		'enable':true,//true/false to enable/disable this pin
	},
	]
}
